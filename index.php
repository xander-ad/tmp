<?php
$res = false;
$msg = false;

$text = $_POST['text'] ?? false;
$str = $_POST['str'] ?? false;
if (is_string($text) && is_string($str)) {
    $text = strip_tags($text);
    $str = strip_tags($str);
    $res = substr_count($text, $str) ?? 'Not found';

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tst</title>
</head>
<body>
    <form action="" method="post">
        <p>Text</p>
        <textarea name="text" cols="50" rows="4" ><?=$text?></textarea><br>
        <p>Find</p>
        <input name="str" type="text" value="<?=$str?>">
        <input type="submit" name="find">
    </form>
    <?php
        if ($msg) {
            echo "<p>Msg: $msg</p>";
        }
        if ($res) {
            echo "<p>Result: $res</p>";
        }
    ?>
</body>
</html>

