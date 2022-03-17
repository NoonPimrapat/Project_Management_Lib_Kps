<html>

<head>
    <title>โปรแกรมอัพโหลดภาพทีละหลายๆภาพด้วย Ajax+PHP+Database</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.wallform.js"></script>

<script>
//สร้าง function สำหรับการแสดงตัวอย่างภาพที่อัพโหลด
$(document).ready(function() {

    $('#photoimg').die('click').live('change', function() {
        //$("#preview").html('');

        $("#imageform").ajaxForm({
            target: '#preview',
            beforeSubmit: function() {
                //เมื่ออัพโหลดภาพไปแล้วจะแสดงไฟล์ .gif loading
                console.log('ttest');
                $("#imageloadstatus").show();
                $("#imageloadbutton").hide();
            },

            //อัพโหลดเสร็จแล้วซ่อนไฟล์ .gif loading
            success: function() {
                console.log('test');
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();
            },
            //error
            error: function() {
                console.log('xtest');
                $("#imageloadstatus").hide();
                $("#imageloadbutton").show();
            }
        }).submit();


    });
});
</script>

<style>
body {
    font-family: arial;
}

#preview {
    color: #cc0000;
    font-size: 12px
}

.imgList {
    max-height: 150px;
    margin-left: 5px;
    border: 1px solid #dedede;
    padding: 4px;
    float: left;
}
</style>

<body>

    <div align="center">
        <h1>โปรแกรมอัพโหลดภาพทีละหลายๆภาพด้วย Ajax+PHP+Database</h1>
        <!-- ส่วนแสดงภาพที่อัพโหลดเข้าไป -->
        <div id='preview'>
        </div>

        <form id="imageform" method="post" enctype="multipart/form-data" action='ajaxImageUpload.php'
            style="clear:both">

            <div id='imageloadstatus' style='display:none'>
                <img src="loading.gif" alt="Uploading...." />
            </div>
            <div id='imageloadbutton'>
                <!-- เลือกได้หลายๆไฟล์ในครั้งเดียว   name="photos[]"  multiple="true"  -->
                <br>
                เลือกไฟล์ภาพ :
                <input type="file" name="photos[]" id="photoimg" multiple="true" />
            </div>
        </form>
    </div>


    </div>
</body>

</html>