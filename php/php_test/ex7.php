<!-- 7. Создайте форму "Авторизация". 
Сделайте input[type="text"], input[type="password"]. 
Форма при отправке не должна добавлять данные в адресную строку. 
В скрипте завести переменные $login, $password. 
Если форма отправлена - проверять, 
прошел ли человек авторизацию 
по заданным в $login и $password значениям. 
Если вошел - задавать в сессию ключ "LOGIN" и значение "YES". 
Если этот ключ задан - вместо формы выводить "Привет, LOGIN!". -->

<?php

//sgrade_secure_db.pgsql


$login = 'ross';
$password = 'pass';

show_page();

function show_page()
{
    if ( $_SESSION['LOGIN'] == 'YES' ) {
        showGreeting();
        //sessionUserClearSession(); //для дебага
    } else

    if ($_SERVER['REQUEST_METHOD'] == 'POST') //если форма отправлена...
    {
        checkCredentials(); //...проверяем прохождение авторизации
        if (checkCredentials() == 1); {
            sessionUserLogIn();  //...если вошел - задаем ключи
                show_page();
        }
    } else 
        showLoginForm(); //иначе выдаем дефолтную форму
}



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

function checkCredentials()
{
    //верный ввод
    if ($_POST['f_login'] == $GLOBALS['login'] &&
        $_POST['f_password'] == $GLOBALS['password'])
        return 1;
    else
        print "Bad login/password!";
}

function sessionUserLogIn()
//могут ли нам понадобится дополнительные параметры?
{
    session_start();
    $_SESSION['LOGIN'] = 'YES';
    $_SESSION['NAME'] = 'ross';
}
function sessionUserClearSession()
//могут ли нам понадобится дополнительные параметры?
{
    $_SESSION = [];
}

function showGreeting()
{
    print "Привет, {$_SESSION['NAME']}!";
}

