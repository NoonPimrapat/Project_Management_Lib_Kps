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
                        <p class="headline">รายงานผลการดำเนินการ</p>
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
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">แผนการดำเนินงาน : </label>
                    </div>
                    <div class="col-65 section-table">
                        <table class="table" style="margin-top: 25px;">
                            <thead>
                                <tr>
                                    <th>กิจกรรม</th>
                                    <th>ระยะเวลาดำเนินการ</th>
                                    <th>สถานที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="box-input checked">
                                    <td>
                                        <input type="text" name="plant_detail[]">
                                        <span class="textplant_detail"></span>
                                    </td>
                                    <td>
                                        <input type="text" name="plant_time[]">
                                        <span class="textplant_time"></span>
                                    </td>
                                    <td>
                                        <input type="text" name="plant_location[]">
                                        <span class="textplant_location"></span>
                                        <a href="#" data-action="clone-plant" data-target="material"><i
                                                class="fa fa-plus" aria-hidden="true"></i></a>
                                        <a href="#" data-action="remove-plant"><i class="fa fa-minus"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="งบประมาณ " class="topic">ค่าใช้จ่าย : </label>
                    </div>
                    <div class="col-65">

                    </div>
                </div>
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
                <div class="information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">รายงานผลการดำเนินงานตามตัวชี้วัด : </label>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label> </label>
                    </div>
                    <div class="col-65">

                    </div>
                </div>
                <div class="row">

                    <div class="col-65">
                        <label for="ตัวชี้วัดโครงการ" class="topic">1. </label>
                        <input type="text" id="project_name" name="project_metrics1" class="inputFill-Information"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">ค่าเป้าหมาย : </label>
                        <input type="text" id="project_name" name="target_value1"
                            class="inputFill-Information-Datepicker" required>
                    </div>
                </div>
                <div class="row">

                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">2. </label>
                        <input type="text" id="project_name" name="project_metrics2" class="inputFill-Information"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">ค่าเป้าหมาย : </label>
                        <input type="text" id="project_name" name="target_value2"
                            class="inputFill-Information-Datepicker" required>
                    </div>
                </div>
                <div class="information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">เอกสารแนบ </label>
                </div>
                <div class="information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">1.ภาพกิจกรรม(5-10 ไฟล์) </label>
                        <input id="file-upload" name="activity_pictures" type="file" accept="image/*" multiple />
                </div>
                <div class=" information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">
                        2.รายงานผลการประเมินความพึงพอใจ/การนำความรู้ไปใช้ประโยชน์(ถ้ามี)(3-5 ไฟล์) </label>
                        <input id="file-upload" name="assessment" type="file" accept="file_extension" multiple />
                </div>
                <div class="information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">3.เอกสารการลงทะเบียนเข้าร่วมกิจกรรม(ถ้ามี)(3-5 ไฟล์)
                        </label>
                        <input id="file-upload" name="registration" type="file" accept="file_extension" multiple />
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">ผู้รับผิดชอบโครงการ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="responsible_man"
                            value="<?php foreach ($result_Username as $results) { ?><?php echo $results["user_firstname"]; ?> &nbsp; <?php echo $results["user_lastname"] ?> <?php } ?>"
                            class="inputFill-Information" readonly>
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
    <script src="./bahttex.js"></script>
    <script>
    var quantityAll = 0;
    var priceAll = 0;
    $(document).on('click', 'a[data-action="clone"]', function(e) {
        e.preventDefault();
        var err = false;
        var section, tr, item, quantity, price;
        var group = $(this).data('target');
        section = $(this).closest('.section-table');
        tr = $(this).closest('.box-input');

        item = $(tr).find('input[name="' + group + '[item][]"]').val();
        quantity = $(tr).find('input[name="' + group + '[quantity][]"]').val();
        price = $(tr).find('input[name="' + group + '[price][]"]').val();

        // remove message pop
        $(section).find('.message-box').remove();

        // has error = true -- message alert pop
        if (item.length == 0 || quantity.length == 0 || price.length == 0) {
            $(section).append(
                `<div class="message message-box"><div class="error"><h3>Enter is required</h3></div></div>`
            )
            return;
        }

        $(tr).find('input').addClass('hiden');

        $(tr).find('span.item').text(item);
        $(tr).find('span.quantity').text(quantity);
        $(tr).find('span.price').text(price);

        $(tr).removeClass('act-input');

        var dup = `<tr class="box-input act-input">
                            <td class="text-left"><input type="text" name="${group}[item][]"><span for="" class="item"></span></td>
                            <td><input type="number" name="${group}[quantity][]"><span for="" class="quantity"></span></td>
                            <td>
                                <input type="number" class="input-price" name="${group}[price][]">
                                <span for="" class="price"></span>
                                <a href="#" data-action="remove"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                <a href="#" data-action="clone" data-target="${group}">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>`;

        priceAll += parseFloat(price * quantity);
        $(section).find('table > tbody').append(dup);
        var priceTotal = priceAll.toFixed(2);
        $('#sum-total').html(`${priceTotal}.- บาท`);
        $('#sum_total').val(priceTotal);
        $('#bahttex').html('(' + ThaiBaht(priceAll.toFixed(2)) + ')')
    })

    $(document).on('click', 'a[data-action="remove"]', function(e) {
        e.preventDefault();
        // get element tr 
        var tr = $(this).closest('.box-input');
        // get price from span
        var price = $(tr).find('.input-price').val();
        if (price !== "undefined") {
            priceAll = parseFloat(priceAll) - parseFloat(price);
            priceAll = priceAll < 0 ? 0 : priceAll;
            $(this).closest('tr').remove();
            $('#sum-total').html(`${priceAll.toFixed(2)}.- บาท`);
            $('#bahttex').html('(' + ThaiBaht(priceAll.toFixed(2)) + ')')
        }
    })
    $(document).on('click', 'a[data-action="remove"]', function(e) {
        e.preventDefault();
        // get element tr 
        var tr = $(this).closest('.box-input');
        // get price from span
        var price = $(tr).find('.input-price').val();
        if (price !== "undefined") {
            priceAll = parseFloat(priceAll) - parseFloat(price);
            priceAll = priceAll < 0 ? 0 : priceAll;
            $(this).closest('tr').remove();
            $('#sum-total').html(`${priceAll.toFixed(2)}.- บาท`);
            $('#bahttex').html('(' + ThaiBaht(priceAll.toFixed(2)) + ')')
        }
    })
    $(document).on('click', 'a[data-action="clone-plant"]', function(e) {
        e.preventDefault();
        var err = false;
        var section, tr, detail, time;
        section = $(this).closest('.section-table');
        tr = $(this).closest('.box-input');

        detail = $(tr).find('input[name="plant_detail[]"]').val();
        time = $(tr).find('input[name="plant_time[]"]').val();

        // remove message pop
        $(section).find('.message-box').remove();

        // has error = true -- message alert pop
        if (detail.length == 0 || time.length == 0) {
            $(section).append(
                `<div class="message message-box"><div class="error"><h3>Enter is required</h3></div></div>`
            )
            return;
        }

        $(tr).find('input').addClass('hiden');

        $(tr).find('span.textplant_detail').text(detail);
        $(tr).find('span.textplant_time').text(time);

        $(tr).removeClass('checked');
        var dup = `<tr class="box-input checked">
                            <td>
                                <input type="text" name="plant_detail[]">
                                <span class="textplant_detail"></span>
                            </td>
                            <td>
                                <input type="text" name="plant_time[]">
                                <span class="textplant_time"></span>
                                <a href="#" data-action="clone-plant" data-target="material"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <a href="#" data-action="remove-plant"><i class="fa fa-minus" aria-hidden="true"></i></a>
                            </td>
                        </tr>`;

        $(section).find('table > tbody').append(dup);

    })

    $(document).on('click', 'a[data-action="remove-plant"]', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    })
    </script>

</body>

</html>