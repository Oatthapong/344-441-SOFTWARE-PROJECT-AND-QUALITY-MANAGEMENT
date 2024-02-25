<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddStudent</title>
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

/*form {
    justify-content: center; 
    align-items: center; 
    text-align:center;
    width: 1500px; 
    height: 300px;
}*/

label {
    margin-bottom: 5px;
    font-size: 24px;
    
}

input[type="text"] {
    padding: 7px 30px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 7px;
    width: 500px;
}

button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 40px;
    border: none;
    border-radius: 7px;
    cursor: pointer;
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
  <li><a href="mainadmin.php">หน้าหลัก</a></li>
  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="manage_student.php">จัดการข้อมูลนักศึกษา</a></li>
<li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="add_student.php">เพิ่มนักศึกษา</a></li>
  <li style="float:right"><a class="active" href="#about">ออกจากระบบ</a></li>
</ul>
<div class="content">
            <h2>เพิ่มนักศึกษา</h2>
            <form class="formAddUser" action="add_student.php" method="post" >

                <div class="center">
                <div class="col-25">
                <label for="student_id">รหัสนักศึกษา :</label>
                </div>
                <div class="col-75">
                <input class="searckUsernameBar" type="text" id="student_id" name="student_id"></div></br>
                <div class="col-25">
                <label for="name">ชื่อ :</label>
                </div>
                <div class="col-75">
                <input class="searckUsernameBar" type="text" id="name" name="name" ></div></br>
                <div class="col-25">
                <label for="surname">สกุล :</label>
                </div>
                <div class="col-75">
                <input class="searckUsernameBar" type="text" id="surname" name="surname" ></div></br>
                <button class='btn-primary2 mx-4' onclick="confirmInsert()" type="button">เพิ่ม</button>
            </form>
</div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmInsert() {
        Swal.fire({
            title: 'คุณต้องการเพิ่มนักศึกษาหรือไม่?',
            showCancelButton: true,
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#dc3545'
        }).then((result) => {
            if (result.isConfirmed) {
                // ทำสิ่งที่ต้องการเมื่อกดปุ่ม "ตกลง"
                document.querySelector('.formAddUser').submit();
            }
        });
    }
</script>
</html>

<?php
require_once('connect.php');

// ตรวจสอบว่ามีข้อมูลที่ส่งมาหรือไม่
if(isset($_POST['student_id']) && isset($_POST['name']) && isset($_POST['surname'])) {

  // ป้องกัน SQL Injection
  $id = $_POST['student_id'];
  $name = $_POST['name'];
  $surname = $_POST['surname'];

  // เขียน SQL query
  $sql = "INSERT INTO user (ID_U, Name_U, Last_U) VALUES ('$id', '$name', '$surname')";

  // ดำเนินการ query
  $result = mysqli_query($conn, $sql);

  // ตรวจสอบผลลัพธ์
  if($result) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
    echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'เสร็จสิ้น',
        text: 'เพิ่มนักศึกษาเสร็จสิ้น',
        showConfirmButton: true,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'add_student.php'; 
        }
      });
    </script>";
  } else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
    echo "<script>
      Swal.fire({
        icon: 'error',
        title: 'เกิดข้อผิดพลาด',
        text: 'ไม่สามารถเพิ่มนักศึกษาได้',
        showConfirmButton: true,
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'add_student.php'; 
        }
      });
    </script>";
  }

}

mysqli_close($conn);
?>

