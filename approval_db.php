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

if (isset($_POST['Add_Project'])) {
    // ชื่อโครงการ
    isset($_REQUEST['pro_name']) ? $pro_name = $_REQUEST['pro_name'] : $pro_name = '';
    // echo $pro_name;
    // ลักษณะโครงการ
    isset($_REQUEST['pro_style']) ? $pro_style = $_REQUEST['pro_style'] : $pro_style = '';
    // echo $pro_style;
    // ภายใต้ยุทธศาสตร์
    isset($_REQUEST['pro_strategy']) ? $pro_strategy = $_REQUEST['pro_strategy'] : $pro_strategy = '';
    // echo $pro_strategy;
    // ภายใต้แผนงานประจำ
    isset($_REQUEST['pro_routine']) ? $pro_routine = $_REQUEST['pro_routine'] : $pro_routine = '';
    // echo $pro_routine;
    // ฝ่ายงาน
    isset($_REQUEST['pro_department']) ? $pro_department = $_REQUEST['pro_department'] : $pro_department = '';
    // echo $pro_department;
    // หลักการและเหตุผล
    isset($_REQUEST['pro_reason']) ? $pro_reason = $_REQUEST['pro_reason'] : $pro_reason = '';
    // echo $pro_reason;
    // วัตถุประสงค์
    isset($_REQUEST['pro_objective']) ? $pro_objective = $_REQUEST['pro_objective'] : $pro_objective = '';
    // echo $pro_objective;
    // ลักษณะการดำเนินงาน
    isset($_REQUEST['pro_operation']) ? $pro_operation = $_REQUEST['pro_operation'] : $pro_operation = '';
    // echo $pro_operation;
    // ระยะเวลาดำเนินการ
    isset($_REQUEST['pro_dateStart']) ? $pro_dateStart = $_REQUEST['pro_dateStart'] : $pro_dateStart = '';
    // echo $pro_dateStart;
    isset($_REQUEST['pro_dateEnd']) ? $pro_dateEnd = $_REQUEST['pro_dateEnd'] : $pro_dateEnd = '';
    // echo $pro_dateEnd;
    // สถานที่
    isset($_REQUEST['pro_place']) ? $pro_place = $_REQUEST['pro_place'] : $pro_place = '';
    // echo $pro_place;

    // ค่าตอบแทน
    // isset($_REQUEST['pro_compensation']) ? $pro_compensation = $_REQUEST['pro_compensation'] : $pro_compensation = '';
    // echo $pro_compensation;
    // // ค่าใช้สอย
    // isset($_REQUEST['pro_cost']) ? $pro_cost = $_REQUEST['pro_cost'] : $pro_cost = '';
    // echo $pro_cost;
    // // ค่าวัสดุ
    // isset($_REQUEST['pro_material']) ? $pro_material = $_REQUEST['pro_material'] : $pro_material = '';
    // echo $pro_material;
    // ตัวชี้วัดโครงการ

    // ค่าเป้าหมาย

    // ผู้รับผิดชอบโครงการ
    isset($_REQUEST['user_id']) ? $user_id = $_REQUEST['user_id'] : $user_id = '';
    echo $user_id;

    $pro_name = mysqli_real_escape_string($conn, $_POST['pro_name']);
    $pro_style = mysqli_real_escape_string($conn, $_POST['pro_style']);
    $pro_strategy = mysqli_real_escape_string($conn, $_POST['pro_strategy']);
    $pro_routine = mysqli_real_escape_string($conn, $_POST['pro_routine']);
    $pro_department = mysqli_real_escape_string($conn, $_POST['pro_department']);
    $pro_reason = mysqli_real_escape_string($conn, $_POST['pro_reason']);
    $pro_objective = mysqli_real_escape_string($conn, $_POST['pro_objective']);
    $pro_operation = mysqli_real_escape_string($conn, $_POST['pro_operation']);
    $pro_dateStart = mysqli_real_escape_string($conn, $_POST['pro_dateStart']);
    $pro_dateEnd = mysqli_real_escape_string($conn, $_POST['pro_dateEnd']);
    $pro_place = mysqli_real_escape_string($conn, $_POST['pro_place']);
    $project_sum_total = mysqli_real_escape_string($conn, $_POST['project_sum_total']);

    // if (empty($email)) {
    //     array_push($errors,"Email is required");
    // }

    // if (empty($password)) {
    //     array_push($errors,"Password is required");
    // }

    $date = date("Y-m-d H:i:s");

    $user_check_query = "SELECT * FROM project_info WHERE project_name = '$pro_name'  LIMIT 1";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);
    $user_id = $_SESSION['user_id'];
    if ($result) { // if user exists
        if ($result['project_name'] === $pro_name) {
            array_push($errors, "project_name already exists");
        }
    }

    if (empty($pro_name)) {
        array_push($errors, "pro_name is required");
        $_SESSION['error'] = "pro_name is required";
    }
    if (empty($pro_style)) {
        array_push($errors, "pro_style is required");
        $_SESSION['error'] = "pro_style is required";
    }
    if (empty($pro_strategy)) {
        array_push($errors, "pro_strategy is required");
        $_SESSION['error'] = "pro_strategy is required";
    }
    if (empty($pro_routine)) {
        array_push($errors, "pro_routine is required");
        $_SESSION['error'] = "pro_routine is required";
    }
    if (empty($pro_department)) {
        array_push($errors, "department is required");
        $_SESSION['error'] = "department is required";
    }
    if (empty($pro_reason)) {
        array_push($errors, "pro_reason is required");
        $_SESSION['error'] = "pro_reason is required";
    }
    if (empty($pro_objective)) {
        array_push($errors, "pro_objective is required");
        $_SESSION['error'] = "pro_objective is required";
    }
    if (empty($pro_operation)) {
        array_push($errors, "operation is required");
        $_SESSION['error'] = "operation is required";
    }
    if (empty($pro_dateStart)) {
        array_push($errors, "dateStart is required");
        $_SESSION['error'] = "dateStart is required";
    }
    if (empty($pro_dateEnd)) {
        array_push($errors, "dateEnd is required");
        $_SESSION['error'] = "dateEnd is required";
    }
    if (empty($pro_place)) {
        array_push($errors, "pro_place is required");
        $_SESSION['error'] = "pro_place is required";
    }
    if (empty($user_id)) {
        array_push($errors, "user_id is required");
        $_SESSION['error'] = "user_id is required";
    }

    foreach ($errors as $value) {
        //Print the element out.
        echo ("<br>Error:");
        echo  $value;
        '<br>';
    }

    if (count($errors) == 0) {

        $sql = "INSERT INTO project_info(project_name, project_style, routine_plan, department_id, reason, period_op, period_ed, user_id, project_place, project_strategy,submit_date,project_sum_total) VALUES ('$pro_name','$pro_style','$pro_routine','$pro_department','$pro_reason','$pro_dateStart','$pro_dateEnd','$user_id','$pro_place','$pro_strategy','$date','$project_sum_total')";
        print_pre($sql);
        mysqli_query($conn, $sql);

        $_SESSION['pro_name'] = $pro_name;
        $_SESSION['success'] = "You are save project name";

        if ($_SESSION['success'] == "You are save project name") {

            echo "in";

            // ส่วนของการเก็บข้อมูลเข้าในตาราง
            $sqlGetID = "SELECT * FROM project_info WHERE project_name = '$pro_name' ";
            $result = mysqli_query($conn, $sqlGetID);

            foreach ($result as $values) {
                $project_id = $values["project_id"];
               $_SESSION['project_id']=$values["project_id"];

            }

            // งบประมาณ
            $budgets = array();
            $compensation = $_REQUEST['compensation'] ? $_REQUEST['compensation'] : '';
            $budgets = getVal($compensation, 'compensation', $budgets, $project_id);

            $costs = $_REQUEST['cost'] ? $_REQUEST['cost'] : '';
            $budgets = getVal($costs, 'cost', $budgets, $project_id);

            $material = $_REQUEST['material'] ? $_REQUEST['material'] : '';
            $budgets = getVal($material, 'material', $budgets, $project_id);

            foreach ($budgets as $key => $value) {
                $sql = "INSERT INTO project_budget(project_id, budget_group, item, price, quantity) VALUES('{$value['project_id']}', '{$value['budget_group']}', '{$value['item']}', '{$value['price']}', '{$value['quantity']}')";
                print_pre($sql);
                mysqli_query($conn, $sql);
            }

            // แผนการดำเนินงาน
            $plant_detail = isset($_REQUEST['plant_detail']) ? $_REQUEST['plant_detail'] : array();
            $plant_time = isset($_REQUEST['plant_time']) ? $_REQUEST['plant_time'] : array();

            $loop = count($plant_detail);
            if ($loop) {
                echo "insert table plant ...";
                $valueUpsert = array();
                for ($i = 0; $i < $loop; $i++) {
                    # code...
                    $detail = isset($plant_detail[$i]) ? $plant_detail[$i] : "";
                    $time = isset($plant_time[$i]) ? $plant_time[$i] : "";
                    if ($detail && $time) $valueUpsert[] = "('{$project_id}', '{$detail}', '{$time}')";
                }
                if ($valueUpsert) {
                    $value = join(",", $valueUpsert);
                    $sql = "INSERT INTO project_plant(project_id, plant_detail, plant_time) VALUES $value";
                    print_pre($sql);
                    mysqli_query($conn, $sql);
                }
            }

            // send line noti
            // line_noti("\nมีการร้องขออนุมัติโครงการ\nโครงการ: {$pro_name}\nเริ่ม: {$pro_dateStart}\nสิ้นสุด: {$pro_dateEnd}");

            // for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){
            //     if(isset($_POST["txtCustomerID$i"]))
            //     {
            //     if($_POST["txtCustomerID$i"] != "" &&
            //     $_POST["txtName$i"] != "" &&
            //     $_POST["txtEmail$i"] != "" &&
            //     $_POST["txtCountryCode$i"] != "" &&
            //     $_POST["txtBudget$i"] != "" &&
            //     $_POST["txtUsed$i"] != "")
            //     {
            //     $sql = "INSERT INTO customer (CustomerID, Name, Email, CountryCode, Budget, Used)
            //     VALUES ('".$_POST["txtCustomerID$i"]."','".$_POST["txtName$i"]."','".$_POST["txtEmail$i"]."'
            //     ,'".$_POST["txtCountryCode$i"]."','".$_POST["txtBudget$i"]."','".$_POST["txtUsed$i"]."')";
            //     $query = mysqli_query($conn,$sql);
            //     }
            //     }
            //     }  
            // ส่วนของการเก็บข้อมูลเข้าในตาราง
            header("location: approval_confirm.php");
        }
    }
}

function getVal($datas, $group, $budgets, $project_id)
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
        $LINE_API_KEY = "";//ใส่Key
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