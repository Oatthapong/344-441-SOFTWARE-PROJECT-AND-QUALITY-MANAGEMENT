<?php
require_once "connect.php";
require_once "session.php";
//require_once "check.php";

//$username = $_session['username'];
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
$result1 = mysqli_fetch_assoc($result);
$result2 = $result1['ID_U']

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
<div class="content">
            <h2>แก้ไขข้อมูลนักศึกษา</h2>
            <form action="edit_student.php" method="post" target="iframe_target">
            <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                <div class="center">
                <div class="col-25">
                <label for="student_id">รหัสนักศึกษา :</label>
                </div>
                <div class="col-75">
                <input type="text" id="student_id" name="student_id" value="<?php echo $result1['ID_U'] ?>"></div></br>
                <div class="col-25">
                <label for="name">ชื่อ :</label>
                </div>
                <div class="col-75">
                <input type="text" id="name" name="name" value="<?php echo $result1['Name_U'] ?>"></div></br>
                <div class="col-25">
                <label for="surname">สกุล :</label>
                </div>
                <div class="col-75">
                <input type="text" id="surname" name="surname" value="<?php echo $result1['Last_U'] ?>"></div></br>
                <button type="submit" onclick="confirmUpdate()">เพิ่ม</button>
            </form>
</dev>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        async function confirmUpdate() {
            const result = await Swal.fire({
                title: 'คุณต้องการแก้ไขหรือไม่?',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545'
            });

            if (result.isConfirmed) {
                fetch(document.querySelector('#editForm').action, {
                    method: 'POST',
                    body: new FormData(document.querySelector('#editForm'))
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เสร็จสิ้น',
                            text: 'แก้ไขสำเร็จ',
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'manage_student.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถแก้ไขได้',
                            showConfirmButton: true
                        });
                    }
                })
                .catch(error => {
                    console.error('มีข้อผิดพลาดในการส่งคำขอ:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'มีข้อผิดพลาดในการส่งคำขอ',
                        showConfirmButton: true
                    });
                });
            }
        }
    </script>
</html>