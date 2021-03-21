<?php

function getItemsFromDate($date)
{
    $filename = __DIR__ . "/data.json";
    $result = [];

    if (file_exists($filename))
        $result = json_decode(file_get_contents($filename), true);

    $result = array_filter(
        $result,
        function ($block) use ($date) {
            return (strtotime($block['created']) >= strtotime($date));
        }
    );

    return $result;
}

echo "<pre>";
print_r(getItemsFromDate("20.01.2020 12:00:00"));
echo "</pre>";
