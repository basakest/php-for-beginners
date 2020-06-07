<?php
    require '../includes/init.php';
    Auth::requireLogIn();
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = require '../includes/db.php';
        //var_dump($dbc);exit();
        $article = Article::getWithCategory($dbc, $id);
        //var_dump($article);
        //exit();
    } else {
        $article = null;
    }   
?>
<?php require('../includes/header.php'); ?>
        <h1>articles</h1>
        <?php 
            //var_dump($article); false
            if (empty($article)): 
                echo '<p>no article found</p>';
            else:
        ?>
        <ul>
            <li>
                <h2><?= htmlspecialchars($article[0]['title']) ; ?></h2>
                <time><?php echo $article[0]["published_at"] ?? "unpublished" ?></time>
                <?php if (isset($article[0]['category_name'])): ?>
                    <p>Category:
                    <?php foreach($article as $v):?>
                        <?=htmlspecialchars($v['category_name']);?>
                    <?php endforeach;?>
                    </p>
                <?php endif;?>
                <?php if (isset($article[0]['image_file'])): ?>
                <img src="/08/uploades/<?=$article[0]['image_file'];?>" alt="article image" />
                <?php endif;?>
                <p><?= htmlspecialchars($article[0]['content']) ; ?></p>
            </li>
       
        </ul>
        <a href="./edit-article.php?id=<?=$id;?>">edit article</a>
        <a class="delete" href="./delete-article.php?id=<?=$id;?>">delete article</a>
        <a href="./edit-article-image.php?id=<?=$id;?>">edit article image</a>
        <?php endif; ?>
 <?php require('../includes/footer.php'); ?>       