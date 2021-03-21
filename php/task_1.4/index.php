
<?php

$filename = __DIR__ . "/data.json";
$GLOBALS['result'] = [];

print "The \$result is ";
print_r($result);

if (file_exists($filename))
    $result = json_decode(file_get_contents($filename), true);
else print "Error reading JSON!";
?>

<? foreach ($result as $item): ?>
<div>
    <b><?= $item['name'] ?></b><br>
    <small>Viewed: <?= $item['viewed'] ?></small><br>
    <?= $item['text'] ?><br><br>
    <a href="?set_viewed = <?= $item['id'] ?>" > I watched</a>
    <hr>
</div>
<? endforeach; ?>
