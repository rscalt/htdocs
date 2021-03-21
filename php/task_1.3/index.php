<?php

$array = [
    [
        'sort' => '20',
        'name' => 'Mike'
    ],
    [
        'sort' => '10',
        'name' => 'Adam'
    ],
    [
        'sort' => '40',
        'name' => 'Stive'
    ],
    [
        'sort' => '300',
        'name' => 'Jane'
    ],
];

print "Before sorting:\n ";
print_r($array);

usort($array, function($p1, $p2) {
    return $p2['sort'] <=> $p1['sort'];
});

print "After sorting:\n ";
print_r($array);
