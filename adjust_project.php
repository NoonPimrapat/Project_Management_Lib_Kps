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

//3. query ข้อมูลจากตาราง project_info:
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
                        <p class="headline">3. ขออนุมัติปรับแผนโครงการ</p>
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
                                <li class="profile_li"><a class="profile" href="#"><span class="picon"><i class="fas fa-user-alt"></i>
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
    <div class="logo-container">
        <div class="color-small-bar"></div>
    </div>

    <div class="information-container">
        <!-- <p class="topic">โครงการ</p> -->
        <form action="update_approval_db.php" method="post">
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
                        <select name="project_id" id="project-change" class="inputFill-Information" required>
                            <option value=""> กรุณาเลือก </option>
                            <?php foreach ($result_ProjectName as $results) { ?>
                                <option value="<?php echo $results["project_id"]; ?>">
                                    <?php echo $results["project_name"]; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div class="message-js"></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-25">

                    </div>
                </div>

                <div class="information-container">
                    <label-1 for="ลักษณะโครงการ" class="topic">รายละเอียดโครงการที่ต้องการปรับ : </label>
                </div>
            </div>
            <div class="row">
                <div class="col-50 fix-col-2" style="width: 535px;">
                    <div class="form-group type-checkbox">
                        <input type="checkbox" id="pro_dateStart" name="topic_change[]" value="pro_dateStart" class="ckb">
                        <label for="pro_dateStart">ปรับระยะเวลาดำเนินการ</label>
                    </div>
                    <div class="form-group type-checkbox">
                        <input type="checkbox" id="indicator_value" name="topic_change[]" value="indicator_value" class="ckb">
                        <label for="indicator_value">ปรับเป้าหมายตัวชี้วัด</label>
                    </div>
                    <div class="form-group type-checkbox">
                        <input type="checkbox" id="another" name="topic_change[]" value="another" class="ckb">
                        <label for="another">ปรับอื่นๆโปรดระบุ</label>
                        <div class="box-change other" data-target="another">
                            <input type="text" name="another" class="inputFill-Information-Datepicker">
                        </div>
                    </div>
                    <div class="form-group type-checkbox">
                        <input type="checkbox" id="indicator" name="topic_change[]" value="indicator" class="ckb">
                        <label for="indicator">ปรับตัวชี้วัด</label>
                    </div>
                    <div class="form-group type-checkbox">
                        <input type="checkbox" id="budget" name="topic_change[]" value="budget" class="ckb">
                        <label for="budget">ปรับงบประมาณ</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="box-change" data-target="pro_dateStart">
                <div class="topic-box">
                    <h4>ระยะเวลาดำเนินการ</h4>
                </div>
                <div class=" row">
                    <div class="col-25">
                        <label for="ภายใต้แผนงานประจำ" class="topic">จากที่กำหนดไว้คือ : </label>
                    </div>
                    <div class="col-65">
                        <p id="processing-time"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ฝ่ายงาน" class="topic">ขอเปลี่ยนเป็น : </label>
                    </div>
                    <div class="col-65">
                        <input type="date" id="dateStart" name="pro_dateStart" class="inputFill-Information-Datepicker">
                        <label-inline class="topic">ถึง</label-inline>
                        <input type="date" id="dateEnd" name="pro_dateEnd" class="inputFill-Information-Datepicker">
                    </div>
                </div>
            </div>
            <div class="box-change" data-target="indicator">
                <div class="topic-box">
                    <h4>ตัวชี้วัด</h4>
                </div>
                <div class=" row">
                    <div class="col-25">
                        <label for="ภายใต้แผนงานประจำ" class="topic">จากที่กำหนดไว้คือ : </label>
                    </div>
                    <div class="col-65">
                        <p id="processing-indicator-1"></p>
                        <p id="processing-indicator-2"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ฝ่ายงาน" class="topic">ขอเปลี่ยนเป็น : </label>
                    </div>
                    <div class="col-65">
                        <div class="form-group">
                            ตัวชี้วัด 1 <input type="text" name="indicator_1" class="inputFill-Information-Datepicker">
                        </div>
                        <div class="form-group">
                            ตัวชี้วัด 2 <input type="text" name="indicator_2" class="inputFill-Information-Datepicker">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-change" data-target="indicator_value">
                <div class="topic-box">
                    <h4>เป้าหมายตัวชี้วัด</h4>
                </div>
                <div class=" row">
                    <div class="col-25">
                        <label for="ภายใต้แผนงานประจำ" class="topic">จากที่กำหนดไว้คือ : </label>
                    </div>
                    <div class="col-65">
                        <p id="processing-indicator-goal-1"></p>
                        <p id="processing-indicator-goal-2"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ฝ่ายงาน" class="topic">ขอเปลี่ยนเป็น : </label>
                    </div>
                    <div class="col-65">
                        <div class="form-group">
                            ค่าเป้าหมาย 1 <input type="text" name="indicator_1_value" class="inputFill-Information-Datepicker">
                        </div>
                        <div class="form-group">
                            ค่าเป้าหมาย 2 <input type="text" name="indicator_2_value" class="inputFill-Information-Datepicker">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-change" data-target="budget">
                <div class="topic-box">
                    <h4>งบประมาณ</h4>
                </div>
                <div class=" row">
                    <div class="col-25">
                        <label for="ภายใต้แผนงานประจำ" class="topic">จากที่กำหนดไว้คือ : </label>
                    </div>
                    <div class="col-65">
                        <p id="processing-budget"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ฝ่ายงาน" class="topic">ขอเปลี่ยนเป็น : </label>
                    </div>
                    <div class="col-65">
                        <input type="number" name="val_budget" class="inputFill-Information-Datepicker">
                    </div>
                </div>
            </div>
            <div class="information-container">
                <label-1 for="ลักษณะโครงการ" class="topic">โดยมีเหตุผลในการขอปรับดังนี้คือ : </label>
            </div>
            <div class="row">
                <div class="col-25">
                    <label></label>
                </div>
                <div class="col-65">
                    <textarea name="pro_reason" rows="4" cols="50" class="inputFill-Information-large" required></textarea>
                </div>
            </div>

            <div class="container-button">
                <button type="reset" value="reset" class="backButton" onclick="parent.location='home.php'">Back
                </button>
                <button type="submit" name="adjust_project" class="summitButton">Submit</button>
            </div>
        </form>

    </div>
    <script>
        // auto fill
        $('#ckb').click(function() {
            // var id_project = $(this).val();
            if (this.checked) {
                console.log(Noon);
            } else {

            }
            console.log(id_project);
            // if (id_project == "") {

            // } else {
            //     $.ajax({
            //         url: "autofill.php",
            //         method: "post",
            //         data: {
            //             id: id_project,
            //         },
            //         dataType: "json", //ดาต้าที่จะเอาออกมา
            //         success: function(data) {
            //             console.log(data);
            //             // $('#reason').html(data.reason)
            //             // $('#pro_style').val(data.project_style_name)
            //             // $('#routine_plan').val(data.routine_plan)
            //             // $('#pro_strategy').val(data.project_strategy)
            //             // $('#department').val(data.department_name)
            //             // $('#pro_objective').val(data.objective)
            //             // $('#dateStart').val(data.period_op)
            //             // $('#dateEnd').val(data.period_ed)
            //             // $('#pro_place').val(data.project_place)
            //             // $('#indicator_1').val(data.indicator_1)
            //             // $('#indicator_1_value').val(data.indicator_1_value)
            //             // $('#indicator_2').val(data.indicator_2)
            //             // $('#indicator_2_value').val(data.indicator_2_value)

            //         }
            //     })
            // }
        })

        $(document).on('click', 'input.ckb', function(e) {

            var checkbox = $('input.ckb');
            $('.box-change').removeClass('in');

            var pid = $('#project-change').val();
            $('.message-js').html('');
            if (pid.length === 0) {
                $('.message-js').html(`<div class="error" style="margin: 15px 0 0;"><h3>กรุณาเลือกโครงการ</h3></div>`)
                return e.preventDefault()
            }

            jQuery.each(checkbox, function(index, elm) {
                const v = $(elm).val();
                if ($(elm).is(':checked')) $(`[data-target="${v}"]`).addClass('in');
            })
        })

        $(document).on('change', '#project-change', function(e) {
            var proId = $(this).val();
            $.ajax({
                type: "POST",
                url: "service.php",
                data: {
                    project_id: proId,
                    target: "RequestApprovalChoiceProjectPlan"
                },
                dataType: "json",
                success: function(response) {
                    // success case 
                    if (!response.error) {
                        var d = response.data;
                        $('#processing-time').html(d.time)
                        $('#processing-indicator-1').html(d.indicator_1)
                        $('#processing-indicator-2').html(d.indicator_2)
                        $('#processing-indicator-goal-1').html(d.indicator_1_value)
                        $('#processing-indicator-goal-2').html(d.indicator_2_value)
                        $('#processing-budget').html(d.budget)
                    }
                }
            });
        })

        $(document).on('submit', 'form', function(e) {
            var err = false;
            var fel;
            var msg = "กรุณากรอกข้อมูลให้ครบถ้วน";
            var box = $('.box-change.in');
            $.each(box, function(ind, elm) {
                var txt = $(elm).find('.topic-box > h4').text();
                var input = $(elm).find('input');
                if (input) {
                    $.each(input, function(x, i) {
                        var v = $(i).val();
                        if (v.length === 0) {
                            if (!err) {
                                fel = $(i);
                                msg = "กรุณากรอกข้อมูล " + txt;
                            }
                            err = true;
                        }
                    })
                }
            })
            if (err) {
                $(fel).focus();
                $('.message-js').html(`<div class="error" style="margin: 15px 0 0;"><h3>${msg}</h3></div>`)
                return e.preventDefault();
            }
        })
    </script>



</body>

</html>