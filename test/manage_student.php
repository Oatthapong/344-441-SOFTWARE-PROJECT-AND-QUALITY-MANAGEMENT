<?php
    require("connect.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['delete_user'])) {
            $idu = $_POST['delete_user'];
            $stmt = $conn->prepare("DELETE FROM user WHERE ID_U = ?");
            $stmt->bind_param("s", $idu);
                
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                http_response_code(200);
                exit();
            } else {
                http_response_code(500);
                $stmt->close();
                $conn->close();
            }
            
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลนักศึกษา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='style.css'>
    <style>
       .body1 {
          font-family: sans-serif;
          margin: 0;
          padding: 0;
        }

        .container {
          width: 100%;
          max-width: 960px;
          margin: 0 auto;
        }

        .search-bar {
          margin: 20px 0;
        }

        .search-bar form {
          /*display: flex;*/
          align-items: center;
          
        }

        .search-bar input {
          flex: 1;
          padding: 5px;
          border: 1px solid #ccc;
          border-radius: 5px;
        }

        .search-bar button {
          margin-left: px;
          padding: 10px 20px;
          border: 1px solid #ccc;
          border-radius: 5px;
          background-color:#3EB489;
          color: #fff;
        }

        .table-container {
          margin: 20px 0;
          /*background-color: #FFFFFF;*/
        }

        table {
          width: 70%;
          /*border-collapse: collapse;*/
          margin-left: auto;
          margin-right: auto;
        }

        th, td {
          padding: 10px;
          border: 1px solid #000000;
        }
        th{
          background-color:#BBE2EC;
        }
        tr{
          background-color: #FFFFFF;
        }

        th,tr{
          text-align: center;
        }

        footer {
          background-color: #333;
          color: #fff;
          padding: 20px;
          text-align: center;
        }
        .buttonred{
          background-color:#CD5C5C;
          color: #000000; /* กำหนดสีข้อความในปุ่ม */
                    border: none; /* กำหนดเส้นขอบให้ปุ่มไม่มี */
                    padding: 6px 14px; /* กำหนดขนาดการเรียงรับของปุ่ม */
                    text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
                    text-decoration: none; /* กำหนดลักษณะของข้อความในปุ่ม */
                    display: inline-block; /* กำหนดปรับแต่งปุ่มให้อยู่ในบรรทัดเดียวกับข้อความ */
                    font-size: 16px; /* กำหนดขนาดตัวอักษรของข้อความในปุ่ม */
                    margin: 4px 2px; /* กำหนดระยะห่างรอบขอบของปุ่ม */
                    cursor: pointer; /* เปลี่ยนเคอร์เซอร์เป็นรูปแบบที่แสดงว่าเป็นปุ่ม */
                    border-radius: 4px; /* กำหนดขนาดของขอบเขตของปุ่ม */
        }
        .buttonlightgray{
          background-color:#d3d3d3;
          color: #000000; /* กำหนดสีข้อความในปุ่ม */
                    border: none; /* กำหนดเส้นขอบให้ปุ่มไม่มี */
                    padding: 6px 14px; /* กำหนดขนาดการเรียงรับของปุ่ม */
                    text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
                    text-decoration: none; /* กำหนดลักษณะของข้อความในปุ่ม */
                    display: inline-block; /* กำหนดปรับแต่งปุ่มให้อยู่ในบรรทัดเดียวกับข้อความ */
                    font-size: 16px; /* กำหนดขนาดตัวอักษรของข้อความในปุ่ม */
                    margin: 4px 2px; /* กำหนดระยะห่างรอบขอบของปุ่ม */
                    cursor: pointer; /* เปลี่ยนเคอร์เซอร์เป็นรูปแบบที่แสดงว่าเป็นปุ่ม */
                    border-radius: 4px; /* กำหนดขนาดของขอบเขตของปุ่ม */
        }
        .buttonmintgreen{
            background-color: #90D193; /* สีพื้นหลังของปุ่ม */
          color: #000000; /* กำหนดสีข้อความในปุ่ม */
                    border: none; /* กำหนดเส้นขอบให้ปุ่มไม่มี */
                    padding: 6px 14px; /* กำหนดขนาดการเรียงรับของปุ่ม */
                    text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
                    text-decoration: none; /* กำหนดลักษณะของข้อความในปุ่ม */
                    display: inline-block; /* กำหนดปรับแต่งปุ่มให้อยู่ในบรรทัดเดียวกับข้อความ */
                    font-size: 16px; /* กำหนดขนาดตัวอักษรของข้อความในปุ่ม */
                    margin: 4px 2px; /* กำหนดระยะห่างรอบขอบของปุ่ม */
                    cursor: pointer; /* เปลี่ยนเคอร์เซอร์เป็นรูปแบบที่แสดงว่าเป็นปุ่ม */
                    border-radius: 4px; /* กำหนดขนาดของขอบเขตของปุ่ม */
        }
        .searckUsernameBar{
          border-radius: 20px;
          border: 2px solid #ffffff;
          width: 400px;
        }
        body,
            .form-signin {
                font-family: 'Kanit', sans-serif;
            }

        .background {
            background-color: #9BD8FA;
        }
        .showStdTable {
            border-collapse: collapse;
            /*margin: auto;*/
            width: 80%;
            margin-left: 11%; /* กำหนดระยะห่างจากฝั่งซ้ายเป็น 11% */
            margin-right: 9%; /* กำหนดระยะห่างจากฝั่งขวาเป็น 9% */

        }
        .headColor{
            text-align: center;
            background-color: #DCF4FF;
            font-size: 24px;
        }
        .buttonCenter{
            text-align: center;
        }
        .textnotCenter{
            text-align: left;
            padding-left: 30px;
            font-weight: bold; /* ตัวหนา */

        }
        td, th {
            border: 1px solid black;
            padding: 8px;
        }
        tr {
            background-color: #FFFFFF;
        }
        h1 {
            text-align: center;
        }
        .btn-primary{
            background-color: #d9d9d9; /* สีพื้นหลังของปุ่ม */
            border: none; /* ไม่มีเส้นกรอบ */
            border-radius: 14px; /* กำหนดความโค้งของเส้นกรอบ */
            padding: 10px 20px; /* กำหนดระยะห่างของข้อความภายในปุ่ม */
            color: #000; /* สีของข้อความภายในปุ่ม */
            text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
            text-decoration: none; /* ไม่มีการเพิ่มขีดเส้นใต้ข้อความ */
            display: inline-block; /* แสดงเป็นบล็อกอิมไพล์ */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* เพิ่มเงา */
            outline: none; /* ไม่มีเส้นกรอบสีดำขณะพิมพ์ */
        }
        .btn-primary2{
            background-color: #90D193; /* สีพื้นหลังของปุ่ม */
            border: none; /* ไม่มีเส้นกรอบ */
            border-radius: 14px; /* กำหนดความโค้งของเส้นกรอบ */
            padding: 10px 20px; /* กำหนดระยะห่างของข้อความภายในปุ่ม */
            color: #000; /* สีของข้อความภายในปุ่ม */
            text-align: center; /* จัดข้อความให้อยู่ตรงกลาง */
            text-decoration: none; /* ไม่มีการเพิ่มขีดเส้นใต้ข้อความ */
            display: inline-block; /* แสดงเป็นบล็อกอิมไพล์ */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2); /* เพิ่มเงา */
            outline: none; /* ไม่มีเส้นกรอบสีดำขณะพิมพ์ */
        }
        .searckUsernameBar{
            background-color: #fff; /* สีพื้นหลังของกล่องค้นหาเป็นสีขาว */
            border-radius: 20px; /* เพิ่มความโค้งให้กับกรอบ */
            padding: 10px 20px; /* เพิ่มช่องว่างภายในกล่องค้นหา */
            font-size: 18px; /* กำหนดขนาดของตัวอักษร */
            width: 300px; /* กำหนดความกว้างของกล่องค้นหา */
            border: none;
            width: 480px; /* กำหนดความยาวของกล่องค้นหา */
        }
        .formSearchUser {
            display: flex; /* ใช้ Flexbox */
            margin-left: 13%; /* กำหนดระยะห่างจากด้านซ้ายของหน้าจอเป็น 10% ของความกว้างของหน้าจอ */
        }
        label{
            font-size: 30px;
        }
        .updateUser{
            background-color: #D9D9D9;
            text-align: center;
        }.formEditUser {
        display: flex;
        justify-content: center; /* จัดตำแหน่งในแกนนอนตรงกลาง */
        align-items: center; /* จัดตำแหน่งในแกนตั้งตรงกลาง */
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
<li><a href="#home">จัดการข้อมูลนักศึกษา</a></li>
  <li style="float:right"><a class="active" href="#about">ออกจากระบบ</a></li>
</ul>
<div class="container m-auto">
                <h1>จัดการข้อมูลนักศึกษา</h1>
                
                <form class="formSearchUser" method="get" action="manage_studentFin.php">
                    <div class="topnav mt-3 mb-5 ml-3">
                        <label> ค้นหา : </label>
                        <input class ="searckUsernameBar" type="text" name="uid">
                        <input class="btn-primary" name="btnSubmit" type="submit" value="ค้นหา">
                        <a href="add_student.php"><button class="btn-primary2 mx-4" type="button">เพิ่ม</button></a>
                    </div>
                </form>
                <table class = "showStdTable">
                    <tr>
                        <th width="10%" class ="headColor">รหัส</th>
                        <th width="20%" class ="headColor">ชื่อ</th>
                        <th width="20%" class ="headColor">นามสกุล</th>
                        <th width="13%" class ="headColor">แก้ไข</th>
                        <th width="13%" class ="headColor">ลบ</th>
                    </tr>
                <?php
                    $sql = 'SELECT * FROM user'; 
                    $result = mysqli_query($conn, $sql);
                    $i = 0;
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                echo "<td class='textnotCenter'>".$row['ID_U']."</td>";
                                echo "<td class='textnotCenter'>".$row['Name_U']."</td>";
                                echo "<td class='textnotCenter'>".$row['Last_U']."</td>";
                                echo "<td><a class='btn btn-warning' href='edit_student.php?user_id=".$row['ID_U']."'>แก้ไข</a></td>";
                                echo '<td>';
                                echo '<form id="deleteForm_' . $row['ID_U'] . '" method="POST" action="'. htmlentities($_SERVER["PHP_SELF"]).'">';
                                echo '<input type="hidden" name="delete_user" value="' . $row['ID_U'] . '">';
                                echo '<button class="btn btn-danger delete-btn" style="margin-right: 1rem;" type="button" onclick="confirmDelete(' . $row['ID_U'] . ')">ลบ</button>';
                                echo '</form>';
                                echo '</td>';                                
                            echo "</tr>";
                            $i = $i+1;
                        }
                    }
                    if($i < 8){
                        for($j = 0; $j < 8 - $i; $j++) {
                            echo "<tr>";
                            echo "<td>&nbsp;<d>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
            </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
                async function confirmDelete(uid) {
                    console.log(uid);
                    const result = await Swal.fire({
                        title: 'คุณต้องการลบนักศึกษาหรือไม่?',
                        showCancelButton: true,
                        confirmButtonText: 'ตกลง',
                        cancelButtonText: 'ยกเลิก',
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#dc3545'
                    });

                    if (result.isConfirmed) {
                        fetch(document.querySelector('#deleteForm_' + uid).action, {
                            method: 'POST',
                            body: new FormData(document.querySelector('#deleteForm_' + uid))
                        })
                        .then(response => {
                            if (response.ok) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เสร็จสิ้น',
                                    text: 'ลบนักศึกษาเสร็จสิ้น',
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
                                    text: 'ไม่สามารถลบนักศึกษาได้',
                                    showConfirmButton: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'manage_student.php'; 
                                    }
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