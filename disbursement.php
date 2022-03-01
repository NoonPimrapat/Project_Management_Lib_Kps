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
$query2 = "SELECT * FROM project_style_info ORDER BY project_style_id asc" or die("Error:" . mysqli_error());
// เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_style = mysqli_query($conn, $query2);

//3. query ข้อมูลจากตาราง user_details:
$queryUsername = "SELECT * FROM user_details WHERE user_email = '$user_email'" or die("Error:" . mysqli_error());
//เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_Username = mysqli_query($conn, $queryUsername);
$queryProjectName = "SELECT * FROM project_info WHERE user_id = '$user_id'" or die("Error:" . mysqli_error());
//เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
$result_ProjectName = mysqli_query($conn, $queryProjectName);
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
                        <p class="headline">ขออนุมัติเบิก-จ่าย รายครั้ง</p>
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
    <div class="logo-container">
        <div class="color-small-bar"></div>
    </div>

    <div class="information-container">
        <!-- <p class="topic">โครงการ</p> -->
        <form action="approval_db.php" method="post">
            <?php include('errors.php'); ?>
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
            <div class="grid-item">
                <div class="row">
                    <div class="col-25">
                        <label for="โครงการ" class="topic">โครงการ:</label>
                    </div>

                    <div class="col-65">
                        <select name="pro_name" class="inputFill-Information" required>
                            <option value=""> กรุณาเลือก </option>
                            <?php foreach ($result_ProjectName as $results) { ?>
                            <option value="<?php echo $results["project_id"]; ?>">
                                <?php echo $results["project_name"]; ?>
                            </option>
                            <?php } ?>
                        </select>

                    </div>

                </div>
                <br><br>
                <div class="row">
                    <div class="col-25">
                        <label for="งบประมาณ " class="topic">1. ค่าตอบแทน : </label>
                    </div>
                    <div class="col-65 section-table">
                        <table class="budget table">
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>จำนวน</th>
                                    <th>ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="box-input act-input">
                                    <td class="text-left">
                                        <input type="text" name="compensation[item][]">
                                        <span for="" class="item"></span>
                                    </td>
                                    <td>
                                        <input type="number" name="compensation[quantity][]">
                                        <span for="" class="quantity"></span>
                                    </td>
                                    <td>
                                        <input type="number" class="input-price" name="compensation[price][]">
                                        <span for="" class="price"></span>
                                        <a href="#" data-action="clone" data-target="compensation"><i class="fa fa-plus"
                                                aria-hidden="true"></i></a>
                                        <a href="#" data-action="remove"><i class="fa fa-minus"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="งบประมาณ" class="topic">2. ค่าใช้สอย : </label>
                    </div>
                    <div class="col-65 section-table">
                        <table class="budget table">
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>จำนวน</th>
                                    <th>ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="box-input act-input">
                                    <td class="text-left">
                                        <input type="text" name="cost[item][]">
                                        <span for="" class="item"></span>
                                    </td>
                                    <td>
                                        <input type="number" name="cost[quantity][]">
                                        <span for="" class="quantity"></span>
                                    </td>
                                    <td>
                                        <input type="number" class="input-price" name="cost[price][]">
                                        <span for="" class="price"></span>
                                        <a href="#" data-action="clone" data-target="cost"><i class="fa fa-plus"
                                                aria-hidden="true"></i></a>
                                        <a href="#" data-action="remove"><i class="fa fa-minus"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="งบประมาณ" class="topic">3. ค่าวัสดุ : </label>
                    </div>
                    <div class="col-65 section-table">
                        <table class="budget table">
                            <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th>จำนวน</th>
                                    <th>ราคา</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="box-input act-input">
                                    <td class="text-left">
                                        <input type="text" name="material[item][]">
                                        <span for="" class="item"></span>
                                    </td>
                                    <td>
                                        <input type="number" name="material[quantity][]">
                                        <span for="" class="quantity"></span>
                                    </td>
                                    <td>
                                        <input type="number" class="input-price" name="material[price][]">
                                        <span for="" class="price"></span>
                                        <a href="#" data-action="clone" data-target="material"><i class="fa fa-plus"
                                                aria-hidden="true"></i></a>
                                        <a href="#" data-action="remove"><i class="fa fa-minus"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">

                    </div>
                    <div class="col-65 sum-total">
                        <div for="รวม" class="topic p-right">
                            รวม : <span class="pull-right" id="sum-total">0.00.- บาท</span>
                            <div id="bahttex" class="topic p-right text-right">(.......บาทถ้วน)</div>
                            <input type="hidden" name="project_sum_total" value="0" id="sum_total">
                        </div>
                    </div>
                </div>
                <div class="container-button">
                    <button type="reset" value="reset" class="backButton" onclick="parent.location='home.php'">Back
                    </button>
                    <button type="submit" name="Add_Project" class="summitButton">Submit</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>