<?php 
    require '../includes/init.php';
    require '../includes/header.php';
    Auth::requireLogIn();
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = require '../includes/db.php';
        $article = Article::getById($id, $dbc);
        $categories = Category::getAll($dbc);
        $category_ids = array_column($article->getCategories($dbc), 'id');
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
        $category_ids = $_POST["category"] ?? [];
    
        if ($article->update($dbc)) {
            $article->setCategories($dbc, $category_ids);
            Url::redirect("/08/admin/article?id=$article->id");
            exit();
        }  
    }
    require("./includes/article-form.php");
    require("../includes/footer.php");
?>