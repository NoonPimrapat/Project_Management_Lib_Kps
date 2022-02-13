<?php
        // session_start(); 
        include('config/db.php');
        //2. query ข้อมูลจากตาราง tb_member:
        $query = "SELECT * FROM department_info ORDER BY department_id asc" or die("Error:" . mysqli_error());
        //3.เก็บข้อมูลที่ query ออกมาไว้ในตัวแปร result .
        $result = mysqli_query($conn, $query);
        session_start(); 
        include('config/db.php'); 
            $query = "SELECT * FROM `user_details`"; 
            $result = mysqli_query($conn,$query);
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width ,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>
        สำนักงานหอสมุดกำแพงแสน
    </title>
</head>

<body>
    <div class="logo-container">
        <div class="logo">
            <img src="img/ku.jpg" alt="logo ku" class="mini-logo">
            <img src="img/ku_logo.jpg" alt="logo ku" class="mini-logo-ku">
        </div>
        <p class="headline">โปรไฟล์</p>
        <div class="profile-logo">
            <img src="img/ku.jpg" alt="logo ku" class="profile">
            <p><strong></strong></p>
            <div class="triangleBottom"></div>
        </div>
    </div>
    <div class="logo-container">
        <div class="color-small-bar">
        </div>


    </div>
    <div class="grid-container">
        <div class="grid-item">
            <table id="profile">
                <?php foreach ($result as $value) { ?>
                <tr>
                    <td class="topic">ชื่อ :</td>
                    <td>
                        <p class="detail"> <?php echo $value['user_firstname']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="topic">นามสกุล :</th>
                    <td>
                        <p class="detail"> <?php echo $value['user_lastname']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="topic">เพศ :</th>
                    <td>
                        <p class="detail"> <?php echo $value['user_typeSex']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="topic">ตำแหน่ง :</th>
                    <td>
                        <p class="detail"> <?php echo $value['user_position']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="topic">แผนก :</th>
                    <td>
                        <p class="detail"> <?php echo $value['user_department']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="topic">โทรศัพท์ :</th>
                    <td>
                        <p class="detail"> <?php echo $value['user_phone']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="topic">E-mail :</th>
                    <td>
                        <p class="detail"> <?php echo $value['user_email']; ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="topic">Password :</th>
                    <td>
                        <p class="detail"> <?php echo $value['user_password']; ?></p>
                    </td>
                    <td>
                        <i class="fa-solid fa-eye"></i>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div class="grid-item-center">
            <img class="show-profile" src="img/profile.png"
                onclick="document.getElementById('modal01').style.display='block'">
            <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                <div class="w3-modal-content w3-animate-zoom">
                    <img src="img/profile.png" style="width:50%">
                </div>
            </div>

        </div>

    </div>


</body>

</html>