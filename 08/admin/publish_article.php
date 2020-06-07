<?php
require "../includes/init.php";
Auth::requireLogIn();
$dbc = require "../includes/db.php";
$article = Article::getById($_POST['id'], $dbc);
$published_at = $article->publish($dbc);
echo "<time>$published_at</time>";