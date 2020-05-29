<?php
$id = $_GET["id"];
if (isset($id)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require("./includes/database.php");
        require("./includes/url.php");
        require("./includes/article.php");
        $dbc = getDB();
        $article = getArticle($id, $dbc, "id");
        if (isset($article)) {
            $sql = "delete from article where id = ?";
            $stmt = mysqli_prepare($dbc, $sql);
            if ($stmt === false) {
                echo mysqli_error($dbc);
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "i", $id);
                if (mysqli_stmt_execute($stmt)) {
                    redirect("08/index.php");
                } else {
                    echo mysqli_stmt_error($stmt);
                    exit();
                }
            }
        } else {
            die("there is no article with this id");
        }
        
    } else {
        require("./includes/header.php");
    ?>
        <h2>delete</h2>
        <form method="post">
            <button>delete</button>
            <a href="./article.php?id=<?=$id;?>">cancel</a>
        </form>
    <?php
        require("./includes/footer.php");
    }
    
        
    
} else {
    die("there is no id");
}
