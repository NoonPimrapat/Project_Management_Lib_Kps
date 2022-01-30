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
    <div class="grid-container">
        <div class="grid-item"><img src="img/display.jpg" alt="logo ku"
        class="imgDisplay">
        </div>
        <div class="grid-item">
            <img src="img/ku_logo.jpg" alt="logo ku"class="logoDisplay" >

            <h2 class="textTitle">
            เข้าสู่ระบบด้วยอีเมลผู้ใช้งาน </h2>
            <form action="/action_page.php">
                <label for="email">E-mail:</label><br>
                <input type="email" id="fname" name="fname" placeholder="E-mail" class="inputFill"><br>
                <label for="password"  >Password:</label><br>
                <input type="password" id="lname" name="lname" placeholder="Password"  class="inputFill"><br><br>
                <input type="submit" value="Login" class="summitButton" onclick="parent.location='home.php'">
            </form>
        </div>
    </div>
</body>

</html>
