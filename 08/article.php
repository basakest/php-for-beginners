<?php
    require("./includes/database.php");
    require("./includes/article.php");
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = getDB();
        $article = getArticle($id, $dbc);
    } else {
        $article = null;
    }
    
?>
<?php require('./includes/header.php'); ?>
        <h1>articles</h1>
        <?php 
            if (empty($article)): 
                echo '<p>no article found</p>';
            else:
        ?>
        <ul>
        
            <li>
                <h2><?= htmlspecialchars($article['title']) ; ?></h2>
                <p><?= htmlspecialchars($article['content']) ; ?></p>
            </li>
       
        </ul>
        <a href="./edit-article.php?id=<?=$id;?>">edit article</a>
        <a href="./delete-article.php?id=<?=$id;?>">delete article</a>
        <?php endif; ?>
 <?php require('./includes/footer.php'); ?>       