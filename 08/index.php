<?php
    require './includes/init.php';
    $dbc = require './includes/db.php';
    $paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($dbc, true));
    $articles = Article::getPage($dbc, $paginator->limit, $paginator->offset, true);
    //var_dump($articles);exit();
?>
<?php require('./includes/header.php'); ?>
        
        <h1>articles</h1>
        <?php 
            if (empty($articles)): 
                echo '<p>there is no articles now</p>';
            else:
        ?>
        <ul class="list-group">
        <?php foreach($articles as $article): ?>
            <li class="list-group-item">
                <a href="./article.php?id=<?= $article['id']?>"><h2><?= htmlspecialchars($article['title']) ; ?></h2></a>
                <time datetime="<?=$article['published_at'];?>">
                    <?php $datetime = new DateTime($article['published_at']);
                    echo $datetime->format("j F, Y");?>
                </time>
                <?php if ($article['category_names']):?>
                    <p>Category:
                        <?php foreach ($article['category_names'] as $v):?>
                            <?=$v;?>
                        <?php endforeach;?>
                    </p>
                <?php endif;?>
                <p><?= htmlspecialchars($article['content']); ?></p>
            </li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
<?php require './includes/pagination.php';?>
<?php require('./includes/footer.php'); ?> 