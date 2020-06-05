<?php
    require './includes/init.php';
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = require './includes/db.php';
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
                <?php if (isset($article->image_file)): ?>
                <img src="/08/uploades/<?=$article->image_file;?>" alt="article image" />
                <?php endif;?>
                <p><?= htmlspecialchars($article->content) ; ?></p>
            </li>
       
        </ul>
        <?php endif; ?>
 <?php require('./includes/footer.php'); ?>       