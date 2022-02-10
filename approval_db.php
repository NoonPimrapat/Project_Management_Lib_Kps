<?php
    session_start();
    include('config/db.php');

    $errors = array();
    if (isset($_POST['submit'])) {
       

        isset($_REQUEST['project_name']) ? $project_name = $_REQUEST['project_name'] : $project_name = '';
    echo $project_name;
    isset($_REQUEST['project_style']) ? $project_style = $_REQUEST['project_style'] : $project_style = '';
    echo $project_style;
    isset($_REQUEST['project_strategy']) ? $project_strategy = $_REQUEST['project_strategy'] : $project_strategy = '';
    echo $project_strategy;
    isset($_REQUEST['project_routine']) ? $project_routine = $_REQUEST['project_routine'] : $project_routine = '';
    echo $project_routine;
    isset($_REQUEST['project_department']) ? $project_department = $_REQUEST['project_department'] : $project_department = '';
    echo $project_department;
    isset($_REQUEST['project_reason']) ? $project_reason = $_REQUEST['project_reason'] : $project_reason = '';
    echo $project_reason;
    isset($_REQUEST['project_objective']) ? $project_objective = $_REQUEST['project_objective'] : $project_objective = '';
    echo $project_objective;
    isset($_REQUEST['operation']) ? $operation = $_REQUEST['operation'] : $operation = '';
    echo $operation;
    isset($_REQUEST['dateStart']) ? $dateStart = $_REQUEST['dateStart'] : $dateStart = '';
    echo $dateStart;
    isset($_REQUEST['dateEnd']) ? $dateEnd = $_REQUEST['dateEnd'] : $dateEnd = '';
    echo $dateEnd;
    isset($_REQUEST['project_place']) ? $project_place = $_REQUEST['project_place'] : $project_place = '';
    echo $project_place;
    
    $project_name = mysqli_real_escape_string($conn,$_POST['project_name']);
    $project_style = mysqli_real_escape_string($conn,$_POST['project_style']);
    $project_strategy = mysqli_real_escape_string($conn,$_POST['project_strategy']);
    $project_routine = mysqli_real_escape_string($conn,$_POST['project_routine']);
    $project_department = mysqli_real_escape_string($conn,$_POST['project_department']);
    $project_reason = mysqli_real_escape_string($conn,$_POST['project_reason']);
    $project_objective = mysqli_real_escape_string($conn,$_POST['project_objective']);
    $operation = mysqli_real_escape_string($conn,$_POST['operation']);
    $dateStart = mysqli_real_escape_string($conn,$_POST['dateStart']);
    $dateEnd = mysqli_real_escape_string($conn,$_POST['dateEnd']);
    $project_place = mysqli_real_escape_string($conn,$_POST['project_place']);

        // if (empty($email)) {
        //     array_push($errors,"Email is required");
        // }

        // if (empty($password)) {
        //     array_push($errors,"Password is required");
        // }
        $user_check_query = "SELECT * FROM project_info WHERE project_name = '$project_name'  LIMIT 1";
        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);


        if (count($errors)==0) {
         
            $sql = "INSERT INTO project_info (project_name) VALUES ('$project_name')";
            mysqli_query($conn, $sql);

            $_SESSION['project_name'] = $project_name;
            $_SESSION['success'] = "You are save project name";
        }
    

}
?>