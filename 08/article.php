<?php
    require './includes/init.php';
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = require './includes/db.php';
        $article = Article::getWithCategory($dbc, $id, true);
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
                <h2><?= htmlspecialchars($article[0]["title"]) ; ?></h2>
                <time datetime="<?=$article[0]['published_at'];?>">
                    <?php $datetime = new DateTime($article[0]['published_at']);
                    echo $datetime->format("j F, Y");?>
                </time>
                <?php if (isset($article[0]['category_name'])): ?>
                    <p>Category:
                    <?php foreach($article as $v):?>
                        <?=htmlspecialchars($v['category_name']);?>
                    <?php endforeach;?>
                    </p>
                <?php endif;?>
                <?php if (isset($article[0]["image_file"])): ?>
                <img src="/08/uploades/<?=$article[0]["image_file"];?>" alt="article image" />
                <?php endif;?>
                <p><?= htmlspecialchars($article[0]["content"]) ; ?></p>
            </li>
       
        </ul>
        <?php endif; ?>
 <?php require('./includes/footer.php'); ?>       