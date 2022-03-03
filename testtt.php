<?php
$doc_body ="
<div class="report-container">
<div class="inline">

    <img src="img/imgReport.jpg" alt="logoReport" class="report-img" />
    <strong>บันทึกข้อความ</strong>


</div>

<p>
    <strong>

    </strong>
</p>
<div class="inline">
    <p>ส่วนงาน <u
            class="border-bottom"><?php echo $Derpartment_name?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
</p>
<div class="right">
    <u class="border-bottom"> สำนักหอสมุด กำแพงแสน โทร 0-3435-1884 ภายใน 3802</u>
</div>

</div>
<div class="inline">
    <p> ที่<u class="border-bottom">&emsp; อว
            ๖๕๐๒.๐๘/&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
    </p>
    <div class="right">
        <p>วันที่<u
                class="border-bottom">&emsp;<?php echo $strDate?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
        </p>
    </div>
</div>
<div class="inline">
    <p>เรื่อง<u class="border-bottom"> ขออนุมัติจัด
            โครงการ<?php echo $project_name?>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</u>
    </p>

</div>

<p>
    เรียน<strong> </strong> <u>ผู้อำนวยการสำนักหอสมุด กำแพงแสน</u>
    <br />
<div class="indent">
    <u>
        ตามที่สำนักหอสมุด กำแพงแสน ได้กำหนดแผนปฎิบัติการประจำปีงบประมาณ พ.ศ. <?php echo $project_fiscal_year?>
        เพื่อเป็นกรอบและทิศทางการดำเนินงานในปีงบประมาณ พ.ศ. <?php echo $project_fiscal_year?>
        ของแต่ละหน่วยงานภายในสำนักหอสมุดกำแพงแสน
        อันจะนำไปสู่เป้าหมายและวิสัยทัศน์ที่กำหนดไว้ร่วมกัน
    </u>
</div>
<div class="indent">

    <u>
        ดังนั้น เพื่อให้การดำเนินงานเป็นไปตามแผนปฎิบัติการ ประจำปีงบประมาณ พ.ศ.
        <?php echo $project_fiscal_year?>และบรรลุตามเป้าหมายที่กำหนดไว้ จึงใคร่ขออนุมัติจัด
        <?php echo $project_name?>
        โดยใช้เงินรายได้สำนักหอสมุดกำแพงแสน ภายในงบประมาณจำนวน <?php echo $project_sum_total?> .- บาท
        (
        <?$project_sum_thai?>)
        ทั้งนี้ได้แนบรายละเอียดโครงการดังกล่าวมาด้วยแล้ว
    </u>
</div>
</p>

<u> จึงเรียนมาเพื่อโปรดพิจารณาอนุมัติ</u>
<div class="right">
    <u>
        (<?php echo $firstname?>&nbsp;<?php echo $lastname?>)
        <br />
        ผู้รับผิดชอบโครงการ
    </u>
</div>
<div>
    <p>
        เรียน หัวหน้า <?php echo $Derpartment_name?>
    </p>
</div>
<div class="indent">
    <u>
        เพื่อโปรดพิจารณาเสนอผู้อำนวยการสำนักฯ พิจารณาอนุมัติ
        ทั้งนี้โครงการดังกล่าวเป็นโครงการประจำภายใต้แผนปฎิบัติการประจำปีงบประมาณ
        พ.ศ.<?php echo $project_fiscal_year?> และได้ตรวจสอบรายละเอียดในเบื้องต้นแล้วเรียบร้อยแล้ว
    </u>
</div>
<div class="right">
    <u>
        <br />
        ..................................................
        <br />
        นักวิเคราะห์นโยบายและแผน
    </u>
</div>
<div class="inline">
    <div>
        <p>
            เรียน ผู้อำนวยการสำนักหอสมุด กำแพงแสน
        </p>
    </div>
    <div>
        <p>
            อนุมัติ
        </p>
    </div>
</div>


<div class="indent">
    <u>
        เพื่อโปรดพิจารณาลงนามอนุมัติ
</div>
<div class="inline">

    ........................................... <br>
    หัวหน้า <?php echo $Derpartment_name?>
    <div class="right">
        ( )
        <br />

        ผู้อำนวยการสำนักหอสมุดกำแพงแสน

        <br />

        ........... / ............ / ..........</u>

    </div>
</div>

";
?>
<form name="proposal_form" action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="submit" name="submit_docs" value="Export as MS Word" class="input-button" />
</form>
<?php
if (isset($_POST['submit_docs'])) {
    header("Content-Type: application/vnd.msword");
    header("Expires:0");//no cache
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-disposition: attachment;filename=sampleword.doc");

}
        echo"<html>";
         echo"$doc_body";
         echo"</html>";
?>