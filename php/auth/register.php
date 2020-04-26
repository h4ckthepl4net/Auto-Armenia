<?php
    session_start();
    session_regenerate_id();

    if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in'])) {
        header('location: /account/account');
        exit();
    }

    $err_arr = array();
    $data_arr = array();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $data_arr['name'] = filter_input(INPUT_POST, 'name');
        $data_arr['surname'] = filter_input(INPUT_POST, 'surname');
        foreach(array_keys($data_arr) as $key) {
            if(!empty($data_arr[$key])) {
                $strLength = strlen($data_arr[$key]);
                if(1 < $strLength && $strLength < 256) {
                    $data_arr[$key] = trim($data_arr[$key]);
                    if(strpbrk($data_arr[$key], '^£$%&*()}{@#~?<>|=+¬') != false) {// TODO check string to not contain special chars
                        $err_arr[$key] = ucfirst($key).' cannot contain one of special characters';
                    }
                } else {
                    $err_arr[$key] = ucfirst($key)." length must be 256 > ($key length) > 1!";
                }
            } else {
                $err_arr[$key] = ucfirst($key)." field must be filled!";
            }
        }

        $data_arr['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if($data_arr['email'] === null) {
            $err_arr['email'] = "Email field must be filled!";
        } else if ($data_arr['email'] === false) {
            $err_arr['email'] = "Please enter correct email address!";
        }

        $data_arr['password'] = filter_input(INPUT_POST, 'password');
        if(!empty($data_arr['password'])) {
            $strLength = strlen($data_arr['password']);
            if(7 < $strLength && $strLength < 256) {
                if(!preg_match('/[A-Z]/', $data_arr['password']) ||
                   !preg_match('/[a-z]/', $data_arr['password']) ||
                   !preg_match('/[0-9]/', $data_arr['password']) ||
                   !preg_match('/[^\w]/', $data_arr['password'])) {
                    $err_arr['password'] = 'Password should contain at least one upper case letter, one number, and one special character!';
                } else {
                    $data_arr['password'] = password_hash($data_arr['password'], PASSWORD_DEFAULT);
                }
            } else {
                $err_arr['password'] = "Password length must be 256 > (password length) > 7!";
            }
        } else {
            $err_arr['password'] = 'Password field must be filled!';
        }

        $data_arr['birthdate'] = filter_input(INPUT_POST, 'birthdate');
        $format = 'Y-m-d';
        if(empty($data_arr['birthdate'])) {
            $data_arr['birthdate'] = null;
        } else if(DateTime::createFromFormat($format, $data_arr['birthdate'])->format($format) != $data_arr['birthdate']) {
            $err_arr['birthdate'] = "Please enter a valid birthdate!";
        }
        
        $data_arr['gender'] = filter_input(INPUT_POST, 'gender');
        if($data_arr['gender'] != 'm' && $data_arr['gender'] != 'f') {
            $data_arr['gender'] = null;
        }
        if(count($err_arr) == 0) {
            require $_SERVER['DOCUMENT_ROOT']."/php/includes/DB_connection.php";
            
            $stmt = new mysqli_stmt($mySqlConnection, "SELECT * FROM users WHERE email=?");
            $stmt->bind_param("s", $data_arr['email']);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if(empty($result) || empty($result->num_rows)) {
                if($stmt->reset()) {
                    $stmt->prepare("INSERT INTO users (email, password, name, surname, birth_date, gender)
                                    VALUES (?,?,?,?,?,?)");
                    $stmt->bind_param("ssssss", $data_arr['email'], $data_arr['password'],
                                                $data_arr['name'], $data_arr['surname'],
                                                $data_arr['birthdate'], $data_arr['gender']);
                    $stmt->execute();

                    $_SESSION['logged_in'] = $stmt->insert_id;
                    header("Location: /account/account");
                    exit();
                } else {
                    // TODO something went wrong
                }
            } else {
                $formError = "There is an account with same email!";//TODO
            }
            $stmt->close();
            $mySqlConnection->close();
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
    <link rel="stylesheet" type="text/css" href="/css/auth/register.css">
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
                <br><div class="auth-box-header">Register | Գրանցվել</div><br>
                <a href="login" class="auth-redirect-link">
                    Already have an account?
                </a>
                <form method="POST">
                    <?php if(isset($formError)): ?>
                        <div class="form-error"> <?php echo $formError ?></div>
                    <?php endif ?>
                    <div class="first-last-name-container">
                        <div>
                            <input type="text" placeholder="Name" class="auth-input" name="name" minlength="2" maxlength="255" required>
                            <span class="input-error" title="<?php if (isset($err_arr['name'])) echo $err_arr['name'];?>">
                                                            <?php if (isset($err_arr['name'])) echo $err_arr['name'];?>
                            </span>
                        </div>
                        <div>
                            <input type="text" placeholder="Surname" class="auth-input" name="surname" minlength="2" maxlength="255" required>
                            <span class="input-error" title="<?php if (isset($err_arr['surname'])) echo $err_arr['surname'];?>">
                                                            <?php if (isset($err_arr['surname'])) echo $err_arr['surname'];?>
                            </span>
                        </div>
                    </div>
                    <div>
                        <input type="email" placeholder="E-mail" class="auth-input" name="email" required>
                        <span class="input-error" title="<?php if (isset($err_arr['email'])) echo $err_arr['email'];?>">
                                                        <?php if (isset($err_arr['email'])) echo $err_arr['email'];?>
                        </span>
                    </div>
                    <div>
                        <div class="password-input-container">
                            <input type="password" placeholder="Password" class="auth-input" name="password" minlength="8" maxlength="255" required>
                            <span class="password-unmask-icon" onclick="unmaskPassword(event)" material-icon>visibility</span>
                        </div>
                        <span class="input-error" title="<?php if (isset($err_arr['password'])) echo $err_arr['password'];?>">
                                                        <?php if (isset($err_arr['password'])) echo $err_arr['password'];?>
                        </span>
                    </div>
                    <div class="birth-date-gender-container">
                        <div class="birth-date-container">
                            <span class="birth-date-placeholder">Birth date</span>
                            <br>
                            <input type="date" min="1905-01-01" max="<?php echo date('Y-m-d') ?>" class="birth-date" name="birthdate">
                            <span class="input-error" title="<?php if (isset($err_arr['birthdate'])) echo $err_arr['birthdate'];?>">
                                                            <?php if (isset($err_arr['birthdate'])) echo $err_arr['birthdate'];?>
                            </span>
                        </div>
                        <div class="gender-container">
                            <span class="gender-placeholder">Gender</span>
                            <div class="gender-radio-container">
                                <input type="radio" value="m" name="gender"> <span class="gender-radio-text">Male</span>
                                <input type="radio" value="f" name="gender"> <span class="gender-radio-text">Female</span>
                                <input type="radio" value="" name="gender" checked> <span class="gender-radio-text">None</span>
                            </div>
                            <span class="input-error"></span>
                        </div>
                    </div>
                    <button type="submit" class="submit-button">Register</button>
                </form>
                
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
    <script src="/js/register.js"></script>
</body>

</html>