<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new = preg_replace('/[\w!@#$%^&*()_+-=:;<>\/\\\|~{}?\'"\[\]` ]/', '', $_POST['content']);
    //var_dump($new);
    //exit();
    echo "$new";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>test</title> 
    </head>
    <body>
        <form method="post">
            <textarea name="content" cols="30" rows="10"></textarea>
            <button>submit</button>
        </form>
    </body>
</html>

