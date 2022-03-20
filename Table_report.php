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
<!-- <Button onclick="myFunction()" class="menuButton2">รายงานโครงการตามแผนงานประจำ</Button> -->
<select id="report-plant-type" class="inputFill-Information" style="background: #E5E5E5;margin-left: -50%;">
    <option value="1" selected>รายงานโครงการตามแผนงานประจำ</option>
    <option value="2">รายงานโครงการตามแผนยุทธศาสตร์</option>
</select>
<table id="pre-table">
    <thead>
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
    </thead>
    <tbody></tbody>
    <tfoot>
        <tr>
            <td>รวม</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tfoot>
</table>

<script>
    $(document).on('change', '#report-plant-type', function(e) {
        var t = $(this).val();
        callservice(t)
    })

    callservice($('#report-plant-type').val());

    function callservice(t) {
        $.ajax({
            type: "POST",
            url: "service.php",
            data: {
                type: t,
                target: "ReportProject"
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    var tr = [];
                    $.each(response.data, function(idx, d) {
                        var td = [];
                        td.push(`<td>${d.project_name}</td>`);
                        td.push(`<td>${d.status_project}</td>`);
                        td.push(`<td>${d.indicator_success2}</td>`);
                        td.push(`<td>${d.user_firstname}</td>`);
                        tr.push("<tr>" + td.join("") + "</tr>");
                    })
                    if (tr) $('#pre-table tbody').html(tr.join(""));
                }
            }
        });
    }
</script>