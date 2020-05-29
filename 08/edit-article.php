<?php
    require("./includes/database.php");
    require("./includes/article.php");
    require("./includes/url.php");
    $id = $_GET["id"];
    if (isset($id)) {
        $dbc = getDB();
        $article = getArticle($id, $dbc);
        //var_dump($article); NULL
        if (isset($article)) {
            $title = $article["title"];
            $content = $article["content"];
            $published_at = $article["published_at"];
        } else {
            die("there is no article with this id");
        }
    } else {
        die("there is no id");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $published_at = empty($_POST["published_at"])?null:$_POST["published_at"];
        $errors = validateArticle($title, $content, $published_at);
        if (empty($errors)) {
            $title = mysqli_escape_string($dbc, $title);
            $content = mysqli_escape_string($dbc, $content);
            $published_at = isset($published_at)?mysqli_escape_string($dbc, $published_at):null;
            $sql = "update article set title=?, content=?, published_at=? where id=?";
            $stmt = mysqli_prepare($dbc, $sql);
            if ($stmt === false) {
                echo mysqli_error($dbc);
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);
                if (mysqli_stmt_execute($stmt)) {
                    redirect("08/article.php?id=$id");
                    
                } else {
                    echo mysqli_stmt_error($stmt);
                    exit();
                }
            }
            
            /*
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
                if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] != "off")) {
                    $protocal = "https";
                } else {
                    $protocal = "http";
                }
                $url = "$protocal://$_SERVER[HTTP_HOST]/08/article.php?id=$id";
                header("Location: $url");
                exit();
            }
            */
        }
    }
    require("./includes/article-form.php");
    require("./includes/footer.php");
?>