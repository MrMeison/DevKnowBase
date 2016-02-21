<?php
/* --------------------------------------------------
---------------- О Г Л А В Л Е Н И Е ----------------
1. Установка, настройка, обновление сервера MySQL

>


-------------------------------------------------- */










/* --------------------------------------------------
---------------- И Н Ф О Р М А Ц И Я ----------------

Ссылки о MySQL:


  Основные ссылки

    > Скачать последнюю версию любого продукта MySQL можно здесь:
        http://dev.mysql.com/downloads/installer/

    > Полная справка по всем продуктам MySQL здесь:
        http://dev.mysql.com/doc/refman/5.6/en/index.html


  Прочие ссылки

    > Описание установки MySQL можно посмотреть здесь
        http://dev.mysql.com/doc/refman/5.6/en/windows-installation.html

    > Описание установки на windows из установочного файла .msi здесь
        http://dev.mysql.com/downloads/mysql/

    > Описание установки на windows из no-install zip архива здесь
        http://dev.mysql.com/downloads/mysql/

    > Список доступных опций для настройки конфигурационного файла
        http://dev.mysql.com/doc/refman/5.6/en/mysqld-option-tables.html




*****************************************************
Оглавление:

	> Общая информация о MySQL
  > Работа с ошибками сервера MySQL
  > Устновка и обновление MySQL 5.6
    > Установка MySQL
      > Описание установки на официальном сайте
      > 2 способа установки: вручную и из установочного файла .msi
        > Установка из установочного файла .msi (доступен только для windows)
        > Установка из no-install zip архива
    > Обновление MySQL
      > Общие рекомендации
      > Обновление 5.6 -> 5.7
  > Настройка аккаунтов для доступа к серверу MySQL
  > MySQL Notofier for Microsoft Windows
  > Запуск / Остановка сервера MySQL
  > Как проверить, работает ли MySQL сервер
  > Как подключить MySQL к PHPStorm
  > Путь с папке bin с утилитами MySQL - записать в PATH windows




*****************************************************




Работа с MySQL и PHPStorm

> Общая информация о MySQL
  > Логотип MySQL - дельфин, имя которого Sakila.
  > В слове MySQL приставка My - это имя одного из создателей Monty Widenius'a.
  > MySQL - это система (сервер) управления реляционными базами данных.
  > База данных - это структурированный набор данных.
  > Операторы SQL является регистронезависимыми. Однако, их принято писать ЗАГЛАВНЫМИ БУКВАМИ.
  > SQL скрипт - это обычный текстовый файл с SQL-командами
  > Исполнять SQL можно в:
    > Консоль cmd.
    > Workbench.
    > PHPStorm
  > Немного о реляционных базах данных и управлении ими с помощью MySQL:
    > Реляционная база данных, которыми управляет MySQL, хранит информацию в отдельных
      таблицах, а не сваливает ее в одну кучу.
    > Каждая база данных представляет собой отдельный файл, который может содержать
      не ограниченное количество таблиц.
    > Логическая модель, которая содержит указанные ниже элементы, представляет собой
      гибкую систему управления данными:
      > Базы данных
      > Таблицы
      > Представления (вьюхи)
      > Строки
      > Колонки
    > Элементы системы взаимодействуют друг с другом по настроенным разработчикам правилам,
      которые если они грамонтно настроены, позволяют избежать многих проблем, таких как
      дублирование, потеря или просрочка данных. Это такие правила, как:
      > one-to-one
      > one-to-many
      > unique
      > required
      > optional
      > options between different tables
  > SQL расшифровывается, как Structured Query Language.
  > Факты о MySQL:
    > Написан на C++
    > Работает на многих разных платформах
    > Создан для работы в режиме многопоточности и многоядерными процессорами.
    > Поддерживает транзакционные и нет движки хранилищ.
    > В MyISAM использует очень быстрые b-tree таблицы.
    > Позволяет относительно легко добавлять новые движки хранилищ.
    > Может работать в среде клиент/сервер и интернета, а может вообще без интернета.
    > Обладает гибкой системой безопасности, возможностью host-based верификации,
      а также возможностью защитить траффик с паролем шифрованием.
    > Масштабируемость и рамки:
      > Есть пользователи, у которых MySQL работает с 200,000 таблиц и
        5,000,000,000 строк.
      > До 64 индексов на таблицу. Каждый индекс может содержать от 1 до 16 колонок.
        Максимальная ширина индекса: 767 байт (InnoDB) и 1000 байт (MyISAM).
      > Есть 3 способа подключения к MySQL:
        > TCP/IP сокет на любой платформе
        > Named pipes на Windows, если MySQL сервер запущен с опцией --enable-named-pipe.
        > Domain socket files на UNIX системах
      > Для многих языков написаны API (application programming interface),
        благодаря которым приложение-клиент для MySQL сервера может быть написано
        на многих языках программирования. Например, на PHP.
      > У MySQL имеется ODBC-connector (MyODBC), который позволяет программам, имеющим
        ODBC-интерфейс работать с MySQL. ODBC расшифровывается, как Open Database Connectivity.
        Это программный интерфейс для доступа к базам данных, разработанный Microsoft.
        Его использует, например, IDE PHPStorm. Подобные интерфейсы есть также для Java и .NET.

> Работа с ошибками сервера MySQL
  > Чтобы установить файл, в котором будет вестись лог ошибок, требуется в конфигурационном
    файле my.ini вписать директорию log-error и путь к файло-логу в качестве значения.
  > Также можно запустить сервер с командой --console, и тогда лог ошибок будет
    выводиться прямо в консоль. Пример такого запуска:
      "C:\...\MySQL\bin\mysqld" --console

> Устновка и обновление MySQL 5.6
  Установка MySQL

  > Описание установки на официальном сайте:
     http://dev.mysql.com/doc/refman/5.6/en/windows-installation.html

  > 2 способа установки: вручную и из установочного файла .msi
    > Установку на windows можно произвести 2-мя способами: установочным файлом .msi и
      из zip архива. Первый способ предпочтительнее - он быстрее и проще, так как
      автоматизирует многие процессы, которые потребуется выполнить вручную,
      если устанавливать из zip файла.

    > Установка из установочного файла .msi (доступен только для windows)
      > Описание этого способа установки:
          http://dev.mysql.com/doc/refman/5.6/en/mysql-installer.html
      > Установщик устанавливает не только MySQL сервер, но и еще много всяких
        других приложений и драйверов.
      > Что делает установочный файл MySQL .msi при установке:
        > Создает соединения MySQL сервера и workbench.
        > Создает конфигурационный файл my.ini, значения директив в котором зависят
          от выбранных при установке.
        > Устанавливает демонстрационные базы данных (чего нет при установке через zip архив)
        > Создает несколько типовых аккаунтов для доступа к БД.
        > Если при установке установлен флажок "Advanced Configuration", то также можно
          настроить опции ведения лога.
      > Краткое руководство:
        1. Сначала скачать свежую версию установочного файла .msi MySQL с официального сайта:
           http://dev.mysql.com/downloads/mysql/
        2. Запустить скаченный файл.
        3. На этапе Setup Type:
           > Выбрать комплектацию установки. Рекомендуется "Full".
           > Выбрать "installation path" - куда установить.
           > Выбрать "Data Path"         - корневая папка для баз данных.
        4. На этапе configuartion идет настройка конфигурации:
           > Выбор типа конфигурации - разработка, боевой сервер.
           > Разрешить/запретить связи по TCP/IP. Установка порта.
           > Настройка аккаунта root, а также других аккаунтов и паролей.
           > Возможность задать имя для службы windows и настроить ее запуск.
           > Если была установлена опция "advanced options", то:
             > Настройка файла для ведения лога ошибок
             > Настройка файла для ведения основного лога MySQL - что он делает.
             > Настройка файла для ведения лога медленных запросов.
             > Настройка файла bin-лога.

    > Установка из no-install zip архива
      *Описание этого способа установки: http://dev.mysql.com/doc/refman/5.6/en/windows-install-archive.html
      1. Сначала скачать свежую версию MySQL в zip архиве с официального сайта:
         http://dev.mysql.com/downloads/mysql/
      2. Распковать содержимое zip архива в любую директорию. Традиционно, это:
         "C:\mysql". Если директория другая, то в файле опций (option file) нужно
         прописать тот путь, куда действительно распакован архив.
      3. Теперь надо создать файл опций (option file), которые будут применяться каждый
         раз при запуске MySQL. По сути, option file содержит конфигурацию MySQL.
         > Создание файла конфигурации жизненно необходимо в следующих случаях:
           > Путь, куда распакован MySQL, отличается от пути по умолчанию
           > Если нужно изменить настройки сервера MySQL, такие как память, кэш или
             конфигурацию InnoDB
         > Сам конфигурационный файл должен называться:
           "my.ini" - это название по умолчанию, но может быть задано и другое при установке службы MySQL (см. ниже).
         > MySQL ищет файл с конфигурацией по следующим адресам, именно в таком порядке:
           > "c:\program files\MySQL\MySQL Server 5.6\my.ini"
           > "c:\program files\MySQL\MySQL Server 5.6\my.cnf"
           > "c:\windows\my.ini", "c:\windows\my.cnf"
           > "c:\my.ini", "c:\my.cnf"
           > "...\MySQL Server 5.6\my.ini", "...\MySQL Server 5.6\my.cnf"
           *Примечание: даже если он нашел конфигурационный файл по 1-му из путей,
                        он продолжает искать дальше, и может найти еще. И тогда повторяющиеся
                        директивы из последующих найденных файлов могут затереть предыдущие.
                        Чтобы избежать этих непоняток, лучше использовать 1 файл по 1 адресу.
         > Вместе с MySQL в zip архиве лежит шаблон конфигурационного файла. Его имя:
             my-default.ini
           Чтобы он заработал, его надо дублировать, переименовать в my.ini и поместить
           в одно из тех месть, где MySQL будет его искать (см. выше).
         > После установки свежей MySQL, желательно произвести проверку - не осталось ли старых
           ненужных конфигурационных файлов, о которых все забыли, но которые из-за этого могли
           бы доставить проблем.
           > Проверка проводится до создания нового конфигурационного файла.
           > Для такой проверки нужно в консоли выполнить следующую команду:
              "C:\...\MySQL\bin\mysqld" --print-defaults
             Эта команда выводит опции, которые применяются к серверу при его запуске.
             Если оно помимо пути к mysqld выведет какие-то опции, значит где-то уже
             существует конфигурационный файл.
      4. После создания конфигурационного файла, его надо настроить. Список всех доступных
         директив можно посмотреть здесь:   http://dev.mysql.com/doc/refman/5.6/en/mysqld-option-tables.html
         > Как минимум, рекомендуется указать следующие опции:
           > port                    | порт сервера MySQL
           > default-character-set   | кодировка по умолчанию
           > basedir                 | путь к папке с MySQL
           > datadir                 | корневая папка для баз данных
           > default-storage-engine  | движок по умолчанию, устанавливается при создании таблиц, если не указывается иной
           > log-error               | файл .log, куда будут поступать записи об ошибках (лежит в datadir папке)
         > В путях к файлам в конфигурационном файле требуется использовать прямой слэш,
           а не обратный (а если обратный, то двойной: \\). Иначе будет ошибка. Пример верного пути:
           "c:/program files".
         > Рекомендуется все пользовательские конфигурации указывать в конце файла, в отдельно
           помеченном разделе. Чтобы если при последнем изменении конфигурации возникла ошибка,
           было легко ее найти.
         > Перед тем, как выбрать порт для сервера MySQL, требуется проверить, не занят
           ли он какой-нибудь другой программой. Краткое руководство:
           1. Открыть командную строку (WIN + R)
           2. Ввести: netstat -a -o
           3. Просмотреть занятые порты. Последняя цифра - это process ID.

  Обновление MySQL

  > Общие рекомендации
    > Основное правило при обновлении MySQL - не пропускать версии. Например, если требуется
      обновить MySQL 5.5 до 5.7, то сначала надо обновить 5.5 -> 5.6, и проверить все базы
      программой mysql_upgrade. А затем повторить тоже самое, обновив 5.6 -> 5.7.
        Подробнее об особенностях обновления здесь: http://dev.mysql.com/doc/refman/5.6/en/upgrading.html
    > Обновление по сути представляет собой удаление старого MySQL, и установку нового. А также
      проверку существующих баз данных на совместимость с новым MySQL программой mysql_upgrade.
      Причем старый MySQL даже не обязательно удалять, можно параллельно установить сколько
      угодно серверов MySQL, задав им разные имена служб, и разные порты.
    > После установки свежей MySQL, желательно произвести проверку - не осталось ли старых
      ненужных конфигурационных файлов, о которых все забыли, но которые из-за этого могли
      бы доставить проблем.
      > Проверка проводится до создания нового конфигурационного файла.
      > Для такой проверки нужно в консоли выполнить следующую команду:
          "C:\...\MySQL\bin\mysqld" --print-defaults
        Эта команда выводит опции, которые применяются к серверу при его запуске.
        Если оно помимо пути к mysqld выведет какие-то опции, значит где-то уже
        существует конфигурационный файл.
    > Также после обновления сервера MySQL рекомендуется обновить также драйверы для
      PHP или другого языка программирования.
    > Краткое руководство:
      1. Перед обновлением, сохранить копию папки с MySQL и всеми данными в безопасное место.
      2. Скачать последнюю версию MySQL с официального сайта:
           http://dev.mysql.com/downloads/
      3. Перед проведением обновления остановить сервер. Если он запущен, как служба,
         то остановить службу (как - см. ниже).
      4. Для обновления MySQL < 4.1.5 до современного, либо при обновлении с версии
         MySQL, установленной из zip файла до версии MySQL, которую планируется установить
         с помощью .msi установщика, требуется сначала вручную удалить старый MySQL.
         А если была установлена служба для него, то и службу (как - см. ниже).
         Хотя, старую службу можно оставить (если надо), а новую просто установить с другим
         именем (как - см. ниже).
      5. Провести установку новой версии - через .msi установщик, либо zip архив.
      6. Воспользоваться приложением mysql_upgrade, для проверки своих баз данных.
         Этим приложением требуется пользоваться каждый раз при обновлении MySQL до
         новой версии.
         > Запускать mysql_upgrade требуется от имени администратора.
         > На вход этой программы лучше подавать копии, а не оригиналы своих баз данных,
           а то вдруг она их испортит.
         > Программа проверяет их на совместимость с текущей версией MySQL.
         > Если она находит не совместимую базу, то пытается ее "починить".
         > Также она обновляет системные таблицы


  > Обновление 5.6 -> 5.7

    > Общая информация
      > Первоисточник:
          http://dev.mysql.com/doc/refman/5.7/en/upgrading-from-previous-series.html
      > Перед обновлением рекомендуется сделать дамп всех таблиц с помощью
        утилиты mysqldump.
        - Используйте опцию --all-databases для того, чтобы сделать дамп
          всех баз данных.
        - Если ваши БД включают сохраняемые программы, используйте опции
          --routines и --events.
      > До и после обновления
        > Ряд вещей надо будет сделать ДО обновления, а ряд ПОСЛЕ обновления.
        > Oracle пишет, что старается сделать так, чтобы ДО обновления ничего
          делать было не надо, но это не всегда получается. И тогда надо просто
          следовать инструкциям из (условно говоря) документа "переход с
          версии X на версию Y", и все будет хорошо.
          > Иногда может потребоваться сделать дампы, и создать из них
            новые таблицы новой версии MySQL. Или использовать такие команды,
            как CHECK TABLE или REPAIR TABLE.
          > Как "обновить" таблицу через dumping and reloading, подробно
            описано здесь:
                http://dev.mysql.com/doc/refman/5.7/en/rebuilding-tables.html
      > Инструкции по обновлению на Windows:
            http://dev.mysql.com/doc/refman/5.7/en/windows-upgrading.html
        1. Перед обновлением, сохранить копию папки с MySQL и всеми данными
           в безопасное место.
        2. Скачать последнюю версию MySQL с официального сайта:
             http://dev.mysql.com/downloads/
        3. Перед проведением обновления остановить сервер. Если он запущен,
           как служба, то остановить службу (как - см. ниже).
        4. Перед обновлением до MySQL 5.7 (при установке через Wizard) с:
           - версии MySQL < 4.1.5
           - версии MySQL, установленной из zip-архива
           нужно сначала вручную удалить предыдущую установку и старый
           MySQL-сервис (если он установлен).
           > Для удаления сервиса можно использовать следующую команду
             (но нужно указать правильный путь к mysqld):

              C:\mysql\bin\mysqld --remove

        5. Если ты используешь Wizard для установки, следуй следующим
           инструкциям:
              http://dev.mysql.com/doc/refman/5.7/en/mysql-installer.html
        6. Если ты используешь для установки ZIP-архив, то ты можешь:
           - Распаковать архив с новым MySQL прямо поверх старого MySQL
             (рекомендуется).
           - Или распаковать его в новую папку.
        7. Перезапустите сервер.
        8. Запустите утилиту mysql_upgrade с правами администратора.

    > Что конкретно надо делать ДО и ПОСЛЕ обновления
      > ДО обновления надо проверить страницу по ссылке ниже. Там Oracle
        пишет о различных несовместимостях таблиц старых и новых версий.
        Надо проверить, есть ли какие-либо несовместимости между текущей
        и той версией, на которую ты переходишь, из-за которых требуется
        "обновить" таблицы.
          http://dev.mysql.com/doc/refman/5.7/en/checking-table-incompatibilities.html
      > ДО обновления, если ты используешь INNODB, то рекомендуется перед
        обновлением установить системную переменную innodb_fast_shutdown = 0.
        А после обновления - поменять обратно на 1.
      > ДО обновления
        > Неявное DEFAULT-значение для TIMESTAMP устарело в 5.7, так что
          надо в my.ini установить следующую опцию:
            explicit_defaults_for_timestamp = TRUE

      > ПОСЛЕ обновления
        > MySQL 5.7 требует, что чтобы в таблице mysql.user, которая
          содержит информацию об аккаунтах сервера, колонка plugin была
          не пуста (а в 5.6 он пуста).
        > Поэтому для обновления, при котором ты планируешь использовать
          директорию data из текущей установленной версии MySQL (а не
          восстанавливать всё из дампа), надо сделать следующее:
          - Остановить сервер
          - Выполнить обновление
          - Запустить сервер с опцией --skip-grant-tables
            (чтобы отключить проверку прав)
            > Запускать сервер в этом пункте надо не как службу, а как
              процесс, вот таким вот образом (только указать правильный
              путь к mysqld):

                C:\mysql-5.6.13-winx64\bin\mysqld --skip-grant-tables

          - Запустить mysql_upgrade (должен запускаться без логина и пароля)
          - Перезапустить сервер (уже без --skip-grant-tables)
        > Если же ты планируешь после обновления перезагрузить на сервер
          данные из дампа, то надо действовать следующим образом:
          - Для создания дампа использовать mysqldump без опции  --flush-privileges
          - Останновить сервер
          - Выполнить обновление
          - Запустить сервер с опцией --skip-grant-tables
            (чтобы отключить проверку прав)
          - Загрузить данные из дампа на сервер с помощью команды:

              mysql < dump_file

            Где dump_file - путь к файлу с дампом.
          - Запустить mysql_upgrade
          - Перезапустить сервер (уже без --skip-grant-tables)
      > ПОСЛЕ обновления, запустите утилиту mysql_upgrade.
        > Запуститься и сработать должна без логина и пароля
        > Что делает mysql_upgrade:
        - Проверит все ваши таблицы, и если потребуется, "починит" их.
        - Также проверит все таблицы с правами для того, чтобы удостовериться,
          что они соответствуют той структуре, которая должна быть у новой
          версии MySQL.
        - Содержимое help-таблиц не обновляется при запуске этой утилиты.
          Для подробностей см.:
            http://dev.mysql.com/doc/refman/5.7/en/server-side-help-support.html


> Настройка аккаунтов для доступа к серверу MySQL
  > MySQL сборка для windows уже имеет таблицу аккаунтов (grant table) в базе данных
    'mysql' в папке data.
  > При установке MySQL с помощью установочного файла, можно уже на этапе установки
    указать также и пароли для аккаунтов. А при установке с помощью zip архива нельзя.
  > Настройку аккаунтов можно производить:
    > Отдавая команды серверу
    > Через workbench

> MySQL Notofier for Microsoft Windows
  > MySQL Notofier - это инструмент, который позволяет наблюдать и изменять статус
    локального или удаленного MySQL сервера, используя для этого иконку в системном
    трее microsoft windows. Также через нее можно быстро открыть ряд приложений от MySQL,
    например, workbench.
  > MySQL Notifier установится автоматически при установке сервера MySQL через
    установочный файл .msi (если поставить соответствующую галочку при установке)
  > Скачать Notifier отдельным файлом можно здесь:
      http://dev.mysql.com/downloads/installer/

> Запуск / Остановка сервера MySQL
  > Запуск и остановка возможны 2-мя способами:
    > Просто, как программу через .exe файл
      > Для запуска/остановки сервера MySQL требуется ввести в консоли одну из следующих команд:
          "C:\...\MySQL\bin\mysqld"    | для запуска сервера MySQL
          "C:\...\MySQL\bin\mysqladmin" -u root -p password shutdown
             *Примечание: root - это логин админа сервера, а password - это его пароль.
      > Для гарантированного запуска сервера MySQL, НЕ как службы, можно использовать
        опцию --standalone
    > Как службу windows (НАШ ВЫБОР)
      > Если MySQL сервер запущен, как служба windows, то она будет автоматически
        запускаться при запуске компьютера, и не придется каждый раз после перезагрузки
        запускать сервер вручную.
      > Как только MySQL сервер запущен, как служба windows, mysqld больше не имеет
        доступа к окну консоли, и никаких сообщений там не появится. Поэтому посмотреть
        лог ошибок можно в указанном в конфигурационном файле в директиве log-error файле.
      > Чтобы установить службу windows MySQL сервера,
        требуется ввести в консоли следующую команду (указав папку с MySQL):
          "C:\...\MySQL\bin\mysqld" --install здесь_по_желанию_всякие_опции
        > Можно установить дополнительные опции при установке службы. Они записываются
          сразу после "--install". Вот эти опции:
          > Можно указать имя службы, оно идет сразу после --install (по умолчанию имя MySQL)
            > Если указано имя службы, то сразу после него можно вписать опцию,
              указывающую имя конфигурационного файла:
                --defaults-file=file_name
          > Если имя сервиса не указано, то сервер читает директивы из группы [mysqld]
            конфигурационного файла. Если же имя сервиса переопределено, то сервер читает
            директивы из группы [mysqld], а также из группы, имеющей то же имя, что и
            переопределенное имя сервиса. Таким образом, можно использовать группу опций
            [mysqld], как общую для всех сервисов.
      > Как удалить службу MySQL сервера. Руководство:
        1. Остановить службу командой в консоли "net stop SERVICENAME", где SERVICENAME -
           имя службы. Обычно, это MySQL. Но не мешает уточнить в Панель Управления ->
           Администрирование -> Службы. Там, кстати, тоже можно ее остановить.
        2. Ввести в консоли команду:
             "C:\...\MySQL\bin\mysqld" --remove
      > Есть 2 варианта запуска/остановки службы windows MySQL сервера
        > Через панель управления
          > Панель управления -> Администрирование -> Службы. Найти службу MySQL56,
            щелкнуть ПК мыши, и выбрать "Запустить" или "Остановить".
        > Через консоль
          > В консоли ввести одну из следующих команд:
              net start MySQL56   | чтобы запустить службу MySQL56
              net stop MySQL56    | чтобы остановить службу MySQL56

> Как проверить, работает ли MySQL сервер
  > Это можно сделать, выполнив одну из представленных ниже команд:
      "C:\...\MySQL\bin\mysqlshow"
      "C:\...\MySQL\bin\mysqlshow" -u root mysql
      "C:\...\MySQL\bin\mysqladmin" version status proc
      "C:\...\MySQL\bin\mysql" test

> Как подключить MySQL к PHPStorm:
  *Примечание: MySQL сервер должен быть запущен.
  1. В проекте PHPStorm справа есть вкладка Database. Нажать на нее.
  2. В появившемся окне Data Source Propetries установить следующие значения свойств (по аналогии):
     > Scope              | Project
     > JDBC driver files  | выбрать MySQL connector и нажать скачать
     > JSBC driver class  | автоматически становится com.mysql.jdbc.Driver
     > Database URL       | jdbc:mysql:localhost:3307/имя_базы_данных          проверить порт через консоль \s
     > User               | имя пользователя
     > Password           | пароль

> Путь с папке bin с утилитами MySQL - записать в PATH windows
  > Чтобы запуская какую-нибудь MySQL утилиту через консоль, каждый раз не приходилось
    прописывать полный путь к ней, например во так: "c:\...\mysql\bin\mysql",
    можно прописать путь ко всем утилитам, например такой: "c:\...\mysql\bin\"
    в системную переменную windows: PATH. Тогда windows, если не находит файл
    с указанным именем в консоли, идет в переменную PATH и примеряет к этому
    файлу пути оттуда.
  > Но осторожно! Если на одной машине установлены несколько серверов MySQL, надо
    позаботиться о том, чтобы в PATH был только 1 путь к утилитам - только для
    актуального сервера. Иначе возможны казусы и непонятки.
  > Краткое руководство, как прописать путь к MySQL\bin в PATH:
    1. ПК мыши по Мой Компьютер -> свойства -> дополнительные параметры ->
       дополнительно -> переменные среды
    2. В окне "переменные среды для пользователя ..." найти переменную PATH,
       нажать кнопку изменить.
    3. В конце дописать путь полный путь к папке mysql\bin. Например:
       C:\Program Files\MySQL\MySQL Server 5.6\bin\
       * ОСТОРОЖНО 1: в путь должен кончаться на \
       * ОСТОРОЖНО 2: после \ должна идти ;
    4. Сделать тоже самое в окне "Системные переменные"
    5. Посли прописания пути, чтобы все заработало, надо перезапустить консоль,
       если она была открыта во время прописания.














------------- Все, что дальше - в работе
> Работа с утилитой 'mysql'
  >
  > Путь в консоли, содержащий пробелы, надо заключать в "". Например:
    "c:\program files". Иначе это будет работать не корректно.

  > Консольные команды MySQL:
    > \?   | выводит в консоль справочник по командам
    > \g   | отправить команду серверу MySQL
    > \G   | отправить команду серверу MySQL, отображать результат вертикально
    > \r   | переподключиться к серверу
    > \c   | отменить предыдущий ввод (aka backspace в консоли)
    > \d   | по умолчанию ; (аналог go)  с помощью \d можно изменить на любую
    > \q   | выйти из MySQL
    > \T   | \T [имя файла] пишет лог запросов-ответов в этот файл
    > \t   | перестать писать лог
    > \p   | вывести на экран текущую, еще не отправленную на сервер MySQL команду
    > \.   | \. [имя файла] выполняет все команды из этого файла
    > \s   | вывести информацию о сервере
    > \W   | выводить предупреждения от сервера после каждого выражения
    > \w   | не выводить


-------------------------------------------------- */
?>


















