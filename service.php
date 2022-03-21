<?php

include('config/db.php');

$monthArrayTh = array(
  'มกราคม',
  'กุมภาพันธ์',
  'มีนาคม',
  'เมษายน',
  'พฤษภาคม',
  'มิถุนายน',
  'กรกฎาคม',
  'สิงหาคม',
  'กันยายน',
  'ตุลาคม',
  'พฤศจิกายน',
  'ธันวาคม'
);

$target = @$_POST['target'];
switch ($target) {
  case 'ProjectDetail':
    $pid = $_POST['project_id'];
    GetProjectDetail($pid);
    break;
  case 'RequestApprovalChoiceProjectPlan':
    $pid = $_POST['project_id'];
    GetRequestApprovalChoiceProjectPlan($pid);
    break;
  case 'ReportProject':
    GetReportProject();
    break;
  default:
    echo json_encode(array('error' => true, 'errorMessage' => '404 function not found.'));
    break;
}


function GetProjectDetail($pid = "")
{
  global $conn;
  $data = array();
  $error = true;
  $errorMessage = "400 Bad Request. [project_id] not empty.";
  if ($pid) {
    $queryString = "SELECT * FROM `project_info` WHERE project_id = {$pid}";
    $result = $conn->query($queryString);
    $data = $result->fetch_assoc();
    $error = false;
    $errorMessage = "Success";
  }
  echo json_encode(array('error' => $error, 'data' => $data, 'errorMessage' => $errorMessage));
}

function GetRequestApprovalChoiceProjectPlan($pid = "")
{
  global $conn;
  global $monthArrayTh;
  $data = array();
  $error = true;
  $errorMessage = "400 Bad Request. [project_id] not empty.";
  if ($pid) {
    $queryString = "SELECT * FROM `project_info` WHERE project_id = {$pid}";
    $result = $conn->query($queryString);
    $query = $result->fetch_assoc();
    if ($query) {
      list($yop, $mop, $dop) = explode("-", $query['period_op']);
      list($yed, $med, $ded) = explode("-", $query['period_ed']);
      $year = $yed + 543;
      $processing_time = "เวลาดำเนินการ : {$dop} {$monthArrayTh[(int)$mop]} - {$ded} {$monthArrayTh[(int)$med]} พ.ศ. {$year}";
      $indicator_1 = "ตัวชี้วัด 1: {$query['indicator_1']}";
      $indicator_2 = "ตัวชี้วัด 2: {$query['indicator_2']}";
      $indicator_1_value = "ค่าเป้าหมาย: {$query['indicator_1_value']}";
      $indicator_2_value = "ค่าเป้าหมาย: {$query['indicator_2_value']}";
      $budget = number_format($query['project_sum_total'], 2);
      $data = array(
        'time' => $processing_time,
        'indicator_1' => $indicator_1,
        'indicator_2' => $indicator_2,
        'indicator_1_value' => $indicator_1_value,
        'indicator_2_value' => $indicator_2_value,
        'budget' => $budget
      );
    }
    $error = false;
    $errorMessage = "Success";
  }
  echo json_encode(array('error' => $error, 'data' => $data, 'errorMessage' => $errorMessage));
}

function GetReportProject()
{
  global $conn;
  $error = false;
  $errorMessage = "Success";
  $type = $_POST['type'];
  $year = $_POST['year'];
  $queryString = "SELECT * FROM project_info JOIN project_style_info JOIN department_info JOIN user_details 
  ON project_info.user_id=user_details.user_id 
  AND project_info.project_style=project_style_info.project_style_id
  AND project_info.department_id=department_info.department_id WHERE project_style = '{$type}'";

  if ($year) $queryString .= " AND project_fiscal_year = '{$year}'";

  $result = $conn->query($queryString);
  $data   = array();
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $data[] = $row;
  }
  echo json_encode(array('error' => $error, 'data' => $data, 'errorMessage' => $errorMessage));
}
