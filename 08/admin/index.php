<?php
    require '../includes/init.php';
    Auth::requireLogIn();
    $dbc = require '../includes/db.php';
    $articles = Article::getAll($dbc);
?>
<?php require('../includes/header.php'); ?>       
        <h1>Administration</h1>
        <a href="./new-article.php">add article</a><br />
        <?php 
            if (empty($articles)): 
                echo '<p>there is no articles now</p>';
            else:
        ?>
        <table>
            <thead>Title</thead>
        <?php foreach($articles as $article): ?>
            <tr>
                <td>
                    <a href="./article.php?id=<?= $article['id']?>"><?= htmlspecialchars($article['title']) ; ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
        <?php endif; ?>
<?php require('../includes/footer.php'); ?> 