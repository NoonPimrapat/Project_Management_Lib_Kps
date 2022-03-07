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

if (isset($_POST['disbursement'])) {
    // ชื่อโครงการ
    isset($_REQUEST['pro_name']) ? $pro_name = $_REQUEST['pro_name'] : $pro_name = '';
    // echo $pro_name;

    $pro_name = mysqli_real_escape_string($conn, $_POST['pro_name']);
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
    
    if (empty($project_fiscal_year)) {
        array_push($errors, "project_fiscal_year is required");
        $_SESSION['error'] = "project_fiscal_year is required";
    }


    foreach ($errors as $value) {
        //Print the element out.
        echo ("<br>Error:");
        echo  $value;
        '<br>';
    }

    if (count($errors) == 0) {

        $sql = "INSERT INTO project_info(project_name, project_style, routine_plan, department_id, reason, period_op, period_ed, user_id, project_place, project_strategy,submit_date,project_sum_total,status_project,project_fiscal_year) VALUES ('$pro_name','$pro_style','$pro_routine','$pro_department','$pro_reason','$pro_dateStart','$pro_dateEnd','$user_id','$pro_place','$pro_strategy','$date','$project_sum_total','ขออนุมัติโครงการ',$project_fiscal_year)";
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
            line_noti("\nมีการร้องขออนุมัติเบิก-จ่ายโครงการ\nโครงการ: {$pro_name}\nเริ่ม: {$pro_dateStart}\nสิ้นสุด: {$pro_dateEnd}");
            // header("location:approval_confirm.php");exit;
            echo("<script>location.href ='/Project_Management_Lib_Kps/approval_confirm.php?';</script>");
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
?>