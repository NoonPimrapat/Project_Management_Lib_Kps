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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                        <p class="headline">ขออนุมัติปิดโครงการ</p>
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
                                <li><a class="logout" href="home.php?logout='1'"><span class="picon">
                                            <iw class="fas fa-sign-out-alt"></iw>
                                        </span>Logout</a></li>
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
        <form action="close_project_db.php" method="post">
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
                        <select name="project_id" class="inputFill-Information" id="project_id" required>
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
                        <label for="ลักษณะโครงการ" class="topic">ลักษณะโครงการ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_style" class="inputFill-Information" id="pro_style" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ภายใต้ยุทธศาสตร์" class=" topic">ภายใต้ยุทธศาสตร์ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_strategy" class="inputFill-Information" id="pro_strategy" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ภายใต้แผนงานประจำ" class="topic">ภายใต้แผนงานประจำ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_routine" class="inputFill-Information" id="routine_plan" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ฝ่ายงาน" class="topic">ฝ่ายงาน : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_department" class="inputFill-Information" id="department" readonly>

                    </div>
                </div>
                <div class=" row">
                    <div class="col-25">
                        <label for="วัตถุประสงค์" class="topic">วัตถุประสงค์ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_objective" class="inputFill-Information" id="pro_objective"
                            readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะการดำเนินงาน" class="topic">รายละเอียดจัดโครงการ : </label>
                    </div>
                    <div class="col-65">
                        <textarea name="pro_operation" rows="4" cols="50" class="inputFill-Information-large"
                            id="reason" readonly></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ระยะเวลาดำเนินการ" class="topic">ระยะเวลาดำเนินการ : </label>
                    </div>
                    <div class="col-65">

                        <input type="date" id="dateStart" name="pro_dateStart" class="inputFill-Information-Datepicker"
                            readonly>
                        <label-inline class="topic">ถึง</label-inline>

                        <input type="date" id="dateEnd" name="pro_dateEnd" class="inputFill-Information-Datepicker"
                            readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="สถานที่ " class="topic">สถานที่ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_place" class="inputFill-Information" id="pro_place" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="งบประมาณ " class="topic">งบประมาณ : </label>
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
                            <tbody id="tbodyCompensation">
                                <!-- <tr class="box-input act-input">
                                    <td class="text-left">
                                        <input type="text" name="compensation[item][]" id="compensation[item][]">
                                        <span for="" class="item" id="compensation[item][]"></span>
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
                                </tr> -->
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
                            <tbody id="tbodyCost">

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
                            <tbody id="tbodyMaterial">

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
                <div class="row">
                    <div class="col-25">
                        <label for="ตัวชี้วัดโครงการ" class="topic">ตัวชี้วัดโครงการ : </label>
                    </div>
                    <div class="col-65">

                    </div>
                </div>
                <div class="row">

                    <div class="col-65">
                        <label for="ตัวชี้วัดโครงการ" class="topic">1. </label>
                        <input type="text" id="indicator_1" name="indicator_1" class="inputFill-Information" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">เป้าหมายที่กำหนดไว้ : </label>
                        <input type="text" id="indicator_1_value" name="indicator_1_value"
                            class="inputFill-Information-Datepicker" readonly>
                    </div>
                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">ผลการดำเนินงาน : </label>
                        <input type="text" id="indicator_1_result" name="indicator_1_result"
                            class="inputFill-Information-Datepicker" required>
                    </div>

                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">ผลการประเมินความสำเร็จของโครงการ
                            <br> (ผลการดำเนินงานเทียบกับค่าเป้าหมาย) : </label>
                        <select type="text" id="indicator_success1" name="indicator_success1"
                            class="inputFill-Information-Datepicker" required>
                            <option value=""> กรุณาเลือก </option>
                            <option value="1"> สำเร็จ </option>
                            <option value="2"> ไม่สำเร็จ </option>
                        </select>
                    </div>


                </div>
                <div class="row">

                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">2. </label>
                        <input type="text" id="indicator_2" name="indicator_2" class="inputFill-Information" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">เป้าหมายที่กำหนดไว้ : </label>
                        <input type="text" id="indicator_2_value" name="indicator_1_value"
                            class="inputFill-Information-Datepicker" readonly>
                    </div>
                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">ผลการดำเนินงาน : </label>
                        <input type="text" id="indicator_2_result" name="indicator_2_result"
                            class="inputFill-Information-Datepicker" required>
                    </div>

                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">ผลการประเมินความสำเร็จของโครงการ
                            <br> (ผลการดำเนินงานเทียบกับค่าเป้าหมาย) : </label>
                        <select type="text" id="indicator_success2" name="indicator_success2"
                            class="inputFill-Information-Datepicker" required>
                            <option value=""> กรุณาเลือก </option>
                            <option value="1"> สำเร็จ </option>
                            <option value="2"> ไม่สำเร็จ </option>
                        </select>
                    </div>


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
                <div class="information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">เอกสารแนบ </label>
                </div>
                <div class="information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">1.ภาพกิจกรรม (3-5 ภาพ) </label>
                        <input id="file-upload" name="activity_pictures" type="file" accept="image/*" multiple />
                </div>

                <div class="container-button">
                    <button onclick="parent.location='home.php'" class="backButton">Back </button>
                    <button type="submit" name="close_project" class="summitButton">Submit</button>
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
    // auto fill
    $('#project_id').click(function() {
        var id_project = $(this).val();
        if (id_project == "") {

        } else {
            $.ajax({
                url: "autofill.php",
                method: "post",
                data: {
                    id: id_project,
                },
                dataType: "json", //ดาต้าที่จะเอาออกมา
                success: function(data) {
                    console.log(data);
                    $('#reason').html(data[0].reason)
                    $('#pro_style').val(data[0].project_style_name)
                    $('#routine_plan').val(data[0].routine_plan)
                    $('#pro_strategy').val(data[0].project_strategy)
                    $('#department').val(data[0].department_name)
                    $('#pro_objective').val(data[0].objective)
                    $('#dateStart').val(data[0].period_op)
                    $('#dateEnd').val(data[0].period_ed)
                    $('#pro_place').val(data[0].project_place)
                    $('#indicator_1').val(data[0].indicator_1)
                    $('#indicator_1_value').val(data[0].indicator_1_value)
                    $('#indicator_2').val(data[0].indicator_2)
                    $('#indicator_2_value').val(data[0].indicator_2_value)
                    var html = '',
                        html2 = '',
                        html3 = '';
                    var i = 0;
                    var compensation = [];
                    var cost = [];
                    var material = [];
                    for (let index = 0; index < data.length; index++) {
                        i += 1;
                        console.log(index);
                        if (data[index].budget_group == "compensation") {
                            compensation.push({
                                items: data[index].item,
                                quantitys: data[index].quantity,
                                prices: data[index].price
                            });
                            console.log("compensation");
                            console.log(compensation);
                        } else if (data[index].budget_group == "cost") {
                            cost.push({
                                items: data[index].item,
                                quantitys: data[index].quantity,
                                prices: data[index].price
                            });
                        } else if (data[index].budget_group == "material") {
                            material.push({
                                items: data[index].item,
                                quantitys: data[index].quantity,
                                prices: data[index].price
                            });
                        }
                    }
                    if (compensation != '') {
                        compensation.forEach(element => {
                            html += `<tr class="box-input act-input">
                            <td class="text-left">
                                <span for="" class="item">${element.items}</span>
                            </td>
                            <td>
                                <span for="" class="quantity">${element.quantitys}</span>
                            </td>
                            <td>
                                <span for="" class="price">${element.prices}</span>
                            </td>
                        </tr>`
                            $('#tbodyCompensation').html(html);
                        });
                    }
                    if (cost != '') {
                        cost.forEach(element => {
                            html2 += `<tr class="box-input act-input">
                            <td class="text-left">
                                <span for="" class="item">${element.items}</span>
                            </td>
                            <td>
                                <span for="" class="quantity">${element.quantitys}</span>
                            </td>
                            <td>
                                <span for="" class="price">${element.prices}</span>
                            </td>
                        </tr>`
                            $('#tbodyCost').html(html2);
                        });
                    }
                    if (material != '') {
                        material.forEach(element => {
                            html3 += `<tr class="box-input act-input">
                            <td class="text-left">
                                <span for="" class="item">${element.items}</span>
                            </td>
                            <td>
                                <span for="" class="quantity">${element.quantitys}</span>
                            </td>
                            <td>
                                <span for="" class="price">${element.prices}</span>
                            </td>
                        </tr>`
                            $('#tbodyMaterial').html(html3);
                        });
                    }
                }
            })
        }
    })
    </script>
</body>

</html>