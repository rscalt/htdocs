<?php

//sgrade_secure_db.pgsql
$login = 'user';
$password = 'pass';

if (isset($_SESSION['LOGIN']) && $_SESSION['LOGIN'] == 'YES') //если вошли
    showGreetingPage();
else if (
    isset($_SERVER['REQUEST_METHOD']) &&
    $_SERVER['REQUEST_METHOD'] == 'POST'
) { //если отправили форму
    if (checkCredentials()) { //проверили реквизиты
        if (sessionUserLogIn()) //успешно вошли и создали сессию
            showGreetingPage();
        else print "<br>Error logging in or starting session!";
    } else print "<br>Bad login/password!";
} else showLoginForm(); //иначе выдаем дефолтную форму


function showLoginForm()
{
    print <<< _HTML_
        <form name ="autorization" action="$_SERVER[PHP_SELF]" method="POST">
            <table>
            <tr>
                <td> login </td>
                <td> <input type="text" name ="f_login"> </td>
            </tr>

            <tr>
                <td> password </td>
                <td> <input type="password" name ="f_password"> </td>
            </tr>
            <tr>
                <td><input type="submit" name "f_button" value="Вход"></td>
            </tr>
            <table>
        </form>
        
    _HTML_;
}

//проверка реквизитов пользователя
function checkCredentials(): bool
{
    $creds_correct = false;
    $creds_correct = ($_POST['f_login'] == $GLOBALS['login'] &&
        $_POST['f_password'] == $GLOBALS['password']);
    return $creds_correct;
}
//вход и начало сессии
function sessionUserLogIn(): bool
{
    if (session_start()) {
        $_SESSION['LOGIN'] = 'YES';
        $_SESSION['NAME'] = $GLOBALS['login'];
        return true;
    } else return false;
}

//отображение страницы приветствия
function showGreetingPage()
{
    print <<< _HTML_
    Привет, {$_SESSION['NAME']}!
    _HTML_;
    //$_SESSION = [];
}
