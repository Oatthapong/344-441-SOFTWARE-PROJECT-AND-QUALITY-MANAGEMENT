<?php 

    $conn = mysqli_connect('localhost', 'root','', 'psureview');
    
    if(!$conn){
        echo "เชื่อมต่อไม่สำเร็จ";
    }

?>