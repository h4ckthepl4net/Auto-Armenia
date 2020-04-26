<?php
    session_start();
    session_regenerate_id();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/ico" href="/assets/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="/main.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
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
            <div class="content-container-heading">Գլխավոր</div>
            <!-- <div class="content">
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
                <a class="announcement-demo">
                    <div class="announcement-demo-img-container">
                        <img class="announcement-demo-img" src="/assets/images/car.png">
                    </div>
                    <div class="announcement-demo-title">
                        Lorem, ipsum dolor.
                    </div>
                </a>
            </div> -->
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
</body>

</html>