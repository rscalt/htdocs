t1
<?php

    $filename = __DIR__ . "/data.json";
    $result = [];
    //$item = null;

    /* print "The \$result is ";
    print_r($result); */

    if (file_exists($filename)) {
        $result = json_decode(file_get_contents($filename), true);

foreach ($result as $item)
print
"    
    <div>
        <b> {$item['name']} </b><br>
        <small>Viewed: {$item['viewed'] }</small><br>
        {$item['text']}<br><br>
        <hr>
    </div>
";
    }
?>