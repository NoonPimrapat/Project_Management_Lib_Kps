<?php 
$project_query = "SELECT * FROM project_info JOIN perdepartment_info JOIN project_style_info
JOIN department_info JOIN user_details 
ON project_info.user_id=user_details.user_id 
AND project_info.project_style=project_style_info.project_style_id
AND project_info.department_id=department_info.department_id
";
$query = mysqli_query($conn, $project_query);
$result = mysqli_fetch_assoc($query);


 $department_query = "SELECT * FROM `department_info` ";
 $queryDepartment = mysqli_query($conn, $department_query);
 $result2 = mysqli_fetch_assoc($queryDepartment);
 $row = mysqli_fetch_array($queryDepartment);
 while ($row = mysqli_fetch_array($queryDepartment)) {
     $data[] = $row['department_name'];
    //  print_pre($data);
  }

// function print_pre($data) {
//     echo "<pre>";
//     print_r($data);
//     echo "</pre>";
// }



?>
<link rel="stylesheet" href="css/Table_report.css">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
<table>

    <tr>
        <th>
            โครงการ
        </th>
        <th>
            รายงานสถานะการดำเนินโครงการ
        </th>
        <th>
            ผลการประเมินตัวชี้วัดโครงการ
        </th>
        <th>
            ผู้รับผิดชอบ
        </th>
    </tr>
    <?php foreach ($query as $value) { ?>
    <tbody>
        <tr>
            <td><?php echo $value['project_name']; ?></td>
            <td><?php echo $value['status_project']; ?></td>
            <td><?php echo $value['indicator_success2']; ?></td>
            <td><?php echo $value['user_firstname']; ?></td>
        </tr>
    </tbody>
    </thead>
    <?php } ?>

    <tfoot>
        <tr>
            <td>รวม</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>