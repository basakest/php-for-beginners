<?php
    require("./includes/header.php");
    require("./includes/database.php");
    $errors = [];
    $title = "";
    $content = "";
    $published_at = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST["title"];
        $content = $_POST["content"];
        $published_at = empty($_POST["published_at"])?null:$_POST["published_at"];
        if (empty($title)) {
            $errors[] = "please fill the title";
        }
        if (empty($content)) {
            $errors[] = "please fill the content";
        }
        if (isset($published_at)) {
            $published_at = date_create_from_format("Y-m-d H:i:s", $published_at);
            if ($published_at === false) {
                $errors[] = "invalid date and time";
            } else {
                $date_errors = date_get_last_errors();
                if ($date_errors["warnning_count"] > 0) {
                    $errors[] = "invalid date and time";
                }
            }
        }
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
                if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] != "off")) {
                    $protocal = "https";
                } else {
                    $protocal = "http";
                }
                $url = "$protocal://$_SERVER[HTTP_HOST]/08/article.php?id=$id";
                header("Location: $url");
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
<form method="post">
    <h1>My blog</h1>
    <h2>New article</h2>
    <?php if(!empty($errors)):?>
    <ul>
    <?php foreach($errors as $error):?>
    <li><?= $error;?></li>
    <?php endforeach;?>
    </ul>
    <?php endif;?>
    <div>
        <label for="title">title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($article['title']) ;?>" />
    </div>
    <div>
        <label for="content">content</label>
        <textarea name="content" id="content" cols="30" rows="10">
            <?= htmlspecialchars($article['content']) ;?>
        </textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at" value="<?= $published_at;?>" />
    </div>
    <button>Add</button>
</form>
<?php require("./includes/footer.php"); ?>