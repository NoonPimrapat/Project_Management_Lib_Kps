<?php 
session_start();
include('config/db.php') ?>

<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">

    <title>
        สำนักงานหอสมุดกำแพงแสน
    </title>
</head>

<body>
    <div class="grid-container">
        <div class="grid-item"><img src="img/display.jpg" alt="logo ku" class="imgDisplay">
        </div>
        <div class="grid-item">
            <img src="img/ku_logo.jpg" alt="logo ku" class="logoDisplay">

            <h2 class="textTitle">
                เข้าสู่ระบบด้วยอีเมลผู้ใช้งาน </h2>
            <form action="login_db.php" method="post">
                <?php if (isset($_SESSION['error'])) : ?>
                <div class="error">
                    <h3>
                        <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                    </h3>
                </div>
                <?php endif ?>
                <label>E-mail:</label><br>
                <input type="email" name="email" placeholder="E-mail" class="inputFill"><br>
                <label>Password:</label><br>
                <input type="password" name="password" placeholder="Password" class="inputFill"><br><br>
                <button type="submit" name="Login" class="summitButton">Login</button>
            </form>
        </div>
    </div>
</body>

</html>