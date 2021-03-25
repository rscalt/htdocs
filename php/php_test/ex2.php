<!-- 
2. Создайте массив $days, где внутри ключей ru и en будут сокращенные названия дней 
(пн, вт, ... | mn, ts, ...). 
Создайте переменную $lang и присвойте ей id языка (ru или en). 
Создайте переменную $day, присвойте ей номер дня. 
А теперь выведите названия дня в заданном языке.
 -->

<?php

$days = array(
    "ru" => array(1 => 'пн','вт','ср','чт','пт','сб','вс'),
    "en" => array(1 => 'mn','ts','wd','ts','fd','st','sn')
);

$lang = 'en'; //hardcoded
$day = 5; //hardcoded

print "\$days array: \n";
print_r($days);

print "\n selected locale: "; //ru / en
print "\"$lang\"";

print "\n selected day number: "; //естественный номер дня недели (пн = 1 и т.д.)
print "\"$day\"";

//
print "\n Weekday number $day for $lang locale is: \n"; //локализованное сокращенное название дня недели
//логикой задачи подразумеваетcя вывод одного названия одного дня, иначе зачем нам $day?
print "\"{$days[$lang][$day]}\"";



