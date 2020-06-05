<?php
    require '../includes/init.php';
    require '../includes/header.php';
    Auth::requireLogIn();
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = require '../includes/db.php';
        $article = Article::getById($id, $dbc);
        if (!$article) {
            die("there is no article with this id");
        }
    } else {
        die("there is no id");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // delete from computer
        $previous_image = $article->image_file;
        if (!empty($previous_image)) {
            unlink("../uploades/$article->image_file");
        }
        // delete from mysql
        $article->image_file = null;
        if ($article->setImageFile($dbc)) {
            Url::redirect("/08/admin/article.php?id=$article->id");
        }  
    }
?>
<h2>delete article image</h2>
<form method="post">
    <p>Are you sure to delete this image?</p>
    <a href="article.php?id=<?=$article->id;?>">Cancel</a>
    <button>Delete</button>
</form>
<?php
    require("../includes/footer.php");
?>