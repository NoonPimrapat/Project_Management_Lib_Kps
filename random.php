<?php
function random_char($len){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $ret_char = "";
        $num = strlen($chars);
        for($i = 0; $i < $len; $i++) {
            $ret_char.= $chars[rand()%$num];
            $ret_char.=""; 
        }
        return $ret_char; 
}
// การใช้งาน เรียกใช้ฟังก์ชัน และกำหนดจำนวนความยาวข้อความที่ต้องการ
echo random_char(5);    
?>