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

if (isset($_POST['close_project'])) {

    // ผู้รับผิดชอบโครงการ
    isset($_REQUEST['project_id']) ? $project_id = $_REQUEST['project_id'] : $project_id = '';
    echo "project_id";
    echo $project_id;
    // isset($_POST['compensation']) ?  $_POST['compensation'] :$compensation ='';


    
    $project_id = mysqli_real_escape_string($conn, $_POST['project_id']);

    $indicator_1_result  = mysqli_real_escape_string($conn, $_POST['indicator_1_result']);
    $indicator_2_result  = mysqli_real_escape_string($conn, $_POST['indicator_2_result']);
    $indicator_success1 = mysqli_real_escape_string($conn, $_POST['indicator_success1']);
    $indicator_success2 = mysqli_real_escape_string($conn, $_POST['indicator_success2']);
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
        array_push($errors,"project_id is required");
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
        echo "$user_id";   
        echo $user_id;
         
        $sql = "UPDATE  project_info SET indicator_1_result=$indicator_1_result, indicator_2_result=$indicator_2_result, indicator_success1=$indicator_success1,indicator_success2=$indicator_success2 WHERE report_project_id = $project_id";
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
         echo "ID";   
         echo $progress_id;

        if ($_SESSION['success'] == "You are save project name") {

            echo "in";

           
                $sqlUPDATE="UPDATE report_budget SET report_status = 1 WHERE report_project_id = $project_id";
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
           
            // send line noti
            line_noti("\nมีขออนุมัติเบิกค่าใช้จ่ายและปิดโครงการ\nโครงการ: {$project_id}");
            // header("location:approval_confirm.php");exit;
            echo("<script>location.href ='/Project_Management_Lib_Kps/close_project_confirm.php?';</script>");
        }
    }
}


function getVal($datas, $group, $budgets, $project_id,$progress_id)
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
?>