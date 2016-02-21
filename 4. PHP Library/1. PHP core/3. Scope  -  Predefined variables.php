<?php
/* --------------------------------------------------
---------------- О Г Л А В Л Е Н И Е ----------------
Область видимости  -  предопределенные переменные

> Область видимости
   > Как из локальной области видимости получить доступ к глобальной переменной?
     > Вариант 1, как заставить функцию видеть внешние переменные (ключевое слово globals)
     > Вариант 2, как заставить функцию видеть внешние переменные (использовать суперглобальную переменную $GLOBALS)
   > Как просмотреть какие сейчас есть глабальные переменные?
   > Демонстрация работы статических переменных на примере функции-счетчика вызовов.

> Предопределенные переменные
  1. $GLOBALS
     > Доступ к глабальным переменным из любого места кода
     > Что лежит в $GLOBALS по умолчанию?
  2. $_SERVER
     > Индексы и значения (выборочно)
  3. $_GET
     > Как получить значения параметров, переданных скрипту через адресную строку методом GET
  4. $_POST
     > Как получить значения параметров, переданных скрипту методом POST
  5. $_FILES
  6. $_REQUEST
  7. $_SESSION
  8. $_COOKIE
  9. $_ENV
  10. $php_errormsg
  11. $http_response_header
      > Техника получения ответных HTTP заголовков с другого сайта


-------------------------------------------------- */


// Область видимости
    $x1 = 5;
    $x2 = 10;
    // Как из локальной области видимости получить доступ к глобальной переменной?
        // Вариант 1, Как заставить функцию видеть внешние переменные (ключевое слово globals)
            function f1() {
                global $x1,$x2;   // теперь локальные версии $x1,$x2 ссылаются на своих глабальных собратьев
                return $x1 + $x2;
            }
            echo '<p>f1() = ' . f1() . '</p>';  // 15
        // Вариант 2, как заставить функцию видеть внешние переменные (использовать суперглобальную переменную $GLOBALS)
            function f2() {
                return $GLOBALS['x1'] + $GLOBALS['x2'];
            }
            echo '<p>f1() = ' . f1() . '</p>';  // 15
    // Как просмотреть какие сейчас есть глабальные переменные?
        echo '<p>'; var_dump($GLOBALS); echo '</p>';
    // Демонстрация работы статических переменных на примере функции-счетчика вызовов.
        function counter() {
            // static $x = 2 + 2;   такое объявление вызвало бы ошибку
            static $x = 0;  // эта строка сработает только при 1-м вызове функции
            $x++;
            return $x;
        }
        echo '<p>counter() = ' . counter() . '</p>';  // 1
        echo '<p>counter() = ' . counter() . '</p>';  // 2
        echo '<p>counter() = ' . counter() . '</p>';  // 3


// Предопределенные переменные
    // $GLOBALS
        // Доступ к глобальным переменным из любого места кода
            $myGlobVar = 10;
            echo '<p>' . $GLOBALS['myGlobVar'] . '</p>';    // 10
        // Что лежит в $GLOBALS по умолчанию?
        var_dump($GLOBALS);   // массивы _GET; _POST; _COOKIE; _FILES;
    // $_SERVER
        // Индексы и значения (выборочно)
            echo '<p>' . $_SERVER['PHP_SELF'] . '</p>';           // имя этого файла относительно корня  |  /3. PHP Library/3. Scope - Predefined variables.php
            echo '<p>' . $_SERVER['SERVER_ADDR'] . '</p>';        // ip сервера  |
            echo '<p>' . $_SERVER['SERVER_NAME'] . '</p>';        // имя хоста  |  localhost
            echo '<p>' . $_SERVER['SERVER_SOFTWARE'] . '</p>';    // о сервере  |  Apache/2.4.4 (Win64) PHP/5.5.0
            echo '<p>' . $_SERVER['REQUEST_METHOD'] . '</p>';     // какой был использован метод запроса  |  GET
            echo '<p>' . $_SERVER['REQUEST_TIME'] . '</p>';       // временная метка начала запроса  |  1372332074
            echo '<p>' . $_SERVER['QUERY_STRING'] . '</p>';       // QUERY_STRING
            echo '<p>' . $_SERVER['DOCUMENT_ROOT'] . '</p>';      // корневая папка сервака  |  C:/Users/Administrator/Desktop/Practice
            echo '<p>' . $_SERVER['REQUEST_URI'] . '</p>';        // все что в адресной стркое после доомена идет  |  /3.%20PHP%20Library/3.%20Scope%20%20-%20%20Predefined%20variables.php
            echo '<p>' . $_SERVER['PATH_INFO'] . '</p>';          // в адресной строке после имени скрипта, но до query_string
            echo '<p>' . $_SERVER['HTTP_REFERER'] . '</p>';       // заголовок REFERER  |  http://localhost/3.%20PHP%20Library/
    // $_GET
        // Как получить значения параметров, переданных скрипту через адресную строку методом GET
            echo '<p>' . $_GET['name'] . '</p>';       // www.site.ru/index.php?name=John
    // $_POST
        // Как получить значения параметров, переданных скрипту методом POST
            echo '<p>' . $_POST['name'] . '</p>';
    // $_FILES
    // $_REQUEST
    // $_SESSION
    // $_COOKIE
    // $_ENV

    // $php_errormsg
        echo '<p>' . $php_errormsg . '</p>';

    // $http_response_header
        // Техника получения ответных HTTP заголовков с другого сайта
            function getHeaders() {
                file_get_contents('http://ya.ru');
                var_dump($http_response_header);
            }
            getHeaders();  // выводит куки с яндекса

/* --------------------------------------------------
---------------- И Н Ф О Р М А Ц И Я ----------------

> Предопределенные переменные
  > Полный список доступных предопределенных переменных:
    > Можно найти по адресу: http://www.php.net/manual/ru/reserved.variables.php
    > ... или увидеть, запустив функцию phpinfo()
  > Эти переменные содержат максимум информации, которая может понадобитсья.
  > Суперглобальные переменные - доступ к которым есть из любого места скрипта
    без использования синтаксиса global $variable;

    > К суперглобальным относятся:
      > $GLOBALS   | доступ ко всем глобальным переменным из любого места кода
                     > по умолчанию доступны лишь 4 индекса: _GET, _POST, _COOKIE, _FILES,
                       а другие данные из определенной категории становятся доступны, если
                       в коде скрипта есть запрос значения из этой категории. Например, если
                       в коде есть запос $_SERVER['PHP_SELF'], то в $GLOBALS появятся все
                       значения из $_SERVER.
      > $_SERVER   | информация о сервере и среде исполнения
                     > такая как заголовки и пути к исполняемым файлам.
                     > полный справочник индексов здесь: http://www.php.net/manual/ru/reserved.variables.server.php
                     > все индексы не обязательны, нет гарантии, что любои из них будет
      > $_GET      | массив параметров, переданных скрипту через URL методом GET
                     > например: www.site.ru/index.php?name=John
                       $_GET['name'] == John
      > $_POST     | массив параметров, переданных скрипту через URL методом POST
      > $_FILES    | массив элементов, загруженных в этот скрипт методом POST
      > $_REQUEST  | (пережиток прошлого) дублирует-содержит в себе $_GET, $_POST, $_COOKIE
      > $_SESSION  | содержит массив переменных сессий
      > $_COOKIE   | содержит массив переменных, переданных скрипту через HTTP куки
      > $_ENV      | содержит массив переменных окружения

    > Также к предопределенным переменным относятся:
      > $php_errormsg  |  содержит текст последней ошибки, если она была
      > $http_response_header
        > действует только в локальной области видимости



> Область видимости
  > Переменные в PHP бывают:
    > Глобальные
      > Содержит определенные пользователем и предопределенные переменные.
      > Все переменные, определенные в скрипте PHP вне функций, автоматически
        становятся глобальными и попадают в суперглобальный массив $GLOBALS, который
        содержит в себе все глобальные переменные.
    > Локальные
      > Определенные внутри локальных областей видимости, такик как тело функции.
    > Локальные статические
      > Тоже, что и локальные, но не теряют своего значения, когда выполнение программы
        выходит из этой области видимости.
      > Определяются с помощью ключевого слова static
      > Благодаря статическим переменным в PHP возможна реализация рекурсии.
      > При инициализации статических переменных нельзя присваивать им результат
        выражения, это вызовет ошибку.

  > Область видимости переменной - это контекст, в котором она определена.
  > Особенности работы области видимости с функциями
    > Тело функции имеет локальную область видимости, определенные внутри него
      переменные являются локальными, и не видны вовне функции.
    > Определенные во вне тела функции переменные не видны просто так внутри
      функции. Чтобы их можно было увидеть, надо объявить их внутри функции
      с ключевым словом global. Либо надо забирать их значения из суперглобальной
      переменной $GLOBALS
  > Про почившую в бозе директиву register_globals (php.ini)
    > Ссылки на первоисточники:
      > http://www.php.net/manual/ru/ini.core.php#ini.register-globals
      > http://www.php.net/manual/ru/faq.using.php#faq.register-globals
      >
    > По умолчанию OFF (с PHP >= 4.2.0), исключена из PHP (с PHP >= 5.4.0)
    > Указывает, регистрировать ли в качестве глобальных переменные
      EGPCS (Environment, GET, POST, Cookie, Server)
      > Например, приходит запрос: http://example.com/foo.php?animal=cat
        > В нем передается параметр animal=cat
        > Если register_globals ON, то автоматом регистрировалась глобальная
          переменная $animal = 'cat';
        > Теперь, когда register_globals пожизненно OFF, получить доступ к
          animal можно с помощью суперглобальных переменных, в данном случае:
          $_GET['animal']



-------------------------------------------------- */
?>

