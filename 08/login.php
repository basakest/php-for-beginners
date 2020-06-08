<?php
require './includes/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dbc = require './includes/db.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (User::authenticate($dbc, $username, $password)) {
        Auth::logIn();
        Url::redirect("08/index.php");
    } else {
        $error = "username or password is wrong";
    }
}
?>
<?php require("./includes/header.php");?>
<h2>log in</h2>
<?php if (isset($error)): ?>
    <p><?=$error;?></p>
<?php endif;?>
<form method="post">
    <div class="form-group">
        <label for="username">username</label>
        <input type="text" name="username" id="username" class="form-control" />
    </div>
    <div class="form-group">
        <label for="password">password</label>
        <input type="password" name="password" id="password" class="form-control" />
    </div>
    <button class="btn btn-primary">log in</button>
</form>
<?php require("./includes/footer.php");?>
