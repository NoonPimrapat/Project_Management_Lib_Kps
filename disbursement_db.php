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
    isset($_REQUEST['project_id']) ? $pro_name = $_REQUEST['project_id'] : $project_id = '';
    // echo $pro_name;

    $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);


    // if (empty($email)) {
    //     array_push($errors,"Email is required");
    // }

    // if (empty($password)) {
    //     array_push($errors,"Password is required");
    // }

    $date = date("Y-m-d H:i:s");

    $user_check_query = "SELECT * FROM project_info WHERE project_id = '$project_id'  LIMIT 1";
    $query = mysqli_query($conn, $user_check_query);
    $result = mysqli_fetch_assoc($query);
    $user_id = $_SESSION['user_id'];
 

    if (empty($project_id)) {
        array_push($errors, "project_id is required");
        $_SESSION['error'] = "project_id is required";
    }
    
  


    foreach ($errors as $value) {
        //Print the element out.
        echo ("<br>Error:");
        echo  $value;
        '<br>';
    }

    if (count($errors) == 0) {

        $sql = "INSERT INTO project_info(project_id,  user_id) VALUES ('$project_id','$user_id')";
        print_pre($sql);
        mysqli_query($conn, $sql);

        if ($_SESSION['success'] == "You are save project name") {

            echo "in";

            // ส่วนของการเก็บข้อมูลเข้าในตาราง
            $sqlGetID = "SELECT * FROM project_info WHERE project_id = '$project_id' ";
            $result = mysqli_query($conn, $sqlGetID);

            foreach ($result as $values) {
                $project_id = $values["project_id"];
                $project_name = $values["project_name"];
               $_SESSION['project_name']=$values["project_name"];

            }
$search_project_id="SELECT DISTINCT $project_id FROM report_budget WHERE report_project_id ='$project_id'" ; /**DISTINCT คือ ถ้าข้อมูลซ้ำกันเอามาอันเดียว */
$result_search_project_id = mysqli_query($conn, $search_project_id);
$result_search = mysqli_fetch_assoc($result_search_project_id);

    if ($result_search==0) {
    # code...
    echo ('เข้ามาแล้วจ่ะ');
// งบประมาณ
            $budgets = array();
            $report_num=1;
            $compensation = $_REQUEST['compensation'] ? $_REQUEST['compensation'] : '';
            $budgets = getVal($compensation, 'compensation', $budgets, $project_id);

            $costs = $_REQUEST['cost'] ? $_REQUEST['cost'] : '';
            $budgets = getVal($costs, 'cost', $budgets, $project_id);

            $material = $_REQUEST['material'] ? $_REQUEST['material'] : '';
            $budgets = getVal($material, 'material', $budgets, $project_id);

            foreach ($budgets as $key => $value) {
                $sql = "INSERT INTO report_budget(report_project_id, report_budget_group, report_item, report_price, report_quantity,report_status,report_num) VALUES('{$value['project_id']}', '{$value['budget_group']}', '{$value['item']}', '{$value['price']}', '{$value['quantity']}','0','$report_num')";
                print_pre($sql);
                mysqli_query($conn, $sql);
            }
    }else {
    # code...
    echo ('ไม่เข้าจ่ะ');
    $search_report_num="SELECT * FROM report_budget WHERE report_project_id ='$project_id' ORDER BY report_num DESC " ; /**DISTINCT คือ ถ้าข้อมูลซ้ำกันเอามาอันเดียว */
    $result_search_report_num = mysqli_query($conn, $search_report_num);
    $result_search = mysqli_fetch_assoc($result_search_report_num);
    $report_num=$result_search['report_num'];
    echo $report_num;
    $budgets = array();
            $report_num=$report_num+1;
            $compensation = $_REQUEST['compensation'] ? $_REQUEST['compensation'] : '';
            $budgets = getVal($compensation, 'compensation', $budgets, $project_id);

            $costs = $_REQUEST['cost'] ? $_REQUEST['cost'] : '';
            $budgets = getVal($costs, 'cost', $budgets, $project_id);

            $material = $_REQUEST['material'] ? $_REQUEST['material'] : '';
            $budgets = getVal($material, 'material', $budgets, $project_id);

            foreach ($budgets as $key => $value) {
                $sql = "INSERT INTO report_budget(report_project_id, report_budget_group, report_item, report_price, report_quantity,report_status,report_num,report_submit_date) VALUES('{$value['project_id']}', '{$value['budget_group']}', '{$value['item']}', '{$value['price']}', '{$value['quantity']}','0','$report_num','$date')";
                print_pre($sql);
                mysqli_query($conn, $sql);
            }
}
// if (condition) {
//     # code...
// }
            // send line noti
            line_noti("\nมีการเบิกงบประมาณโครงการ\nโครงการ: {$project_name}\n");
            // header("location:approval_confirm.php");exit;
            // echo("<script>location.href ='/Project_Management_Lib_Kps/disbursement_confirm.php?';</script>");
            echo("<script>window.open('disbursement_confirm.php?id={$project_id}','_self');</script>");
        }
    }
}

function line_noti($msn)
{
    $status = false;
    $message = "404 error.";
    if ($msn) :

        $curl = curl_init();
        $LINE_API_KEY = "LIBWf00oYPIzo4pUDKherAXCQfCiS5NLnE6b8i409eH";//ใส่Key
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