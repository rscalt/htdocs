<?php
$days = array(
    "ru" => array(1 => 'пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'),
    "en" => array(1 => 'mn', 'ts', 'wd', 'ts', 'fd', 'st', 'sn')
);

$lang = 'en'; //hardcoded
$day = 5; //hardcoded

print "\$days array: \n";
print_r($days);

print "\n selected locale: "; //ru / en
print "\"$lang\"";

print "\n selected day number: "; //естественный номер дня недели (пн = 1)
print "\"$day\"";

print "\n Weekday number $day for $lang locale is: "; //локализованное сокращенное название дня недели
//логикой задачи подразумеваетcя вывод одного названия одного дня, иначе зачем нам $day?
print "\"{$days[$lang][$day]}\"";