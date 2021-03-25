<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    processShowForm();
else 
    showSearchForm();


function showSearchForm()
{
    print <<<_HTML_
        <form method="POST" action="$_SERVER[PHP_SELF]">
        Введите запрос: <input type="text" name="s_query">
        <br/>
        <input type="submit" value="Поиск">
        </form>
    _HTML_;
}

function processShowForm()
{
    print "Вы искали: {$_POST['s_query']}";
};
