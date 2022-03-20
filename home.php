<?php
session_start();
include('config/db.php');
// ถ้าไม่loginก็จะเข้าหน้านี้ไม่ได้
if (!isset($_SESSION['user_email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user_email']);
    header('location: login.php');
}
$user_email = $_SESSION['user_email'];

$query = "SELECT * FROM user_details WHERE user_email='$user_email'";
$result = mysqli_query($conn, $query) or die("Error in sql : $query" . mysqli_error($conn));
$row = mysqli_fetch_array($result);
// 
?>


<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- โลโก้ title เว็บ -->
    <link rel=”icon” type=”image/jpg” href=”img/ku.jpg” />
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
                            <img src="<?php echo $row['user_pic']; ?>" alt="profile_pic">
                            <span class="name"><?php echo $row['user_firstname']; ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <div class="profile_dd">
                            <ul class="profile_ul">
                                <!-- logged in user information เช็คว่ามีการล็อคอินเข้ามาไหม -->
                                <?php if (isset($_SESSION['email'])) : ?>
                                <?php endif ?>
                                <li class="profile_li"><a class="profile" href="profile.php"><span class="picon"><i class="fas fa-user-alt"></i>
                                        </span>Profile</a>
                                    <div class="btn">My Account</div>
                                </li>
                                <li><a class="logout" href="home.php?logout='1'"><span class="picon"><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
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
        <Button onclick="parent.location='disbursement.php'" class="menuButton">4. ขออนุมัติเบิก-จ่าย รายครั้ง</Button>
        <Button onclick="parent.location='performance_report.php'" class="menuButton">2. รายงานผลการดำเนินงาน</Button>
        <Button onclick="parent.location='close_project.php'" class="menuButton"> 5. ขอนุมัติปิดโครงการ</Button>
        <Button onclick="parent.location='adjust_project.php'" class="menuButton">3. ขออนุมัติปรับแผนโครงการ</Button>
        <Button onclick="parent.location='sum_plan.php'" class="menuButton">6. สรุปการดำเนินงานตามแผน</Button>
        <Button onclick="parent.location='edit_check.php'" class="menuButton">7. แก้ไข/ตรวจสอบสถานะโครงการ</Button>
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
        <div>
            <?php include('Table_report.php'); ?>
        </div>

        <br>
        <div>
            <?php include('BarCharts.php'); ?>
        </div>

    </div>

</body>

</html>