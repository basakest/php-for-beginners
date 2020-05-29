<?php
    session_start();
    require('./includes/database.php');
    require("./includes/auth.php");
    $dbc = getDB();
    $sql = "select * from article;";
    if (($result = mysqli_query($dbc, $sql)) === false) {
        echo mysqli_error($dbc);
    } else {
        $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
        //var_dump($result);
        //var_dump($articles);
    } 
?>
<?php require('./includes/header.php'); ?>
        <?php if (isLoggedIn()):?>
            <p>you are log in now, click this to <a href="./logout.php">log out</a></p>
            <a href="./new-article.php">add article</a>
        <?php else:?>
            <p>you are not log in now, click this to <a href="./login.php">log in</a></p>
        <?php endif;?>
        
        <h1>articles</h1>
        <?php 
            if (empty($articles)): 
                echo '<p>there is no articles now</p>';
            else:
        ?>
        <ul>
        <?php foreach($articles as $article): ?>
            <li>
                <a href="./article.php?id=<?= $article['id']?>"><h2><?= htmlspecialchars($article['title']) ; ?></h2></a>
                <p><?= htmlspecialchars($article['content']); ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
<?php require('./includes/footer.php'); ?> 