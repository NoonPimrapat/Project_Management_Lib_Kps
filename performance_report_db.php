<?php
// session_start();
// include('config/db.php');
session_start();
include('config/db.php');
$user_id = $_SESSION['user_id'];
// echo  ("$user_id");
// echo  $user_id;
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// echo '<hr>';

// echo '<pre>';
// var_dump($_POST);

// echo '</pre>';
// exit;

$errors = array();

if (isset($_POST['performance_report'])) {

    // ผู้รับผิดชอบโครงการ
    isset($_REQUEST['project_id']) ? $project_id = $_REQUEST['project_id'] : $project_id = '';
    isset($_POST['compensation']) ?  $_POST['compensation'] : $compensation = '';

    $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);
    $progress_quarter = mysqli_real_escape_string($conn, $_POST['progress_quarter']);
    $indicator_1  = mysqli_real_escape_string($conn, $_POST['indicator_1']);
    $indicator_2  = mysqli_real_escape_string($conn, $_POST['indicator_2']);
    // $activity_pictures  =  $_POST['activity_pictures'];
    // foreach($_FILES['files[]']['tmp_name'] as $key => $val)
    // {
    // 	$file_name = $_FILES['files[]']['name'][$key];
    // 	$file_size =$_FILES['files[]']['size'][$key];
    // 	$file_tmp =$_FILES['files[]']['tmp_name'][$key];
    // 	$file_type=$_FILES['files[]']['type'][$key];  
    // 	move_uploaded_file($file_tmp,"myfile/".$file_name);
    // }
    // echo "Copy/Upload Complete";
    // foreach($activity_pictures as $pictures){
    //     echo $pictures . "<br />"; 
    //  }

    // $project_sum_total = mysqli_real_escape_string($conn, $_POST['project_sum_total']);
    // $project_fiscal_year=mysqli_real_escape_string($conn, $_POST['project_fiscal_year']);
    // $project_metrics1=mysqli_real_escape_string($conn, $_POST['project_metrics1']);
    // $target_value1=mysqli_real_escape_string($conn, $_POST['target_value1']);
    // $project_metrics2=mysqli_real_escape_string($conn, $_POST['project_metrics2']);
    // $target_value2=mysqli_real_escape_string($conn, $_POST['target_value2']);

    if (empty($project_id)) {
        array_push($errors, "project_id is required");
    }


    // if (empty($password)) {
    //     array_push($errors,"Password is required");
    // }

    $date = date("Y-m-d H:i:s");



    foreach ($errors as $value) {
        //Print the element out.
        echo ("<br>Error:");
        echo  $value;
        '<br>';
    }


    if (count($errors) == 0) {

        //  // ส่วนของการเก็บข้อมูลเข้าในตาราง
        //  $sqlGetID = "SELECT * FROM project_info WHERE project_name = '$pro_name' ";
        //  $resultID = mysqli_query($conn, $sqlGetID);

        //  foreach ($resultID as $values) {
        //      $project_id = $values["project_id"];
        //     $_SESSION['project_id']=$values["project_id"];

        //  }

        $sql = "INSERT INTO progress_info(project_id, progress_quarter, indicator_1, indicator_2,user_id) 
        VALUES ('$project_id','$progress_quarter','$indicator_1','$indicator_2','$user_id')";
        // print_pre($sql);
        mysqli_query($conn, $sql);

        $_SESSION['project_id'] = $project_id;
        $_SESSION['success'] = "You are save project name";

        // หาprogress_id
        $sqlGetID = "SELECT * FROM progress_info WHERE project_id = '$project_id' ";
        $resultID = mysqli_query($conn, $sqlGetID);

        foreach ($resultID as $values) {
            $progress_id = $values["progress_id"];
        }


        if ($_SESSION['success'] == "You are save project name") {

            echo "in";

            // งบประมาณ
            // $budgets = array();
            // $compensation = $_REQUEST['compensation'] ? $_REQUEST['compensation'] : '';
            // $budgets = getVal($compensation, 'compensation', $budgets, $project_id,$progress_id);

            // $costs = $_REQUEST['cost'] ? $_REQUEST['cost'] : '';
            // $budgets = getVal($costs, 'cost', $budgets, $project_id,$progress_id);

            // $material = $_REQUEST['material'] ? $_REQUEST['material'] : '';
            // $budgets = getVal($material, 'material', $budgets, $project_id,$progress_id);

            // foreach ($budgets as $key => $value) {
            //     // $sql = "INSERT INTO report_budget(report_project_id, report_budget_group, report_item, report_price, report_quantity,report_status) VALUES('{$value['project_id']}', '{$value['budget_group']}', '{$value['item']}', '{$value['price']}', '{$value['quantity']}', '{$value['progress_id']}')";
            //     // print_pre($sql);
            //     // mysqli_query($conn, $sql);
            $sqlUPDATE = "UPDATE report_budget SET report_status = 1 WHERE report_project_id = $project_id";
            // print_pre($sqlUPDATE);
            mysqli_query($conn, $sqlUPDATE);


            // }
            // set status ให้เป็น 1 ของงบประมาณ
            // $budgets = array();
            // $compensation = $_REQUEST['compensation'] ? $_REQUEST['compensation'] : '';
            // $budgets = getVal($compensation, 'compensation', $budgets, $project_id);

            // $costs = $_REQUEST['cost'] ? $_REQUEST['cost'] : '';
            // $budgets = getVal($costs, 'cost', $budgets, $project_id);

            // $material = $_REQUEST['material'] ? $_REQUEST['material'] : '';
            // $budgets = getVal($material, 'material', $budgets, $project_id);

            // foreach ($budgets as $key => $value) {
            //     $sql = "UPDATE  report_budget(project_id, budget_group, item, price, quantity) VALUES('{$value['project_id']}', '{$value['budget_group']}', '{$value['item']}', '{$value['price']}', '{$value['quantity']}')";

            //     print_pre($sql);
            //     mysqli_query($conn, $sql);
            // }


            // แผนการดำเนินงาน
            $plant_detail = isset($_REQUEST['plant_detail']) ? $_REQUEST['plant_detail'] : array();
            $plant_time = isset($_REQUEST['plant_time']) ? $_REQUEST['plant_time'] : array();
            $plant_location = isset($_REQUEST['plant_location']) ? $_REQUEST['plant_location'] : array();

            $loop = count($plant_detail);
            if ($loop) {
                echo "insert table plant ...";
                $valueUpsert = array();
                for ($i = 0; $i < $loop; $i++) {
                    # code...
                    $detail = isset($plant_detail[$i]) ? $plant_detail[$i] : "";
                    $time = isset($plant_time[$i]) ? $plant_time[$i] : "";
                    $location = isset($plant_location[$i]) ? $plant_location[$i] : "";
                    if ($detail && $time && $location) $valueUpsert[] = "('{$project_id}', '{$detail}', '{$time}','{$progress_id}')";
                }
                if ($valueUpsert) {
                    $value = join(",", $valueUpsert);
                    $sql = "INSERT INTO report_plant(project_id, report_detail, report_time,report_place) VALUES $value";
                    // print_pre($sql);
                    mysqli_query($conn, $sql);
                }
            }

            // delete attach file project group type
            $conn->query("DELETE FROM project_attach WHERE project_id = '{$project_id}' AND quarter = '{$progress_quarter}'");

            // insert attach image
            $project_attach = @$_POST['events_img'];
            if ($project_attach) {
                $values_attach = array();
                $attach_type = "event/image";
                foreach ($project_attach as $idx => $attach) {
                    $values_attach[] = "('{$project_id}', '{$progress_quarter}', '{$attach_type}', '{$attach}')";
                }
                if ($values_attach) {
                    // insert new value attach file
                    $insertValue = join(",", $values_attach);
                    $queryString = "INSERT INTO project_attach(project_id, quarter, attach_type, attach_value) VALUES {$insertValue}";
                    $conn->query($queryString);
                }
            }

            // echo "<br>";

            $target_dir = "uploads/";
            // insert file รายงานผลการประเมินความพึงพอใจ/การนำความรู้ไปใช้ประโยชน์
            // รูปแบบ attach_value : uploads/48b263c497bed859cfccc48472366b7b.jpg
            $target_file = $target_dir . basename($_FILES["assessment"]["name"]);
            if (move_uploaded_file($_FILES["assessment"]["tmp_name"], $target_file)) {
                $queryString = "INSERT INTO project_attach(project_id, quarter, attach_type, attach_value) VALUES ('{$project_id}', '{$progress_quarter}', 'event/file-1', '{$target_file}')";
                // echo "{$queryString} <br>";
                $conn->query($queryString);
            }


            // insert file เอกสารการลงทะเบียนเข้าร่วมกิจกรรม(ถ้ามี)
            // รูปแบบ attach_value : uploads/48b263c497bed859cfccc48472366b7b.jpg
            $target_file = $target_dir . basename($_FILES["registration"]["name"]);
            if (move_uploaded_file($_FILES["registration"]["tmp_name"], $target_file)) {
                $queryString = "INSERT INTO project_attach(project_id, quarter, attach_type, attach_value) VALUES ('{$project_id}', '{$progress_quarter}', 'event/file-2', '{$target_file}')";
                // echo "{$queryString} <br>";
                $conn->query($queryString);
            }

            // send line noti
            line_noti("\nมีการรายงานผลการดำเนินโครงการ\nโครงการ: {$project_id}");
            // header("location:approval_confirm.php");exit;
            echo ("<script>location.href ='/Project_Management_Lib_Kps/performance_confirm.php?';</script>");
        }
    }
}


function getVal($datas, $group, $budgets, $project_id, $progress_id)
{
    if ($datas) {
        $item = $datas['item'];
        $price = $datas['price'];
        $quantity = $datas['quantity'];
        $loop = count($item);
        for ($i = 0; $i < $loop; $i++) {
            if (empty($item[$i]) || empty($quantity[$i]) || empty($price[$i])) continue;
            $budgets[] = array(
                'project_id' => $project_id,
                'budget_group' => $group,
                'item' => $item[$i],
                'price' => $price[$i],
                'quantity' => $quantity[$i],
                'progress_id' => $progress_id[$i],
            );
        }
    }
    return $budgets;
}

function line_noti($msn)
{
    $status = false;
    $message = "404 error.";
    if ($msn) :

        $curl = curl_init();
        $LINE_API_KEY = "LIBWf00oYPIzo4pUDKherAXCQfCiS5NLnE6b8i409eH"; //ใส่Key
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://notify-api.line.me/api/notify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "message={$msn}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer {$LINE_API_KEY}",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $message = "cURL Error #:" . $err;
        } else {
            $status = true;
            $message = "Success";
        }
    endif;
    echo json_encode(array('status' => $status, 'message' => $message, 'response' => $response));
}
