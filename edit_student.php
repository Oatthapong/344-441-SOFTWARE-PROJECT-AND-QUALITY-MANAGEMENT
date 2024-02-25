<?php
    include("connect.php");

    // ตรวจสอบว่ามีการส่งค่า 'username_id' ผ่าน URL มาหรือไม่
    if(isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $sql = "SELECT * FROM user WHERE ID_U='$user_id' ";
        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        

        if(mysqli_num_rows($result) > 0){
            // ดึงข้อมูลเป็น associative array
            $row = mysqli_fetch_assoc($result);
            // กำหนดค่า username ที่ดึงมาจากฐานข้อมูลให้กับตัวแปร $username
            $id = $row['ID_U'];
            $name = $row['Name_U'];
            $lastname = $row['Last_U'];

        } else {
            $username = "ไม่พบข้อมูล";
        }
    } else {
        // หากไม่มีการส่งค่า 'username_id' ผ่าน URL ให้กำหนดค่าเริ่มต้นหรือทำการแจ้งเตือน
        $user_id = "ไม่มีการส่งค่า 'user_id'";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลนักศึกษา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='style.css'>
    <style>
.container {
    width: 100px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.body {
    font-family: 'Kanit', sans-serif;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #3498db;
    color: #fff;
    padding: 10px;
}

.header a {
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
}

.content {
    padding: 20px;
    text-align:center;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    margin-bottom: 5px;
    font-size: 22px;
    margin-right: 20 px;
    
}

input[type="text"] {
    background-color: #fff; /* สีพื้นหลังของกล่องค้นหาเป็นสีขาว */
    border-radius: 10px; /* เพิ่มความโค้งให้กับกรอบ */
    padding: 10px 20px; /* เพิ่มช่องว่างภายในกล่องค้นหา */
    font-size: 18px; /* กำหนดขนาดของตัวอักษร */
    width: 300px; /* กำหนดความกว้างของกล่องค้นหา */
    border: none;
    width: 480px; 
    margin-left: 15%;
}

button {
    background-color: #90D193; /* สีพื้นหลังของปุ่ม */
    border: none; /* ไม่มีเส้นกรอบ */
    border-radius: 14px; /* กำหนดความโค้งของเส้นกรอบ */
    padding: 10px 20px; /* กำหนดระยะห่างของข้อความภายในปุ่ม */
    color: #000; /* สีของข้อความภายในปุ่ม */
    text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
    text-decoration: none; /* ไม่มีการเพิ่มขีดเส้นใต้ข้อความ */
    display: inline-block; /* แสดงเป็นบล็อกอิมไพล์ */
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* เพิ่มเงา */
    outline: none; 
    margin-top: 30px;
}

button:hover {
    background-color: #3e8e41;
}
#leftBtn {
  position: absolute;
  left: 0;
}
#rightBtn {
  position: absolute;
  right: 0;
}
.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
  text-align:left;
  position:relative;
  left:300px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
  position:relative;
  right:140px;
}
    </style>
</head>
<body>
<ul>
<i class="bi bi-caret-right-fill"></i>
  <li><a href="#home">หน้าหลัก</a></li>
  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="manage_student.php">จัดการข้อมูลนักศึกษา</a></li>
<li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="#home">แก้ไขข้อมูลนักศึกษา</a></li>
  <li style="float:right"><a class="active" href="#about">ออกจากระบบ</a></li>
</ul>
<div class="content"  style="margin-top: 5%">
            <h2><b>แก้ไขข้อมูลนักศึกษา</b></h2>
            <form class = "formEditStudent"action="edit_student.php" method="get" >
            <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                <div class="center">
                <div class="col-25">
                <label for="student_id">รหัสนักศึกษา :</label>
                </div>
                <div class="col-75">
                <input type="hidden" name="old_id" value="<?php echo $id; ?>">
                <input type="text" id="student_id" name="student_id" value="<?php echo $id ?>"></div></br>
                <div class="col-25">
                <label for="name">ชื่อ :</label>
                </div>
                <div class="col-75">
                <input type="text" id="name" name="name" value="<?php echo $name ?>"></div></br>
                <div class="col-25">
                <label for="surname">สกุล :</label>
                </div>
                <div class="col-75">
                <input type="text" id="surname" name="surname" value="<?php echo $lastname ?>"></div></br>
                <button type="button" onclick="confirmUpdate()">แก้ไข</button>
            </form>
</div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
             function confirmUpdate() {
                Swal.fire({
                    title: 'คุณต้องการแก้ไขหรือไม่?',
                    showCancelButton: true,
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ทำสิ่งที่ต้องการเมื่อกดปุ่ม "ตกลง"
                        document.querySelector('.formEditStudent').submit();
                    }
                });
            }
        </script>
</html>
<?php
    include("connect.php");

    if(isset($_GET["student_id"]) && isset($_GET["name"]) && isset($_GET["surname"]) && isset($_GET["old_id"])) {
        $student_id = $_GET["student_id"];
        $name = $_GET["name"]; 
        $surname = $_GET["surname"];
        $oldID = $_GET["old_id"];

        $sql = "UPDATE user SET 
                ID_U = '$student_id',
                Name_U = '$name',
                Last_U = '$surname',
                Username = '$student_id'
                WHERE ID_U='$oldID';"; 

        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

        if($result) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'เสร็จสิ้น',
                    text: 'แก้ไขเสร็จสิ้น',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'manage_student.php'; 
                    }
                });
            </script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "</script>";
        }
       
        
    }
    mysqli_close($conn);
 
?>