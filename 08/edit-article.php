<?php
    require './includes/init.php';
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = require './includes/db.php';
        $article = Article::getById($id, $dbc);
        //var_dump($article);
        if (!$article) {
            die("there is no article with this id");
        }
    } else {
        die("there is no id");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $article->title = $_POST["title"];
        $article->content = $_POST["content"];
        $article->published_at = empty($_POST["published_at"])?null:$_POST["published_at"];
        if ($article->update($dbc)) {
            Url::redirect("08/article?id=$article->id");
            exit();
        }
        
    }
    require("./includes/article-form.php");
    require("./includes/footer.php");
?>