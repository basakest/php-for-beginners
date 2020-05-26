<?php 
    require("./includes/header.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require("./includes/database.php");
        $title = mysqli_escape_string($dbc, $_POST['title']);
        $content = mysqli_escape_string($dbc, $_POST['content']);
        $published_at = mysqli_escape_string($dbc, $_POST['published_at']);
        /*
        $sql = "insert into article(title, content, published_at) values ('$title', '$content', '$published_at')";
        //var_dump($sql);
        //exit();
        $result = mysqli_query($dbc, $sql);
        if ($result === false) {
            echo mysqli_error($dbc);
            exit;
        } else {
            $id = mysqli_insert_id($dbc);
            echo "id of the article is $id";
        }
        */
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
        }
    }
?>
<form method="post">
    <h1>My blog</h1>
    <h2>New article</h2>
    <div>
        <label for="title">title</label>
        <input type="text" name="title" id="title" />
    </div>
    <div>
        <label for="content">content</label>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at" />
    </div>
    <button>Add</button>
</form>
<?php require("./includes/footer.php"); ?>