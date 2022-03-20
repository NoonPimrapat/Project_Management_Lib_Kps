<?php

session_start();
include('config/db.php');

if (isset($_POST['adjust_project'])) {

  $project_id = $_POST['project_id'];
  $topic_change = $_POST['topic_change'];
  $val_another = $_POST['another'];
  $val_date_start = $_POST['pro_dateStart'];
  $val_date_end = $_POST['pro_dateEnd'];
  $pro_reason = $_POST['pro_reason'];

  $request_by = $_SESSION['user_id'];

  $chk_date = false;
  $chk_indicator_goals = false;
  $chk_indicator = false;
  $chk_budget = false;
  $chk_another = false;

  if ($topic_change) {
    foreach ($topic_change as $key => $choice) {
      switch ($choice) {
        case 'pro_dateStart':
          $chk_date = true;
          break;
        case 'indicator_value':
          $chk_indicator_goals = true;
          break;
        case 'indicator':
          $chk_indicator = true;
          break;
        case 'budget':
          $chk_budget = true;
          break;
        case 'another':
          $chk_another = true;
          break;
      }
    }
  }

  $queryString = "SELECT * FROM `project_info` WHERE project_id = {$project_id}";
  $result = $conn->query($queryString);
  $query = $result->fetch_assoc();
  $data_old = serialize($query);

  $date_start = str_replace("/", "-", $val_date_start);
  $date_end = str_replace("/", "-", $val_date_end);

  $val_time = date(date('Y-m-d'), strtotime($date_start)) . " / " . date(date('Y-m-d'), strtotime($date_end));

  $indicator_1 = @$_POST['indicator_1'];
  $indicator_2 = @$_POST['indicator_2'];
  $indicator_1_value = @$_POST['indicator_1_value'];
  $indicator_2_value = @$_POST['indicator_2_value'];

  $val_indicator_goal = @$_POST['val_indicator_goal'];
  $val_indicator = @$_POST['val_indicator'];
  $val_budget = @$_POST['val_budget'];
  $data_new = serialize(array(
    'val_time' => $val_time,
    'indicator_1' => $indicator_1,
    'indicator_2' => $indicator_2,
    'indicator_1_value' => $indicator_1_value,
    'indicator_2_value' => $indicator_2_value,
    'val_budget' => $val_budget,
    'val_another' => $val_another
  ));

  // insert table project_request_adjust
  // บันทึกรายการปรับแก้ 
  $queryString = "INSERT INTO project_request_adjust(project_id, chk_date, chk_indicator_goals, chk_indicator, chk_budget, chk_another, data_new, data_old, pro_reason, request_by) 
  VALUES ('{$project_id}', '{$chk_date}', '{$chk_indicator_goals}', '{$chk_indicator}', '{$chk_budget}', '{$chk_another}', '{$data_new}', '{$data_old}', '{$pro_reason}', '{$request_by}')";
  $conn->query($queryString);

  // update table project_info
  $popval = array();
  if ($date_start && $date_end) {
    $popval[] = "period_op='{$date_start}'";
    $popval[] = "period_ed='{$date_end}'";
  }
  if ($indicator_1) $popval[] = "indicator_1='{$indicator_1}'";
  if ($indicator_2) $popval[] = "indicator_2='{$indicator_2}'";
  if ($indicator_1_value) $popval[] = "indicator_1_value='{$indicator_1_value}'";
  if ($indicator_2_value) $popval[] = "indicator_2_value='{$indicator_2_value}'";
  if ($val_budget) $popval[] = "project_sum_total='{$val_budget}'";
  if ($popval) {
    $setval = join(",", $popval);
    $queryString = "UPDATE project_info SET {$setval} WHERE project_id = '{$project_id}'";
    echo $queryString;
    $conn->query($queryString);
  }
}

header('Location: home.php');
