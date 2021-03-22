<?php

$filename = __DIR__ . "/data.json";
$result = [];

if (file_exists($filename)) {
    $result = json_decode(file_get_contents($filename), true);
    $unsaved = false;
} else 
    print "Error opening JSON!"; //и такое бывает
?>

<?php 
    foreach ($result as $item) : // здесь и далее в блоках короткие тэги заменены на длинные - иначе не везде работает 
?>
    <div>
        <b><?= $item['name'] ?></b><br>
        <small>Viewed: <?= $item['viewed'] ?></small><br>
        <?= $item['text'] ?><br><br>
        <a href="?set_viewed=<?= $item['id'] ?>"> I watched</a>
        <hr>
    </div>
<?php 
    endforeach; 
?>

<?php
//для краткости решения - get не причесан
$cookie_id_watched = $_COOKIE['id_watched'];

print "Cookie: id_watched = ";
print_r($cookie_id_watched);
print "<br>";

$id_set_viewed[] = $_GET['set_viewed'];


print "_GET['set_viewed'] = ";
print_r($id_set_viewed);
print "<br>";

if ($cookie_id_watched != $id_set_viewed)
    {
        print "<br>";
        print "\$id_set_viewed = $id_set_viewed";
        print "<br>";

        foreach ($result as &$item) :
            if (array_search($id_set_viewed, $item, true)) {
                //print " {$item['id']} key exists <br>";
                $item['viewed']++;
                setcookie('id_viewed', $id_set_viewed);
                //print "View count +1!";
                //print "<br>";
                $unsaved = true;
            }
        endforeach;
    }
?>

<?php
//есть несохраненные изменения?
if ($unsaved) {
    $json_dump = json_encode($result, JSON_THROW_ON_ERROR);
    file_put_contents($filename, $json_dump);
    //print "JSON dump successfull!";
    //print "<br>";
}


