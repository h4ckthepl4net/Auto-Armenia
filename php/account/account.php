<?php
    session_start();
    session_regenerate_id();

    if(!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])) {
        header('location: /auth/login');
        session_unset();
        session_destroy();
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/ico" href="/assets/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/main.css">
    <link rel="stylesheet" type="text/css" href="/css/account/account.css">
    <title>Auto Armenia | Account</title>
</head>

<body>
    <div class="header">
        <?php
        include($_SERVER['DOCUMENT_ROOT']."/php/includes/header.php");
        ?>
    </div>
    <div class="global_content">
        <div class="content-container">
            <form action="/auth/logout" method="POST">
                <button type="submit" class="logout-button">Log out</button>
            </form>
        </div>
        <div class="footer">
            <?php
            include($_SERVER['DOCUMENT_ROOT']."/php/includes/footer.php");
            ?>
        </div>
    </div>
    <div id="overlay-container" class="overlay-container">
    </div>
    <script type="module" src="/main.js"></script>
    <script src="/js/account.js"></script>
</body>

</html>