<?php
$array_days = array(
    "ru" => array(1 => 'пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'),
    "en" => array(1 => 'mn', 'ts', 'wn', 'th', 'fr', 'st', 'sn')
);

$string_day = 'пт'; //значение для поиска

print "checkValue() returns: ";
print checkValue($array_days, $string_day);

function checkValue(array $arr, string $str) : string
{
    foreach ($arr as $i => $locale)
        foreach ($locale as $j => $day)
        {            
            if ($day == $str)
            { 
                //print "\n String '$str' is found in Array['$i']['$j'] = '$day'!\n"; //для дебага
                return $i;
            }
        }
    return "\n String '$str' is not found!";
}

?>