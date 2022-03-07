<?php
session_start();

include('config/db.php');
$user_email = $_SESSION['user_email'];
$user_id = $_SESSION['user_id'];
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

//1. query ข้อมูลจากตาราง department_info:
$query = "SELECT * FROM department_info ORDER BY department_id asc" or die("Error:" . mysqli_error());
// เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result = mysqli_query($conn, $query);

//2. query ข้อมูลจากตาราง project_style_info:
$queryProgress = "SELECT * FROM progress_info ORDER BY user_id asc" or die("Error:" . mysqli_error());
// เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_Progress = mysqli_query($conn, $queryProgress);

//3. query ข้อมูลจากตาราง user_details:
$queryProject = "SELECT * FROM project_info WHERE user_id = '$user_id'" or die("Error:" . mysqli_error());
//เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_Project = mysqli_query($conn, $queryProject);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สำนักงานหอสมุดกำแพงแสน</title>
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/eidit_check.css">
    <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>">

    <!-- plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
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
                <div>
                    <div class="logo">
                        <p class="headline">แก้ไข/ตรวจสอบสถานะโครงการ</p>
                    </div>

                </div>

                <div class="navbar_right">
                    <div class="profile">
                        <div class="icon_wrap">
                            <img src="img/ku.jpg" alt="profile_pic">
                            <span class="name"><?php echo $_SESSION['user_email']; ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </div>

                        <div class="profile_dd">
                            <ul class="profile_ul">
                                <!-- logged in user information เช็คว่ามีการล็อคอินเข้ามาไหม -->
                                <?php if (isset($_SESSION['email'])) : ?>
                                <?php endif ?>
                                <li class="profile_li"><a class="profile" href="#"><span class="picon"><i
                                                class="fas fa-user-alt"></i>
                                        </span>Profile</a>
                                    <div class="btn">My Account</div>
                                </li>
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
    <div class="logo-container">
        <div class="color-small-bar"></div>
    </div>
    <br>

    <div style="text-align: center;">
        <table>
            <caption> รายงานผลการดำเนินงานรายไตรมาส</caption>
            <thead>
                <tr>
                    <th>ชื่อโครงการ</th>
                    <th>ผลการดำเนินงาน</th>
                    <th>ระยะเวลา</th>
                    <th>ตัวชี้วัด</th>
                    <th>ผลการดำเนินงานตามตัวชี้วัด</th>
                    <th>ผู้รับผิดชอบ</th>
                </tr>
                <?php foreach ($result_Progress as $value) { ?>
            <tbody>
                <tr>
                    <td><?php echo $value['project_name']; ?></td>
                    <td><?php echo $value['project_style']; ?></td>
                    <td><?php echo $value['status_project']; ?></td>
                    <td><Button><?php echo $value['project_place']; ?></Button></td>
                    <td> <?php   if ($value['document_status']==0) {echo'<p style="color: #a94442;">รอตรวจสอบ</p>';}else
                    {echo'<p style="color: #00766a;">ตรวจสอบแล้ว</p>';}?></td>
                </tr>
            </tbody>
            </thead>
            <?php } ?>
        </table>
        <div class="note">
            <p>หมายเหตุ</p><br>
            <p>1.หากสถานะเอกสารเป็นสถานะ
            <p class="red">รอตรวจสอบ</p> ผู้ใช้จะสามารถ<p class="green">แก้ไขเอกสารได้</p>
            </p>
            <br>
            <p>2.หากสถานะเอกสารเป็นสถานะ
            <p class="green">ตรวจสอบแล้ว</p> ผู้ใช้จะ<p class="red">ไม่สามารถแก้ไขเอกสารได้
            </p> หากต้องการแก้ไขโปรติดต่อเจ้าหน้าที่
            </p>
        </div>
        <div class="container-button">
            <button onclick="parent.location='home.php'" class="backButton">Back </button>
            <?php
            unset($_SESSION['project_id']);
            ?>

        </div>
    </div>
</body>

</html>