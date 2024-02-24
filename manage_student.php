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
  margin-left: 10px;
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
    </style>
</head>
<body>
<ul>
<i class="bi bi-caret-right-fill"></i>
  <li><a href="#home">หน้าหลัก</a></li>
  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="#home">จัดการข้อมูลนักศึกษา</a></li>
  <li style="float:right"><a class="active" href="#about">ออกจากระบบ</a></li>
</ul>
<div style="text-align:center;"><h1>จัดการข้อมูลนักศึกษา</h1>
      <form action="#">
      <div class="topnav mt-3 mb-5 ml-3">
      <label> ค้นหา : </label>
        <input class ="searckUsernameBar" type="text" name="cid">
        <button class="buttonlightgray" type="submit">ค้นหา</button><button class="buttonmintgreen" type="submit">เพิ่ม</button>
        </div>
      </form>
    </div>
    <section class="table-container">
      <table>
        <thead>
          <tr>
            <th>รหัส</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>เเก้ไข</th>
            <th>ลบ</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><button class="buttonlightgray" type="submit"><a href ="edit_student.php">เเก้ไข</button></td>
            <td><button class="buttonred" type="submit">ลบ</button></td>          
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><button class="buttonlightgray" type="submit">เเก้ไข</button></td>
            <!--<td><button class="btn btn-danger delete-btn" style="margin-right: 1rem;" type="button" onclick="confirmDelete()">ลบ</button></td>-->
            <td><button class="buttonred" type="submit">ลบ</button></td>
          </tr>
        </tbody>
        </table>
</section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>