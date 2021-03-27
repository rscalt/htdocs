<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') //если получили POST-запрос
    processShowForm(); //обрабатываем
else
    showSearchForm(); //иначе выдаем дефолтную форму для заполнения


function showSearchForm()
{
    print <<<_HTML_
        <hr>
        <form method="POST" name="ПОИСК" action="$_SERVER[PHP_SELF]">
            <label> 
                Введите запрос: 
                    <input type="text" name="s_query"> 
                <input type="submit" name "s_button" value="Найти">
            </label>
        </form>
        <hr>
    _HTML_;
    //форма выдает POST-запрос к серверу с s_query
}

function processShowForm()
{
    print "Вы искали: {$_POST['s_query']}";
    showSearchForm(); //возвращаем обратно
};
