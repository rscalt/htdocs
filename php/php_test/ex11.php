<!-- 
    11. Создать форму с input[type="file"]. В неё загружать файл. Сохранять его рядом в папку image если он расширения jpg или png, иначе отдавать ошибку. Проверку сделать в виде функции validateFile($name); 
-->

<?php
printForm();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isUploadSuccess()) {

    print "<br>Проверка файла...";

    $name = $_FILES['userfile_sent']['type'];
    //print "<br>\$name = $name"; //debug

    if (validateFile($name)) {
        print "<br>Проверка файла завершена успешно!";
        print "<br>Загрузка файла...";
        if (saveFile() == true)
            print "<br>Загрузка файла завершена успешно!";
    } else
        print "<br>Неверное расширение файла!";
} else
    return 0;

//форма для загрузки
function printForm(): void
{
    print <<< _HTML_
<form enctype="multipart/form-data" action="$_SERVER[PHP_SELF]" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />

    <label name = "upload"> Загрузить файл:</label> 
        <input name="userfile_sent" type="file" />
            <input type="submit" value="Отправить файл" />
</form>
_HTML_;
}

//максимальный размер файла у формы = 10_Мб
function isUploadSuccess(): bool
{
    if ($_FILES['userfile_sent']['error'] == 0) {
        print "<br> Передача файла...";
        print "<br>Передача файла завершена успешно!";
        return true;
    } else if ($_FILES['userfile_sent']['error'] == 4) {
        print "<br>Ошибка: файл не выбран. Пожалуйста, выберите файл.";
        return false;
    } else {
        print "<br>Ошибка загрузки файла. Возможно, некорректный тип и/или размер.";
        return false;
    }
}

//простая проверка на захардкоженные форматы через MIME-type
//достаточная для тестового задания)))
function validateFile($name): bool
{

    if ($name == "image/jpeg" || $name == "image/png") {
        //print "<br>validateFile() = true"; //debug
        return true;
    } else {
        //print "<br>validateFile = false"; //debug
        return false;
    }
}

//сохранение файла в /image
//без проверки на возможную перезапись файла в случае совпадения названия с уже существующим
function saveFile(): bool
{
    $save_folder = "/image/"; //имя каталога для сохранения переданного файла
    $current_dir = getcwd(); //папка скрипта
    $uploaddir = "$current_dir . $save_folder"; //путь до каталога для сохранения
    $uploadfile = $uploaddir . basename($_FILES['userfile_sent']['name']);

    if (move_uploaded_file($_FILES['userfile_sent']['tmp_name'], $uploadfile))
        return true;
    else
        return false;
}
?>