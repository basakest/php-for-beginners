<?php
    require('./includes/database.php');

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
        <h1>articles</h1>
        <?php 
            if (empty($articles)): 
                echo '<p>there is no articles now</p>';
            else:
        ?>
        <ul>
        <?php foreach($articles as $article): ?>
            <li>
                <a href="./article.php?id=<?= $article['id']?>"><h2><?= $article['title']; ?></h2></a>
                <p><?= $article['content']; ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
<?php require('./includes/footer.php'); ?> 