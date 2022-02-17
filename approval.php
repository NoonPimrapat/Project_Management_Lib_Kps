<?php
        session_start(); 
        include('config/db.php');
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
?>
<?php
        //2. query ข้อมูลจากตาราง tb_member:
        $query = "SELECT * FROM department_info ORDER BY department_id asc" or die("Error:" . mysqli_error());
        //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
        $result = mysqli_query($conn, $query);
    ?>
<?php
        //2. query ข้อมูลจากตาราง tb_member:
        $query2 = "SELECT * FROM project_style_info ORDER BY project_style_id asc" or die("Error:" . mysqli_error());
        //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
        $result_style = mysqli_query($conn, $query2);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">

    <script>
    function addRow() {
        "use strict";

        var table = document.getElementById("table");

        var row = document.createElement("tr");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        var td3 = document.createElement("td");

        td1.innerHTML = document.getElementById("item").value;
        td2.innerHTML = document.getElementById("quantity").value;
        td3.innerHTML = document.getElementById("price").value;

        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);

        table.children[0].appendChild(row);
        reset(table);

    };
    </script>
    <title>
        สำนักงานหอสมุดกำแพงแสน
    </title>
</head>

<body>
    <div class="logo-container">
        <div class="logo">
            <img src="img/ku.jpg" alt="logo ku" class="mini-logo">
            <img src="img/ku_logo.jpg" alt="logo ku" class="mini-logo-ku">
        </div>
        <p class="headline">ขออนุมัติโครงการ</p>
        <div class="profile-logo">
            <img src="img/ku.jpg" alt="logo ku" class="profile">
            <p><strong></strong></p>
            <div class="triangleBottom"></div>
        </div>
    </div>
    <div class="logo-container">
        <div class="color-small-bar">
        </div>


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
                        <input type="text" name="pro_name" class="inputFill-Information" required>
                    </div>

                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ" class="topic">ลักษณะโครงการ : </label>
                    </div>
                    <div class="col-65">
                        <select name="pro_style" class="inputFill-Information" required>
                            <option value=""> กรุณาเลือก </option>
                            <?php foreach($result_style as $results){?>
                            <option value="<?php echo $results["project_style_id"];?>">
                                <?php echo $results["project_style_name"]; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ภายใต้ยุทธศาสตร์" class=" topic">ภายใต้ยุทธศาสตร์ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_strategy" class="inputFill-Information">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ภายใต้แผนงานประจำ" class="topic">ภายใต้แผนงานประจำ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_routine" class="inputFill-Information">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ฝ่ายงาน" class="topic">ฝ่ายงาน : </label>
                    </div>
                    <div class="col-65">
                        <select name="pro_department" class="inputFill-Information" required>
                            <option value=""> กรุณาเลือก </option>
                            <?php foreach($result as $results){?>
                            <option value="<?php echo $results["department_id"];?>">
                                <?php echo $results["department_name"]; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="หลักการและเหตุผล" class="topic">หลักการและเหตุผล : </label>
                    </div>
                    <div class="col-65">
                        <textarea name="pro_reason" rows="4" cols="50" class="inputFill-Information-large" required>
                        </textarea>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-25">
                        <label for="วัตถุประสงค์" class="topic">วัตถุประสงค์ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_objective" class="inputFill-Information" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะการดำเนินงาน" class="topic">ลักษณะการดำเนินงาน : </label>
                    </div>
                    <div class="col-65">
                        <textarea name="pro_operation" rows="4" cols="50" class="inputFill-Information-large" required>
                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ระยะเวลาดำเนินการ" class="topic">ระยะเวลาดำเนินการ : </label>
                    </div>
                    <div class="col-65">

                        <input type="date" id="dateStart" name="pro_dateStart" class="inputFill-Information-Datepicker"
                            required>
                        <label-inline class="topic">ถึง</label-inline>

                        <input type="date" id="dateEnd" name="pro_dateEnd" class="inputFill-Information-Datepicker"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="สถานที่ " class="topic">สถานที่ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="pro_place" class="inputFill-Information" required>
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
                    <div class="col-65">
                        <table class="budget">
                            <tr>
                                <th>
                                    รายการ
                                    <input type="text" name="item" id="item" />
                                </th>
                                <th>
                                    จำนวน
                                    <input type="text" name="quantity" id="quantity" />
                                </th>
                                <th>
                                    ราคา
                                    <input type="text" name="price" id="price" />
                                </th>
                            </tr>
                        </table>
                    </div>
                    <input type="button" value="เพิ่มรายการ" onClick="addRow()" id="add" class="add-drop-tableButton">

                    <div class="col-25">


                    </div>
                    <div class="col-65">
                        <table id="table" class="budget">
                            <tr>
                                <th>รายการ</th>
                                <th>จำนวน</th>
                                <th>ราคา</th>
                            </tr>
                        </table>
                    </div>


                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="งบประมาณ" class="topic">2. ค่าใช้สอย : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_cost" name="project_cost" class="inputFill-Information" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="งบประมาณ" class="topic">3. ค่าวัสดุ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_material" name="project_material" class="inputFill-Information"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-65">
                        <label class="topic">หมายเหตุ </label><br>
                        <label class="topic">1. ใช้งบประมาณเงินรายได้
                            โครงการตามแผนยุทธศาสตร์<br>2. ขอถัวเฉลี่ยจ่ายทุกรายการ </label><br>
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


                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">ผู้รับผิดชอบโครงการ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" name="responsible_man" value="{$_SESSION['user_email']}"
                            class="inputFill-Information" required>
                    </div>
                </div>
                <div class="container-button">
                    <button type="reset" value="reset" class="backButton">Back </button>
                    <button type="submit" name="Add_Project" class="summitButton">Submit</button>
                </div>
            </div>

        </form>
    </div>


</body>

</html>