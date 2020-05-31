<?php
    require("./classes/Database.php");
    require("./classes/Article.php");
    require("./includes/article.php");
    require("./includes/url.php");
    $id = $_GET["id"];
    if (isset($id)) {
        $db = new Database();
        $dbc = $db->getConn();
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
            redirect("08/article?id=$article->id");
            exit();
        }
        
    }
    require("./includes/article-form.php");
    require("./includes/footer.php");
?>