<?php
session_start();

include('config/db.php');
$project_id = $_SESSION['project_id'];
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

//1. query ข้อมูลจากตาราง user_details:
$queryproject = "SELECT * FROM project_info WHERE project_id = '$project_id'" or die("Error:" . mysqli_error());
//เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_project = mysqli_query($conn, $queryproject);

foreach ($result_project as $values) {
    $project_name = $values["project_name"];
    $project_fiscal_year = $values["project_fiscal_year"]; //งบประมาณ
    $user_id = $values["user_id"]; //ผู้รับผิดชอบโครงการ
    $department_id = $values["department_id"]; //ไอดีฝ่าย
    $project_fiscal_year = $values["project_fiscal_year"]; //ชื่อผู้อำนวยการ
    $submit_date = $values["submit_date"]; //วันที่
    $project_sum_total=$values["project_sum_total"];
    $project_sum_thai;
    
    // list($y,$m,$d,$h,$mi)=explode('-',':',$submit_date);
    // // echo$d.'/'.$m.'/'.$y;
    // $date=$d.'/'.$m.'/'.$y;
    // $format = "d/m/Y";
    // echo $date=$format(submit_date);
    // echo DATE_FORMAT($submit_date,'d/m/Y');
   
	function DateThai($submit_date)
	{
		$strYear = date("Y",strtotime($submit_date))+543;
		$strMonth= date("n",strtotime($submit_date));
		$strDay= date("j",strtotime($submit_date));
		$strHour= date("H",strtotime($submit_date));
		$strMinute= date("i",strtotime($submit_date));
		$strSeconds= date("s",strtotime($submit_date));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
         return "$strDay $strMonthThai $strYear";
        //  return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

	 $strDate = DateThai($submit_date);



}

//1. query ข้อมูลจากตาราง user_details:
$queryDerpartment = "SELECT * FROM department_info WHERE department_id = '$department_id'" or die("Error:" . mysqli_error());
//เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_Derpartment = mysqli_query($conn, $queryDerpartment);
foreach ($result_Derpartment as $values) {
    $Derpartment_name = $values["department_name"]; //ชื่อฝ่าย
}

//1. query ข้อมูลจากตาราง user_details:
$queryUser = "SELECT * FROM user_details WHERE user_id = '$user_id'" or die("Error:" . mysqli_error());
//เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_user = mysqli_query($conn, $queryUser);
foreach ($result_user as $values) {
    $firstname = $values["user_firstname"]; //ชื่อ
    $lastname = $values["user_lastname"]; //นามสกุล
}
// สร้างword
// header("Content-Type: application/msword");
// header('Content-Disposition: attachment; filename="filename.doc"');

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/wordReport.css">
    <link rel="stylesheet" href="css/custom.css?v=<?php echo time(); ?>">

    <!-- plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="./bahttex.js"></script>
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
                        <p class="headline">ขออนุมัติโครงการ</p>
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
    <div class="report-container">
        <div class="inline">

            <img src="img/imgReport.jpg" alt="logoReport" class="report-img" />
            <strong>บันทึกข้อความ</strong>


        </div>

        <p>
            <strong>

            </strong>
        </p>
        <div class="inline">
            <p>ส่วนงาน <u
                    class="border-bottom"><?php echo $Derpartment_name?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
            </p>
            <div class="right">
                <u class="border-bottom"> สำนักหอสมุด กำแพงแสน โทร 0-3435-1884 ภายใน 3802</u>
            </div>

        </div>
        <div class="inline">
            <p> ที่<u class="border-bottom">&emsp; อว
                    ๖๕๐๒.๐๘/&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
            </p>
            <div class="right">
                <p>วันที่<u
                        class="border-bottom">&emsp;<?php echo $strDate?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
                </p>
            </div>
        </div>
        <div class="inline">
            <p>เรื่อง<u class="border-bottom"> ขออนุมัติจัด
                    โครงการ<?php echo $project_name?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
            </p>

        </div>

        <p>
            เรียน<strong> </strong> <u>ผู้อำนวยการสำนักหอสมุด กำแพงแสน</u>
            <br />
        <div class="indent">
            <u>
                ตามที่สำนักหอสมุด กำแพงแสน ได้กำหนดแผนปฎิบัติการประจำปีงบประมาณ พ.ศ. <?php echo $project_fiscal_year?>
                เพื่อเป็นกรอบและทิศทางการดำเนินงานในปีงบประมาณ พ.ศ. <?php echo $project_fiscal_year?>
                ของแต่ละหน่วยงานภายในสำนักหอสมุดกำแพงแสน
                อันจะนำไปสู่เป้าหมายและวิสัยทัศน์ที่กำหนดไว้ร่วมกัน
            </u>
        </div>
        <div class="indent">

            <u>
                ดังนั้น เพื่อให้การดำเนินงานเป็นไปตามแผนปฎิบัติการ ประจำปีงบประมาณ พ.ศ.
                <?php echo $project_fiscal_year?>และบรรลุตามเป้าหมายที่กำหนดไว้ จึงใคร่ขออนุมัติจัด
                <?php echo $project_name?>
                โดยใช้เงินรายได้สำนักหอสมุดกำแพงแสน ภายในงบประมาณจำนวน <?php echo $project_sum_total?> .- บาท
                (
                <?$project_sum_thai?>)
                ทั้งนี้ได้แนบรายละเอียดโครงการดังกล่าวมาด้วยแล้ว
            </u>
        </div>
        </p>

        <u> จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</u>
        <div class="right">
            <u>
                (<?php echo $firstname?>&nbsp;<?php echo $lastname?>)
                <br />
                ผู้รับผิดชอบโครงการ
            </u>
        </div>
        <div>
            <p>
                เรียน หัวหน้า <?php echo $Derpartment_name?>
            </p>
        </div>
        <div class="indent">
            <u>
                เพื่อโปรดพิจารณาเสนอผู้อำนวยการสำนักฯ พิจารณาอนุมัติ
                ทั้งนี้โครงการดังกล่าวเป็นโครงการประจำภายใต้แผนปฎิบัติการประจำปีงบประมาณ
                พ.ศ.<?php echo $project_fiscal_year?> และได้ตรวจสอบรายละเอียดในเบื้องต้นแล้วเรียบร้อยแล้ว
            </u>
        </div>
        <div class="right">
            <u>
                <br />
                ..................................................
                <br />
                นักวิเคราะห์นโยบายและแผน
            </u>
        </div>
        <div class="inline">
            <div>
                <p>
                    เรียน ผู้อำนวยการสำนักหอสมุด กำแพงแสน
                </p>
            </div>
            <div>
                <p>
                    อนุมัติ
                </p>
            </div>
        </div>


        <div class="indent">
            <u>
                เพื่อโปรดพิจารณาลงนามอนุมัติ
        </div>
        <div class="inline">

            ........................................... <br>
            หัวหน้า <?php echo $Derpartment_name?>
            <div class="right">
                ( )
                <br />

                ผู้อำนวยการสำนักหอสมุดกำแพงแสน

                <br />

                ........... / ............ / ..........</u>

            </div>
        </div>
        <div class="container-button">
            <button onclick="parent.location='home.php'" class="backButton">Back </button>
            <?php
            unset($_SESSION['project_id']);
            ?>

        </div>
</body>

</html>