<?php
session_start();
// ถ้าไม่loginก็จะเข้าหน้านี้ไม่ได้
if(!isset($_SESSION['user_email'])) { 
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_email']);
    header('location: login.php');
}

// // ดึงข้อมูลผู้ใช้ออกมาจากEmail
// //2. query ข้อมูลจากตาราง tb_member:
// $query = "SELECT * FROM user_details ORDER BY project_style_id asc" or die("Error:" . mysqli_error());
// //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
// $result_style = mysqli_query($conn, $query);
// ?>


<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">

    <title>
        สำนักงานหอสมุดกำแพงแสน
    </title>
</head>

<body>
    <header>
        <!-- partial:index.partial.html -->
        <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

        <div class="wrapper">
            <div class="navbar">
                <div class="navbar_left">
                    <div class="logo">
                        <img src="img/ku.jpg" alt="logo ku" class="mini-logo">
                        <img src="img/ku_logo.jpg" alt="logo ku" class="mini-logo-ku">
                    </div>
                </div>

                <div class="navbar_right">
                    <div class="profile">
                        <div class="icon_wrap">
                            <img src="img/ku.jpg" alt="profile_pic">
                            <span class="name"><?php echo $_SESSION['user_email'];?></span>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <div class="profile_dd">
                            <ul class="profile_ul">
                                <!-- logged in user information เช็คว่ามีการล็อคอินเข้ามาไหม -->
                                <?php if (isset($_SESSION['email'])) :?>
                                <?php endif?>
                                <li class="profile_li"><a class="profile" href="#"><span class="picon"><i
                                                class="fas fa-user-alt"></i>
                                        </span>Profile</a>
                                    <div class="btn">My Account</div>
                                </li>
                                <li><a class="address" href="#"><span class="picon"><i
                                                class="fas fa-map-marker"></i></span>Address</a></li>

                                <li><a class="logout" href="home.php?logout='1'"><span class="picon"><i
                                                class="fas fa-sign-out-alt"></i></span>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
        <script src="script.js"></script>

    </header>
    <div class="container">
        <div class="color-bar">
            <p class="title">แผนปฎิบัติการประจำปีงบประมาณ ปัจจุบัน </p>
        </div>
    </div>

    <div class="grid-container">
        <Button onclick="parent.location='approval.php'" class="menuButton"> 1. ขออนุมัติโครงการ</Button>
        <Button onclick="myFunction()" class="menuButton">4. ขออนุมัติเบิก-จ่าย รายครั้ง</Button>
        <Button onclick="myFunction()" class="menuButton">2. รายงานผลการดำเนินงาน</Button>
        <Button onclick="myFunction()" class="menuButton"> 5. ขอนุมัติปิดโครงการ</Button>
        <Button onclick="myFunction()" class="menuButton">3. ขออนุมัติปรับแผนโครงการ</Button>
        <Button onclick="myFunction()" class="menuButton">6. สรุปการดำเนินงานตามแผน</Button>
        <Button onclick="myFunction()" class="menuButton">7. แก้ไข/ตรวจสอบสถานะโครงการ</Button>
    </div>
    <div class="container">
        <div class="color-bar">
            <p class="title">แผนปฎิบัติการประจำปีงบประมาณ พ.ศ. </p>
        </div>
    </div>
    <div class="container">

        <div>
            <h2>แบบสรุปรายงานผลการดำเนินงาน</h2>
            <h2>ตามแผนปฎิบัติการประจำปี งบประมาณ ......</h2>
        </div>
        <h2 class="subTitle">รายงานผลการดำเนินงานในรอบไตรมาส ........</h2>
        <Button onclick="myFunction()" class="menuButton2">รายงานโครงการตามแผนงานประจำ</Button>
    </div>

</body>

</html>