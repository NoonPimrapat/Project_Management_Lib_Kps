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
 $result = mysqli_fetch_assoc($queryDepartment);
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
            categories: ['บริหารและธุรการ', 'พัฒนาและจัดการทรัพยากรสารสนเทศ',
                'เทคโนโลยีสารสนเทศและสื่อการศึกษา', 'บริหารและธุรการ',
                'พัฒนาและจัดการทรัพยากรสารสนเทศ', 'เทคโนโลยีสารสนเทศและสื่อการศึกษา'
            ]
            // categories: [<?php echo join($data,',') ?>]
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
            data: [5, 3, 4, 7, 2],
            stack: 'done' /**ดำเนินการเสร็จสิ้น */
        }, {
            name: 'กำลังดำเนินการ',
            data: [3, 4, 4, 2, 5],
            stack: 'in progress' /**กำลังดำเนินการ */
        }, {
            name: 'ยังไม่ได้ดำเนินการ',
            data: [2, 5, 6, 2, 1],
            stack: 'unprocessed.' /**ยังไม่ได้ดำเนินการ */
        }]
    });
});
</script>
<div id="container"></div>
<div id="containerbar"></div>