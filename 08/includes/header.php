<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>title</title>
    </head>
    <body>
        <main>
            <nav>
                <ul>
                    <?php if (Auth::isLoggedIn()): ?>
                        <li><a href="/08/logout.php">log out</a></li>
                        <li><a href="/08/index.php">home</a></li>
                        <li><a href="/08/admin/index.php">admin</a></li>
                    <?php else: ?>
                        <li><a href="/08/login.php">log in</a></li>
                    <?php endif;?>
                </ul>
            </nav>