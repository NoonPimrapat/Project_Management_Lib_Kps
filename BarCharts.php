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
            categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
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