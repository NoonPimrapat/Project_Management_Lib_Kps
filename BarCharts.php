<?php
$project_query = "SELECT * FROM project_info JOIN perdepartment_info JOIN project_style_info
JOIN department_info JOIN user_details 
ON project_info.user_id=user_details.user_id 
AND project_info.project_style=project_style_info.project_style_id
AND project_info.department_id=department_info.department_id
";
$query = mysqli_query($conn, $project_query);
$result = mysqli_fetch_assoc($query);


$data = array();
$job_done_query = array();
$job_progress_query = array();
$job_unprogress_query = array();
$department_query = "SELECT * FROM `department_info` ";
$queryDepartment = mysqli_query($conn, $department_query);
while ($row = mysqli_fetch_array($queryDepartment, MYSQLI_ASSOC)) {
    $data[] = "'{$row['department_name']}'";
    $department_id = $row['department_id'];
    $job_done_query[] = gen_chart_value($department_id, 'สำเร็จ');
    $job_progress_query[] = gen_chart_value($department_id, 'รอดำเนินการ');
    $job_unprogress_query[] = gen_chart_value($department_id, 'ไม่สำเร็จ');
}

function gen_chart_value($department_id, $status)
{
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM `project_info` WHERE department_id = '{$department_id}' AND indicator_success2 = '{$status}'");
    return mysqli_num_rows($query);
}

?>

<!-- <Button onclick="myFunction()" class="menuButton2">รายงานสถานะการดำเนินโครงการ</Button> -->
<select id="chart-plant-type" class="inputFill-Information" style="background: #E5E5E5;margin-left: -50%;">
    <option value="1" selected>รายงานสถานะการดำเนินโครงการ</option>
</select>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    $(function() {
        $('#containerbar').highcharts({

            chart: {
                type: 'column'
            },

            title: {
                text: 'รายงานสถานะโครงการ'
            },

            xAxis: {
                // categories: ['บริหารและธุรการ', 'พัฒนาและจัดการทรัพยากรสารสนเทศ',
                //     'เทคโนโลยีสารสนเทศและสื่อการศึกษา', 'บริหารและธุรการ',
                //     'พัฒนาและจัดการทรัพยากรสารสนเทศ', 'เทคโนโลยีสารสนเทศและสื่อการศึกษา'
                // ]
                categories: [<?php echo join(',', $data) ?>]
            },

            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'จำนวนโครงการ'
                }
            },

            tooltip: {
                formatter: function() {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y + '<br/>' +
                        'Total: ' + this.point.stackTotal;
                }
            },

            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },

            series: [{
                name: 'ดำเนินการเสร็จสิ้น',
                data: [<?php echo join(',', $job_done_query) ?>],
                stack: 'done' /**ดำเนินการเสร็จสิ้น */
            }, {
                name: 'กำลังดำเนินการ',
                data: [<?php echo join(',', $job_progress_query) ?>],
                stack: 'in progress' /**กำลังดำเนินการ */
            }, {
                name: 'ยังไม่ได้ดำเนินการ',
                data: [<?php echo join(',', $job_unprogress_query) ?>],
                stack: 'unprocessed.' /**ยังไม่ได้ดำเนินการ */
            }]
        });
    });
</script>
<div id="container"></div>
<div id="containerbar" style="max-width: 1200px; margin: auto;margin-top: 35px"></div>