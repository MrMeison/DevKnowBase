<?php
// ##############################
// 18.1. Загрузка файла на сервер
// ##############################
// Вся информация в файле '18. Working with Files'




// Загрузка 1 файла через HTML форму методом POST в произвольную папку
    echo '<p><b>Загрузка файла через HTML форму методом POST в произвольную папку</b> </p>';
    $filename = 'myFile1';    // Задать имя файла №1 для массива $_FILES
    ?>

    <!-- Форма загрузки файлов
    > enctype      - тип кодирования файлов, для загрузки файлов надо указывать
                     именно такое значение: 'multipart/form-data'
    > action       - Ссылка на PHP скрипт, который примет и обработает файл
                     > Не забыть заключить значение action в двойные кавычки "",
                       а то он не воспримит файлы в пути которых есть пробелы,
                       вместо: 'c:\program files' он примет 'c:\program'
    > method       - Метод запроса
    -->
    <form enctype='multipart/form-data'
          action="<?=$_SERVER['PHP_SELF']?>"
          method='POST'>

        <!-- Это скрытое поле MAX_FILE_SIZE должно быть указано до поля загрузки файла
        > По сути - это проверка размера файла на стороне клиента, чтобы он долго
          его не грузил лишь за тем, чтобы под конец узнать, что размер файла
          привышает допустимый на сервере
          > MAX_FILE_SIZE будет применен к каждому файлу в отдельности, который идет
            после этого поля в этой форме.
          > Это поле легко может быть перезаписано с клиентской стороны, поэтому оно
            нужно лишь для удобства клиента, а проверку файла надо тщательно проводить
            с серверной стороны.
        > name     - должно быть == 'MAX_FILE_SIZE'
        > value    - Сюда вписать значение из директивы upload_max_filesize в ini.php
                     > !! В байтах! Значение вроде '16M' будет принято за '0'
                       > Для этого используется пользовательская функция get_maxFileSizeToDownloadInBytes()
        -->
        <input type='hidden'
               name='MAX_FILE_SIZE'
               value=<?= get_maxFileSizeToDownloadInBytes(); ?> />

        <!-- кнопки, открывающие окно для загрузки файла в браузер
             > name       - определяет имя файла в массиве $_FILES
        -->
        <input name=<?=$filename; ?> type="file" />
        <input name=<?=$filename.'2'; ?> type="file" />  <!-- 2-й файл здесь не обрабатывется, он просто для того, чтобы показать, что он может здесь быть -->
        <!-- кнопка для отправки файла
             > value      - надпись на кнопке
        -->
        <input type='submit'
               value='Загрузить файл' />   <!-- Надпись на кнопке -->
    </form>
    <?php
    echo 'Максимальный размер файла, который примет сервер == ' . get_maxFileSizeToDownloadInBytes() . ' байт';
    // Посмотреть данные о загруженном файле в массиве $_FILES
    echo "<br><br>Содержимое массива \$_FILES: <pre>";
    print_r($_FILES);
    echo "<br></pre>";



    // Проверка на ошибки при загрузке файла
    // > Если метод запроса ресурса - POST
    // > Если в массиве $_FILES файла с таким именем нет
    if(!isset($_FILES[$filename]) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $err_arr = error_get_last();
        echo '<br><b>Ошибка! </b> Файл не загрузился!';
        echo '<br>Имя файла: ' . $filename;
        echo '<br>Тип ошибки: ' . $err_arr['type'];
        echo '<br>Сообщение об ошибке: ' . $err_arr['message'];
        // ... здесь можно обработать возможные ошибки ...
        exit;  // раз файла нет, то завершить.
    }
    // Обработка загруженного файла
    if(isset($_FILES[$filename]["name"])) {  // если файл загрузился во временную папку
        // Если файл загружен успешно, перемещаем его из временной в конечную директорию
        if(is_uploaded_file($_FILES[$filename]["tmp_name"]))
        {
            // Если файл загружен успешно, перемещаем его из временной директории в конечную
            $finalDirPath = 'C:\php-5.5.0-Win32-VC11-x64\upload_final\\' . $_FILES[$filename]["name"];
            move_uploaded_file($_FILES[$filename]["tmp_name"], $finalDirPath);
            echo "<br>Файл: " . $_FILES[$filename]['name'] .
                "<br>перемещен в постоянную директорию по адресу: " . $finalDirPath;
        } else {
            echo("Ошибка загрузки файла");
        }
    }



    // -------------------> Вспомогательные функции <-------------------

    /**
     * Возвращает MAX размер файла из php.ini директивы upload_max_filesize в байтах.
     * @author German Manvelov <4gekkman@gmail.com>
     * @version 1.0
     * @return int MAX размер файла, который может принять PHP, в байтах.
     */
    function get_maxFileSizeToDownloadInBytes() {
        // Получить MAX размер файла из php.ini директивы upload_max_filesize
        // > Перевести его в байты, и вернуть.
        $filesize = ini_get('upload_max_filesize');   // размер файла
        $filesize = mb_strtolower($filesize);         // перевести в нижний регистр
        $arr = str_split($filesize, 2);               // разбить строку на массив символов по 2 байта на каждый

        // размер мог быть передан либо в байтах, либо в виде вроде: '16K' | '16M' | '16G'
        // > Атрибут value HTML формы принимает значение только в байтах, переведем же его в них
        $multiplier = 1;
        switch($arr[count($arr)-1]) {
            case 'k': $multiplier = 1024; break;
            case 'm': $multiplier = 1024*1024; break;
            case 'g': $multiplier = 1024*1024*1024; break;
        }
        if($multiplier != 1) array_pop($arr);  // если последний символ - буковка, удалить ее из массива
        $result = implode('',$arr);            // склеить массив в строку. Результат: в байтах.
        $result *= $multiplier;                // ... умножить его на полученный множитель
        return $result;                          // вернуть результат: в байтах
    }


?> 
