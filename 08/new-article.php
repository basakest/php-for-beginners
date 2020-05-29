<?php
    require("./includes/header.php");
    require("./includes/database.php");
    require("./includes/article.php");
    require("./includes/url.php");
    require("./includes/auth.php");
    session_start();
    if (!isLoggedIn()) {
        //var_dump($_SESSION);
        die("<a href='./login.php'>log in </a>to see this page");
    }
    //$errors = [];
    $title = "";
    $content = "";
    $published_at = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $published_at = empty($_POST["published_at"])?null:$_POST["published_at"];
        $errors = validateArticle($title, $content, $published_at);
        if (empty($errors)) {
            $dbc = getDB();
            $title = mysqli_escape_string($dbc, $title);
            $content = mysqli_escape_string($dbc, $content);
            $published_at = isset($published_at)?mysqli_escape_string($dbc, $published_at):null;
            if (isset($published_at)) {
                $sql = "insert into article(title, content, published_at) values ('$title', '$content', '$published_at')";
            } else {
                $sql = "insert into article(title, content, published_at) values ('$title', '$content', null)";
            }
            $result = mysqli_query($dbc, $sql);
            if ($result === false) {
                echo mysqli_error($dbc);
                exit;
            } else {
                $id = mysqli_insert_id($dbc);
                redirect("08/article.php?id=$id");
            }
            
            /*
            $sql = "insert into article(title, content, published_at) values (?, ?, ?)";
            $stmt = mysqli_prepare($dbc, $sql);
            if ($stmt === false) {
                echo mysqli_error($dbc);
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, 'sss', $title, $content, $published_at);
                if (mysqli_stmt_execute($stmt)) {
                    $id = mysqli_insert_id($dbc);
                    echo "id of the article is $id";
                } else {
                    echo mysqli_stmt_error($stmt);
                }
            }*/
        }  
    }
?>
<?php require("./includes/article-form.php");?>
<?php require("./includes/footer.php");?>