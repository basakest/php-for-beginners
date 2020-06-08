<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>title</title>
        <link rel="stylesheet" href="/08/css/jquery.datetimepicker.min.css">
        <link rel="stylesheet" href="/08/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
        <main>
            <nav>
                <ul class="nav">
                    <?php if (Auth::isLoggedIn()): ?>
                        <li class="nav-item">
                            <a href="/08/logout.php" class="nav-link">log out</a>
                        </li>
                        <li class="nav-item">
                            <a href="/08/index.php" class="nav-link">home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/08/admin/index.php" class="nav-link">admin</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="/08/login.php" class="nav-link">log in</a>
                        </li>
                    <?php endif;?>
                </ul>
            </nav>