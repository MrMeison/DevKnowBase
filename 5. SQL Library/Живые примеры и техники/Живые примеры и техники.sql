/* --------------------------------------------------
---------------- О Г Л А В Л Е Н И Е ----------------
Живые примеры и техники







-------------------------------------------------- */










/* --------------------------------------------------
---------------- И Н Ф О Р М А Ц И Я ----------------


Ссылки:


  > Использование пользовательских (сессионных) переменных (вроде @x)
      http://dev.mysql.com/doc/refman/5.6/en/user-variables.html

  >



*****************************************************
Оглавление:


  > Как проверить, существует ли сохраняемая процедура или скрипт?
  > Использование пользовательских (сессионных) переменных (вроде @x)
  > Использование локальных переменных в блоке BEGIN .. END (вроде DECLARE x INT)
  > В чём разница между сессионными (@x) и локальными (x) переменными?
  > Как протестировать значение на равенство NULL?
  > Как получить цифру TIMESTAMP из строки, содержащей timestamp
  > Как получить цифру TIMESTAMP из строки формата "YYYY-MM-DD HH:MM:SS"
  > Как узнать дату и время последнего обновления таблицы X?
  > Как из PHP выполнить .sql файл?
  > Значения какого формата принимают SQL-типы DATETIME от TIMESTAMP?


*****************************************************



> Как проверить, существует ли сохраняемая процедура или скрипт?
  > Метаданные обо всех сохраняемых скриптах хранятся в таблице
    INFORMATION_SCHEMA.ROUTINES
  > Нужно проверить информацию в 2-х столбцах:
    - ROUTINE_SCHEMA  | таблица, за которой закреплён сохраняемый скрипт
    - ROUTIME_NAME    | имя сохраняемого скрипта
    - ROUTINE_TYPE    | тип сохраняемого скрипта
  > Примеры:

    Проверим, существует ли процедура 'myProc' на сервере в
    БД 'myDatabase':
    -----
      SELECT ROUTINE_NAME
      FROM INFORMATION_SCHEMA.ROUTINES
      WHERE
        ROUTINE_TYPE='PROCEDURE' AND
        ROUTINE_SCHEMA='myDatabase' AND
        ROUTINE_NAME='myProc';             #  'null'

    Проверим, существует ли процедура 'film_in_stock' на сервере
    в базе данных "sakila'
    -----
      SELECT ROUTINE_NAME
      FROM INFORMATION_SCHEMA.ROUTINES
      WHERE
        ROUTINE_TYPE='PROCEDURE' AND
        ROUTINE_SCHEMA='sakila' AND
        ROUTINE_NAME='film_in_stock';      #  'film_in_stock'

    Написать сохраняемую функцию, которая проверяет, существует ли
    указанная в параметре сохр. программа INFORMATION_SCHEMA.ROUTINES, или нет:
    - Если существует, то возвращает true
    - Если не существует, то возвращает false
    -----

      # Определение функции
      CREATE FUNCTION ifStoredProgExists(name VARCHAR(100)) RETURNS BOOLEAN
        BEGIN

          # Определить локальную переменную для результата
          DECLARE result VARCHAR(100) DEFAULT NULL;


          # Поискать сохраняемую программу name в INFORMATION_SCHEMA.ROUTINES,
          # и сохранить результат поиска в локальную переменную result
          SELECT ROUTINE_NAME INTO result FROM INFORMATION_SCHEMA.ROUTINES
            WHERE ROUTINE_NAME=name
            LIMIT 1;


          # Если @result = NULL, то вернуть false
          IF result IS NULL THEN
            return false;


          # Если @result != NULL, то вернуть true
          ELSEIF result IS NOT NULL THEN
            return true;

          END IF;

        END;

      # Тестирование функции

        # Посмотреть весь список сохранённых на сервере сохраняемых программ
        SELECT * FROM INFORMATION_SCHEMA.ROUTINES;

        # Протестировать функцию
        SELECT ifStoredProgExists('film_in_stock');     -- 1
        SELECT ifStoredProgExists('rewards_report');    -- 1
        SELECT ifStoredProgExists('абвгд');             -- 0


> Использование пользовательских (сессионных) переменных (вроде @x)
  > Их можно использовать почти где угодно в SQL-коде.
  > Могут принимать только значения следующих типов:
    - integer
    - decimal
    - floating-point
    - binary string
    - non binary string
    - null
  > Установить значение пользовательской переменной можно 2-мя способами:
    - С помощью утверждения SET:

        SET @x = 10;      -- 10
        SET @y = null;    -- null
        SET @z = 20;      -- 20

    - В выражении SELECT используя :=

        SELECT @x, @y, @z, @k := @x + @y + @z;    -- 10, null, 20, 30

  > Для не SET-выражений, при использовании одной и той же польз. переменной
    и в левой, и в правой части выражения, ожидаемый результат не
    гарантирован, поскольку в этом случае в SQL порядоку выполенния
    выражений, включающих пользовательские переменные, не определён, в
    отличие от того же javascript.
    > Пример, как делать не рекомендуется:

      Как делать не надо (опасно, результат не гарантирован):
      -----

        SET @x = 1;
        SELECT @a, @a := @a+1;   -- 1, 2

    > Исключение - в выражении SET все нормально:
l
      Это будет работать нормально:
      -----
        SET @x = 1;         -- 1
        SET @x = @x + 1;    -- 2

  > Также не рекомендуется в пределах одного не-SET экспрешена назначать
    переменной значение, и использовать эту переменную - это потенциальный
    источник проблем с типом переменной.
    > Суть проблемы на примере:

      @x = 'Привет!';
      SELECT @x, (@x:=20)

      В этом примере в выражении SELECT интерпретатор считает, что все
      @x - строки. Даже не смотря на то, что второму @x присвоено число.

    > Чтобы избежать этой проблемы, не надо присваивать значение и читать
      эту же переменную в одном и том же не-SET экспрешене.

  > Пользовательские переменные нельзя использовать в качестве идентификаторов
    имён чего-бы то нибыло (БД, таблиц, столбцов и т.д.).
    > Например, это не сработает:

      @col = 'column1';
      SELECT @col FROM table;   -- 'column1' (а не набор значений из колонки table -> column1)



> Использование локальных переменных в блоке BEGIN .. END (вроде DECLARE x INT)
  > Такие локальные переменные можно использовать внутри сохраняемых программ,
    внутри блока BEGIN ... END.
  > Локальные переменные рассматриваются так же, как параметры сохраняемых
    программ, с учетом их типа.
  > Определять локальные переменные надо в самом начале сохраняемой программы,
    до какого-либо другого кода.
  > Область видимости локальнйо переменной - внутри блока BEGIN .. END,
    в котором она определена.
  > Синтаксис:

      DECLARE var_name [, var_name] ... type [DEFAULT value]

    > Где:
      - var_name  | имя переменной
      - type      | тип переменной

  > Если атрибут DEFAULT не указан, то переменная будет неявно
    инициирована значением NULL.
  > Пример использования:

      CREATE PROCEDURE procedure10()
        BEGIN
          DECLARE x INT;
          DECLARE y INT;
          DECLARE z INT;
          SELECT x;           -- null

          SET x = 20;
          SET y = 30;
          SELECT x;           -- 20
          SELECT y;           -- 30

          SET z = x + y;
          SELECT z;           -- 50

        END;
      CALL procedure10();


> В чём разница между сессионными (@x) и локальными (x) переменными?
  > Разница в сроке жизни:
    - Сессионные переменные живут в течение сессии.
    - Локальные переменные живут до конца исполнения блока BEGIN .. END.
  > Пример, демонстрирующи это:

    CREATE PROCEDURE increment()
      BEGIN
        DECLARE x INT DEFAULT 1;

        SET @x = @x + 1;
        SET x = x + 1;

        SELECT @x, x;

      END;
    SET @x = 1;
    CALL increment();   -- 2, 2
    CALL increment();   -- 3, 2
    CALL increment();   -- 4, 2


> Как протестировать значение на равенство NULL?
  > Для этого есть операторы:
    - x IS NULL
    - x IS NOT NULL
  > Примеры:

    SET @x = 10;
    SET @y = null;

    SELECT @x IS NULL;    -- 0
    SELECT @y IS NULL;    -- 1


> Как получить цифру TIMESTAMP из строки, содержащей timestamp
  > Это можно сделать в 2 шага:
    1.  Перевести строку с timestamp в значение типа DATETIME.
        > Это можно сделать с помощью функции FROM_UNIXTIME.
          - Она принимает кол-во секунд, прошедших с начала эпохи UNIX.
          - А возвращает значение типа DATETIME.
    2.  Полученное в п.1 значение типа DATETIME перевести в значение
        типа TIMESTAMP
        > Это можно сделать с помощью функции UNIX_TIMESTAMP
          - Она принимает значение типа DATETIME.
          - А возвращает значение типа TIMESTAMP.
  > Пример:

      # Вот наша исходная строка
      SET @string = '1387987796';

      # Шаг 1 - получаем из неё значение типа DATETIME
      SET @datetime = FROM_UNIXTIME(@string);

      # Шаг 2 - получаем из значения типа DATETIME значение типа TIMESTAMP
      SET @timestamp = UNIX_TIMESTAMP(@datetime);

      # Проверяем результат
      SELECT @timestamp;    -- 1387987796


> Как получить цифру TIMESTAMP из строки формата "YYYY-MM-DD HH:MM:SS"

  > Это можно сделать в 2 шага:
    1.  Перевести строку указанного формата в датавременное значение.
        > Это можно сделать с помощью функции STR_TO_DATE
          - Первым аргументом принимает строку с данными о дате и времени.
          - Вторым аргументом надо передать строку с форматом данных,
            переданных первым аргументом.
              Подробности о составлении строки-формата здесь:
              http://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_date-format
    2.  Полученное в п.1 значение типа DATETIME перевести в значение
        типа TIMESTAMP
        > Это можно сделать с помощью функции UNIX_TIMESTAMP
          - Она принимает значение типа DATETIME.
          - А возвращает значение типа TIMESTAMP.
  > Пример:

      # Вот наша исходная строка
      SET @string = '2013-12-25 20:32:00';

      # Составляет строку-формат для неё
      SET @format = '%Y-%m-%d %H:%i:%s';

      # Шаг 1 - получаем из неё значение типа DATETIME
      SET @datetime = STR_TO_DATE(@string, @format);

      # Шаг 2 - получаем из значения типа DATETIME значение типа TIMESTAMP
      SET @timestamp = UNIX_TIMESTAMP(@datetime);

      # Проверяем результат
      SELECT @timestamp;    -- 1387989120


> Как узнать дату и время последнего обновления таблицы X?
  > Для этого надо заглянуть в таблицу information_schema.tables,
    где хранится вся мета-информация по всем таблицам на сервере MySQL.
    > *Примечание: это работает только для MySQL >= 5.7
  > Наиболее часто используемые колонки в этой таблице:
    - TABLE_SCHEMA    | имя БД, которой принадлежит таблица
    - TABLE_NAME      | имя таблицы
    - ENGINE          | имя движка хранилища таблицы
    - TABLE_ROWS      | кол-во строк в таблице
    - DATA_LENGTH     | размер таблицы в байтах
    - CREATE_TIME     | дата и время создания таблицы в формате (yyyy-mm-dd HH:mm:ss)
    - UPDATE_TIME     | дата последнего обновления
    - TABLE_COLLATION | кодировка таблицы
    - TABLE_COMMENT   | комментарий таблицы
  > Пример:

      SELECT CREATE_TIME FROM information_schema.tables WHERE TABLE_NAME="person" INTO @x;
      SELECT @x;


> Как из PHP выполнить .sql файл?

  > Описание проблемы:
    > Идеальный вариант - чтобы SQL-файл содержал только SQL-выражения,
      по 1-му целому выражению в строчку, без комментариев, пробелов
      и вообще каких-либо лишних символов.
    > Тогда можно было бы читать этот файл по 1 строчке сверху-вниз,
      и выполнять эти SQL-выражения.
    > Но в реальной жизни таких идеальных SQL-файлов не бывает. Поэтому
      требуется решение.

  > Возможные решения:
    > Есть 3 решения:
      1 Из PHP запускать mysql shell с помощью функции shell_exec,
        и давать ему выполнить файл .sql.
        > Проблема этого решения в том, что на большинстве хостингов
          запрещена команда shell_exec.
        > Поэтому это плохое решение.
      2 Использовать полноценный парсер SQL-кода (диалекта MySQL),
        написанный на PHP.
        > Он должен парсить всё, включая код сохраняемых программ.
        > Если рассуждать логически, то маловероятно появление такого
          парсера, который на 100% бы правильно парсил SQL-код. Потому
          что сделать такой парсер - это очень большой объем работы,
          а SQL-диалектов много, и все они непрерывно эволюционируют.
        > Поэтому это плохое решение.
      3 Не использовать .sql файл, а вместо этого весь SQL-код
        записывать в PHP-файле, который достаточно только запустить
        из другого PHP-файла, чтобы его исполнить.

  > Итого - лучшее решение:
    > Не использовать .sql файл.
    > SQL-код записывать в PHP-файл таким образом, чтобы для выполнения
      этого SQL-кода нужно было бы только запустить этот PHP-файл и всё.


> Значения какого формата принимают SQL-типы DATETIME от TIMESTAMP?

  > Введение
    > Допустим, надо сохранять дату и время в базе данных из PHP,
      в колонку типа DATETIME или TIMESTAMP.
    > В каком формате нужно предоставить значение?

  > Решение - в одном из следующих форматов:
    - В виде строки в формате: 'YYYY-MM-DD HH:MM:SS'
    - В виде строки в формате: 'YYYYMMDDHHMMSS'
    - В виде строки с меткой UNIX в секундах.

    *Примечание: во всех случаях значения должны попадать в допустимый
                 диапазон.

  > Допустимые диапазоны для DATETIME и TIMESTAMP:

    > DATETIME
           от '1000-01-01 00:00:00.000000'
           до '9999-12-31 23:59:59.000000'

    > TIMESTAMP
          от '1970-01-01 00:00:01.000000' UTC
          до '2038-01-19 03:14:07.999999' UTC




-------------------------------------------------- */














