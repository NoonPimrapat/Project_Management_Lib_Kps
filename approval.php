<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width ,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/style.css">

  <title>
        สำนักงานหอสมุดกำแพงแสน
    </title>
</head>

<body>
    <div class="logo-container">
        <div class="logo">
            <img src="img/ku.jpg" alt="logo ku"class="mini-logo">
            <img src="img/ku_logo.jpg" alt="logo ku"class="mini-logo-ku" >
            
        </div>
        <p class="headline">ขออนุมัติโครงการ</p>
        <div class="profile-logo">
            <img src="img/ku.jpg" alt="logo ku"class="profile">
            <p>Pimrapat</p>
            <div class="triangleBottom"></div>
        </div>
    </div>
    <div class="logo-container">
        <div class="color-small-bar">
        </div>
        
      
    </div>
    <div class="information-container">
    <!-- <p class="topic">โครงการ</p> -->
    <from action="/action_page.php">
        <label for="โครงการ"  class="topic">โครงการ:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">ลักษณะโครงการ : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">ภายใต้ยุทธศาสตร์ : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">ภายใต้แผนงานประจำ : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>        
        <label for="ลักษณะโครงการ : "  class="topic">ฝ่ายงาน : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>        
        <label for="ลักษณะโครงการ : "  class="topic">หลักการและเหตุผล : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>        
        <label for="ลักษณะโครงการ : "  class="topic">วัตถุประสงค์ : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">ลักษณะการดำเนินงาน : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">ระยะเวลาดำเนินการ : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">สถานที่ : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br><br>
        <label for="ลักษณะโครงการ : "  class="topic">งบประมาณ : </label><br>
        <label for="ลักษณะโครงการ : "  class="topic">1. ค่าตอบแทน : </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">2. ค่าใช้สอย :  </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">3. ค่าวัสดุ :  </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <p class="topic">หมายเหตุ</p>
        <p class="topic">1. ใช้งบประมาณเงินรายได้ โครงการตามแผนยุทธศาสตร์<br>2. ขอถัวเฉลี่ยจ่ายทุกรายการ</p>
        <p class="topic">ตัวชี้วัดโครงการ </p>
        <label for="ลักษณะโครงการ : "  class="topic">3. ค่าวัสดุ :  </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        <label for="ลักษณะโครงการ : "  class="topic">ผู้รับผิดชอบโครงการ :  </label>
        <input type="text" id="project_name" name="project_name"  class="inputFill-Information"><br>
        </from>
    </div>
    <div class="logo-container">
        <div class="color-bar">
           <p class="title">แผนปฎิบัติการประจำปีงบประมาณ พ.ศ.  </p>
        </div>

    </div>
    <div class="container">
       
        <div >
            <h2 >แบบสรุปรายงานผลการดำเนินงาน</h2>
            <h2 >ตามแผนปฎิบัติการประจำปี งบประมาณ ......</h2>
        </div>
        <h2 class="subTitle">รายงานผลการดำเนินงานในรอบไตรมาส ........</h2>
        <Button onclick="myFunction()" class="menuButton2">รายงานโครงการตามแผนงานประจำ</Button>
    </div>

</body>

</html>
