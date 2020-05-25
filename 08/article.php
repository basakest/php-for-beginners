<?php
    require('./includes/database.php');
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $sql = "select * from article where id = $_GET[id];";
        if (($result = mysqli_query($dbc, $sql)) === false) {
            echo mysqli_error($dbc);
        } else {
            $article = mysqli_fetch_assoc($result);
            //var_dump($result);
            //var_dump($articles);
        } 
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
                <h2><?= $article['title']; ?></h2>
                <p><?= $article['content']; ?></p>
            </li>
       
        </ul>
        <?php endif; ?>
 <?php require('./includes/footer.php'); ?>       