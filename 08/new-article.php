<?php
    require './includes/init.php';
    if (!Auth::isLoggedIn()) {
        die("<a href='./login.php'>log in </a>to see this page");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $article = new Article();
        $article->title = $_POST["title"];
        $article->content = $_POST["content"];
        $article->published_at = empty($_POST["published_at"])?null:$_POST["published_at"];
        if ($article->validate()) {
            $dbc = require './includes/db.php';
            $id = $article->create($dbc);
            //var_dump($id);
            //exit();
            if ($id) {
                URL::redirect("08/article.php?id=$id");
            }
        }
    }
?>
<?php require("./includes/article-form.php");?>
<?php require("./includes/footer.php");?>