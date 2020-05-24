<?php
    $db_host = "127.0.0.1";
    $db_name = "cms";
    $db_user = "cms_www";
    $db_pwd = "12345";

    $dbc = mysqli_connect($db_host, $db_user, $db_pwd, $db_name);

    if (mysqli_connect_errno()) {
        echo mysqli_connect_errno();
        exit();
    }

    $sql = "select * from article;";
    if (($result = mysqli_query($dbc, $sql)) === false) {
        echo mysqli_error($dbc);
    } else {
        $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //var_dump($result);
        //var_dump($articles);
    } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>title</title>
    </head>
    <body>
        <h1>articles</h1>
        <?php 
            if (empty($articles)): 
                echo '<p>there is no articles now</p>';
            else:
        ?>
        <ul>
        <?php foreach($articles as $article): ?>
            <li>
                <h2><?= $article['title']; ?></h2>
                <p><?= $article['content']; ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </body>
</html>