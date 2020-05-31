<?php
    require("./includes/header.php");
    require("./classes/Database.php");
    require("./classes/Article.php");
    require("./includes/url.php");
    require("./includes/auth.php");
    session_start();
    if (!isLoggedIn()) {
        die("<a href='./login.php'>log in </a>to see this page");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $article = new Article();
        $article->title = $_POST["title"];
        $article->content = $_POST["content"];
        $article->published_at = empty($_POST["published_at"])?null:$_POST["published_at"];
        if ($article->validate()) {
            $db = new Database();
            $dbc = $db->getConn();
            $id = $article->create($dbc);
            //var_dump($id);
            //exit();
            if ($id) {
                redirect("08/article.php?id=$id");
            }
        }
    }
?>
<?php require("./includes/article-form.php");?>
<?php require("./includes/footer.php");?>