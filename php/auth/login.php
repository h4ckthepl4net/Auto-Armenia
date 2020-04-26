<?php
    session_start();
    session_regenerate_id();

    if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in'])) {
        header('location: /account/account');
        exit();
    }
    $error = false;
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if(empty($email)) {
            $error = true;
        } else {
            $password = filter_input(INPUT_POST, 'password');
            if(empty($password) || !(7 < strlen($password) && strlen($password) < 256) ||
            !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) ||
            !preg_match('/[0-9]/', $password) || !preg_match('/[^\w]/', $password) ) {
                $error = true;
            } else {
                require $_SERVER['DOCUMENT_ROOT']."/php/includes/DB_connection.php";

                $stmt = new mysqli_stmt($mySqlConnection, "SELECT * FROM users WHERE email=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if(empty($result) || empty($result->num_rows)) {
                    $error = true; // TODO no account found
                } else {
                    $row = $result->fetch_assoc();
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['logged_in'] = $row['id'];
                        header("Location: /account/account");
                        exit();
                    } else {
                        $error = true;
                    }
                }
            }
        }
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
    <link rel="stylesheet" type="text/css" href="/css/auth/login.css">
    <link rel="stylesheet" type="text/css" href="/css/auth/login-register.css">
    <title>Auto Armenia</title>
</head>

<body>
    <div class="header">
        <?php
        include($_SERVER['DOCUMENT_ROOT']."/php/includes/header.php");
        ?>
    </div>
    <div class="global_content">
        <div class="content-container">
            <div class="auth-box">
                <br><div class="auth-box-header">Login | Մուտք</div><br>
                <form method="POST">
                    <?php if($error): ?>
                        <div class="form-error"> Login failed! </div>
                    <?php endif ?>
                    <input type="email" placeholder="E-mail" class="auth-input" name="email" required>
                    <div class="password-input-container">
                        <input type="password" placeholder="Password" class="auth-input" name="password" required>
                        <span class="password-unmask-icon" onclick="unmaskPassword(event)" material-icon>visibility</span>
                    </div>
                    <button type="submit" class="submit-button">Log In</button>
                </form>
                <div class="forgot-container">
                    <a href="" class="forgot-password-link">Forgot password?</a>
                </div>
                <a href="register" class="auth-redirect-link">
                    Don't have an account?
                </a>
            </div>
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
    <script src="/js/login.js"></script>
</body>

</html>