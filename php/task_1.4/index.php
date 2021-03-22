<?php
session_start(); // 1 сессия = 1 просмотр
if (isset($_SESSION['count']))
    $_SESSION['count']++;
else
    $_SESSION['count'] = 1;

print "You've looked at this page " . $_SESSION['count'] . ' times.';

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
$id_set_viewed = $_GET['set_viewed'];


print "_GET['set_viewed'] = ";
print_r($id_set_viewed);
print "<br>";

print "<br>";
print "\$id_set_viewed = $id_set_viewed";
print "<br>";

$news_id_exists = array_search($id_set_viewed, $item, true);
print "<br>";
print "\$news_id_exists = $news_id_exists";
print "<br>";


$session_is_unique =( $_SESSION['count'] <= 1) ? true : false;
print "<br>";
print "\$_SESSION['count'] = {$_SESSION['count']}";
print "<br>";

print "<br>";
print "\$session_is_unique = $session_is_unique";
print "<br>";


foreach ($result as &$item):
    if ($news_id_exists) {
        print " {$item['id']} key exists <br>";
        $item['viewed']++;
        print "View count increased!";
        $unsaved = true;
    }
endforeach;
?>

<?php
//есть несохраненные изменения?
if ($unsaved) {
    print "\$unsaved = $unsaved";
    print "<br>";
    $json_dump = json_encode($result, JSON_THROW_ON_ERROR);
    file_put_contents($filename, $json_dump);
    print "JSON dump successfull!";
}
