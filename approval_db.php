<?php
    // session_start();
    // include('config/db.php');
    session_start();
    include('config/db.php');
    $user_id=$_SESSION['user_id'];
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
    echo $pro_name;
    // ลักษณะโครงการ
    isset($_REQUEST['pro_style']) ? $pro_style = $_REQUEST['pro_style'] : $pro_style = '';
    echo $pro_style;
    // ภายใต้ยุทธศาสตร์
    isset($_REQUEST['pro_strategy']) ? $pro_strategy = $_REQUEST['pro_strategy'] : $pro_strategy = '';
    echo $pro_strategy;
    // ภายใต้แผนงานประจำ
    isset($_REQUEST['pro_routine']) ? $pro_routine = $_REQUEST['pro_routine'] : $pro_routine = '';
    echo $pro_routine;
    // ฝ่ายงาน
    isset($_REQUEST['pro_department']) ? $pro_department = $_REQUEST['pro_department'] : $pro_department = '';
    echo $pro_department;
    // หลักการและเหตุผล
    isset($_REQUEST['pro_reason']) ? $pro_reason = $_REQUEST['pro_reason'] : $pro_reason = '';
    echo $pro_reason;
    // วัตถุประสงค์
    isset($_REQUEST['pro_objective']) ? $pro_objective = $_REQUEST['pro_objective'] : $pro_objective = '';
    echo $pro_objective;
    // ลักษณะการดำเนินงาน
    isset($_REQUEST['pro_operation']) ? $pro_operation = $_REQUEST['pro_operation'] : $pro_operation = '';
    echo $pro_operation;
    // ระยะเวลาดำเนินการ
    isset($_REQUEST['pro_dateStart']) ? $pro_dateStart = $_REQUEST['pro_dateStart'] : $pro_dateStart = '';
    echo $pro_dateStart;
    isset($_REQUEST['pro_dateEnd']) ? $pro_dateEnd = $_REQUEST['pro_dateEnd'] : $pro_dateEnd = '';
    echo $pro_dateEnd;
    // สถานที่
    isset($_REQUEST['pro_place']) ? $pro_place = $_REQUEST['pro_place'] : $pro_place = '';
    echo $pro_place;
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
    // แผนการดำเนินงาน
    
        // $pro_name = mysqli_real_escape_string($conn,$_POST['pro_name']);
        // $pro_style = mysqli_real_escape_string($conn,$_POST['pro_style']);
        // $pro_strategy = mysqli_real_escape_string($conn,$_POST['pro_strategy']);
        // $pro_routine = mysqli_real_escape_string($conn,$_POST['pro_routine']);
        // $pro_department = mysqli_real_escape_string($conn,$_POST['pro_department']);
        // $pro_reason = mysqli_real_escape_string($conn,$_POST['pro_reason']);
        // $pro_objective = mysqli_real_escape_string($conn,$_POST['pro_objective']);
        // $pro_operation = mysqli_real_escape_string($conn,$_POST['pro_operation']);
        // $pro_dateStart = mysqli_real_escape_string($conn,$_POST['pro_dateStart']);
        // $pro_dateEnd = mysqli_real_escape_string($conn,$_POST['pro_dateEnd']);
        // $pro_place = mysqli_real_escape_string($conn,$_POST['pro_place']);
        // $project_compensation = mysqli_real_escape_string($conn,$_POST['compensation']);
        // $project_cost = mysqli_real_escape_string($conn,$_POST['cost_id']);
        // $project_material = mysqli_real_escape_string($conn,$_POST['material']);
        // $user_id = mysqli_real_escape_string($conn,$_POST['user_id']);


        // if (empty($email)) {
        //     array_push($errors,"Email is required");
        // }

        // if (empty($password)) {
        //     array_push($errors,"Password is required");
        // }
        $date=date("Y-m-d H:i:s");

  
        
        $user_check_query = "SELECT * FROM project_info WHERE project_name = '$pro_name'  LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);
        $user_id=$_SESSION['user_id'];
        if ($result) { // if user exists
            if ($result['project_name'] === $pro_name) {
                array_push($errors, "project_name already exists");
            }}
        
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
        echo ("error:");
        foreach($errors as $value){

            //Print the element out.
        
            echo  $value; '<br>';
        
        }
       

        if (count($errors)==0) {
         
            $sql = "INSERT INTO project_info(project_name, project_style, routine_plan, department_id, reason, period_op, period_ed, user_id, project_place, project_strategy,submit_date) 
            VALUES ('$pro_name','$pro_style','$pro_routine','$pro_department','$pro_reason','$pro_dateStart','$pro_dateEnd','$user_id','$pro_place','$pro_strategy','$date')";
            mysqli_query($conn,$sql);

            $_SESSION['pro_name'] = $pro_name;
            $_SESSION['success'] = "You are save project name";
            
if ($_SESSION['success']=="You are save project name") {
    # code...

// ส่วนของการเก็บข้อมูลเข้าในตาราง
            $sqlGetID = "SELECT * FROM project_info WHERE project_name = '$pro_name' ";
            $result = mysqli_query($conn,$sqlGetID);
            // เช็คไอดีโปรเจค
            foreach($result as $values){

                //Print the element out.
            
                echo  $values["project_id"];
            
            }
      

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
            }
        }
  

}


?>