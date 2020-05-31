<?php
    require("./classes/Database.php");
    require("./classes/Article.php");
    $id = $_GET["id"];
    if (isset($id)) {
        $db = new Database();
        $dbc = $db->getConn();
        $article = Article::getById($id, $dbc);
        //var_dump($article);
        //exit();
    } else {
        $article = null;
    }   
?>
<?php require('./includes/header.php'); ?>
        <h1>articles</h1>
        <?php 
            //var_dump($article); false
            if (empty($article)): 
                echo '<p>no article found</p>';
            else:
        ?>
        <ul>
        
            <li>
                <h2><?= htmlspecialchars($article->title) ; ?></h2>
                <p><?= htmlspecialchars($article->content) ; ?></p>
            </li>
       
        </ul>
        <a href="./edit-article.php?id=<?=$id;?>">edit article</a>
        <a href="./delete-article.php?id=<?=$id;?>">delete article</a>
        <?php endif; ?>
 <?php require('./includes/footer.php'); ?>       