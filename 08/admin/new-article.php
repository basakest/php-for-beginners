<?php
    require '../includes/init.php';
    $dbc = require '../includes/db.php';
    Auth::requireLogIn();
    $article = new Article();
    $categories = Category::getAll($dbc);
    $category_ids = array_column($article->getCategories($dbc), 'id');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $article = new Article();
        $article->title = $_POST["title"];
        $article->content = $_POST["content"];
        $article->published_at = empty($_POST["published_at"])?null:$_POST["published_at"];
        $category_ids = $_POST["category"] ?? [];
        if ($article->validate()) {
            $id = $article->create($dbc);
            if ($id) {
                $article->id = $id;
                $article->setCategories($dbc, $category_ids);
                URL::redirect("/08/article.php?id=$id");
            }
        }
    }
?>
<?php require("./includes/article-form.php");?>
<?php require("../includes/footer.php");?>