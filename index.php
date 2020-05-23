<?php
    $name = "alice";
    $age = 23;
    $list = ['a', 'b', 'c'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>title</title>
    </head>
    <body>
        <h1>mix html and php</h1>
        <p>hello, <?= $name . $age;?></p>
        <ul>
        <?php foreach($list as $i => $v): ?>
            <li><?= $i; ?></li>
        <?php endforeach; ?>
        </ul>
    </body>
</html>