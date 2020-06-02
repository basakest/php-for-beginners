<?php
    require './includes/init.php';
    $dbc = require './includes/db.php';
    $articles = Article::getAll($dbc);
     
?>
<?php require('./includes/header.php'); ?>
        
        <h1>articles</h1>
        <a href="./new-article.php">add article</a>
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