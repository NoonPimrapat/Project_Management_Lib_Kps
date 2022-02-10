<?php
        // session_start(); 
        include('config/db.php');
        //2. query ข้อมูลจากตาราง tb_member:
        $query = "SELECT * FROM department_info ORDER BY department_id asc" or die("Error:" . mysqli_error());
        //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
        $result = mysqli_query($conn, $query);
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
    $(function() {

        var startDateTextBox = $('#dateStart');
        var endDateTextBox = $('#dateEnd');

        startDateTextBox.datepicker({
            dateFormat: 'dd-M-yy',
            onClose: function(dateText, inst) {
                if (endDateTextBox.val() != '') {
                    var StartDate = startDateTextBox.datetimepicker('getDate');
                    var EndDate = endDateTextBox.datetimepicker('getDate');
                    if (StartDate > EndDate)
                        endDateTextBox.datetimepicker('setDate', StartDate);
                } else {
                    endDateTextBox.val(dateText);
                }
            },
            onSelect: function(selectedDateTime) {
                endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker(
                    'getDate'));
            }
        });
        endDateTextBox.datepicker({
            dateFormat: 'dd-M-yy',
            onClose: function(dateText, inst) {
                if (startDateTextBox.val() != '') {
                    var StartDate = startDateTextBox.datetimepicker('getDate');
                    var EndDate = endDateTextBox.datetimepicker('getDate');
                    if (StartDate > EndDate)
                        startDateTextBox.datetimepicker('setDate', EndDate);
                } else {
                    startDateTextBox.val(dateText);
                }
            },
            onSelect: function(selectedDateTime) {
                startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker(
                    'getDate'));
            }
        });

    });
    </script>

    <script>
    function add_row() {

        var table = document.getElementById("myTable");

        count_rows = table.getElementsByTagName("tr").length;


        var row = table.insertRow(count_rows);

        var cell1 = row.insertCell(0);




        cell1.innerHTML = "<input type='text' name='project_name'class='inputFill-Information'" + count_rows +
            " value required>";

    }

    function del_row() {

        var table = document.getElementById("myTable");

        count_rows = table.getElementsByTagName("tr").length;

        document.getElementById("myTable").deleteRow(count_rows - 1);
    }
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
        <from action="/approval_db.php" method="post">
            <div class="grid-item">
                <div class="row">
                    <div class="col-25">
                        <label for="โครงการ" class="topic">โครงการ:</label>
                    </div>

                    <div class="col-65">
                        <input type="text" id="project_name" name="project_name" class="inputFill-Information" required>
                    </div>

                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ" class="topic">ลักษณะโครงการ : </label>
                    </div>
                    <div class="col-65">
                        <select name="project_style" class="inputFill-Information" required>
                            <option value=""> กรุณาเลือก </option>
                            <?php foreach($result as $results){?>
                            <option value="<?php echo $results["department_name"];?>">
                                <?php echo $results["department_name"]; ?>
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
                        <input type="text" id="project_name" name="project_strategy" class="inputFill-Information"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ภายใต้แผนงานประจำ" class="topic">ภายใต้แผนงานประจำ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_name" name="project_routine" class="inputFill-Information"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ฝ่ายงาน" class="topic">ฝ่ายงาน : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_name" name="project_department
" class="inputFill-Information" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="หลักการและเหตุผล" class="topic">หลักการและเหตุผล : </label>
                    </div>
                    <div class="col-65">
                        <textarea id="project_name" name="project_reason" rows="4" cols="50"
                            class="inputFill-Information-large" required>
                        </textarea>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ" class="topic">วัตถุประสงค์ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_name" name="project_objective" class="inputFill-Information"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">ลักษณะการดำเนินงาน : </label>
                    </div>
                    <div class="col-65">
                        <textarea id="project_name" name="operation
" rows="4" cols="50" class="inputFill-Information-large" required>
                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">ระยะเวลาดำเนินการ : </label>
                    </div>
                    <div class="col-65">
                        <!-- <input type="text" id="project_name" name="project_name" class="inputFill-Information" required> -->
                        <input type="text" id="dateStart" name="dateStart" class="inputFill-Information-Datepicker"
                            required>
                        <label-inline class="topic">ถึง</label-inline>

                        <input type="text" id="dateEnd" name="dateEnd" class="inputFill-Information-Datepicker"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">สถานที่ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_name" name="project_place
" class="inputFill-Information" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">งบประมาณ : </label>
                    </div>
                    <div class="col-65">

                    </div>
                </div>
                <div class="row">

                    <div class="col-25">

                        <label for="ลักษณะโครงการ : " class="topic">1. ค่าตอบแทน : </label>
                    </div>
                    <div class="col-65">
                        <tr><input type="text" id="project_name" name="project_name" class="inputFill-Information"
                                required>
                            <td>รายการ</td>
                            <td>จำนวน</td>
                            <td>ราคา</td>
                        </tr>


                        <table class="style-table" id="myTable">
                        </table>

                        <button class="add-drop-tableButton" onclick="add_row()">+</button>
                        <button class="add-drop-tableButton" onclick="del_row()">-</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">2. ค่าใช้สอย : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_name" name="project_name" class="inputFill-Information" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">2. ค่าวัสดุ : </label>
                    </div>
                    <div class="col-65">
                        <input type="text" id="project_name" name="project_name" class="inputFill-Information" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">หมายเหตุ </label><br>
                        <label for="ลักษณะโครงการ : " class="topic">1. ใช้งบประมาณเงินรายได้
                            โครงการตามแผนยุทธศาสตร์<br>2. ขอถัวเฉลี่ยจ่ายทุกรายการ </label><br>
                    </div>

                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="ลักษณะโครงการ : " class="topic">ตัวชี้วัดโครงการ : </label>
                    </div>
                    <div class="col-65">

                    </div>
                </div>
                <div class="row">

                    <div class="col-65">
                        <label for="ลักษณะโครงการ : " class="topic">1. </label>
                        <input type="text" id="project_name" name="
project_metrics1" class="inputFill-Information" required>
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
                        <input type="text" id="project_name" name="responsible_man" class="inputFill-Information"
                            required>
                    </div>
                </div>
                <div class="container-button">
                    <button type="reset" value="reset" class="backButton">Back </button>
                    <button type="submit" name="submit" class="summitButton">Submit</button>
                </div>
            </div>

        </from>
    </div>


</body>

</html>