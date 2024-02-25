<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าเมนูเเอดมิน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' href='style.css'>
    <style>
.right {
  position: relative;
  width: 300px;
  padding: 10px;
  margin-left: 800px;
  margin-top: 100px;
  text-align:center;
}
.left {
  position: absolute;
  right: 800px;
  width: 400px;
  padding: 10px;
  margin-top: 160px;
  text-align:center;
}
.text{
  position: relative;
  margin-left: 800px;
  margin-top: 50px;
  text-align:center
}
.button {
  background-color: #BBDEFB;
}
.box {
        width: 200px;
        height: 240px;
        border: solid 1px black;
        background-color:#FFFFFF;
        border-radius: 15px;        
    }
    .box1 {
        width: 200px;
        height: 170px;
        border: solid 1px black;
        background-color: #FFFFFF;
        border-radius: 15px;        
    }
    .box2 {
        width: 200px;
        height: 150px;
        border: solid 1px black;
        background-color: #FFFFFF;
        border-radius: 15px;      
    }
</style>
  </head>
<body >

<ul>
  <li><a href="#home">หน้าหลัก</a></li>
  <li style="float:right"><a class="active" href="#about">ออกจากระบบ</a></li>
</ul>
<div class="left box">
  <h1>นักศึกษา</h1></br>
  <button type="button" class="btn btn-info"><a href="manage_student.php"><p>จัดการข้อมูลนักศึกษา</p></button></a></br></br>
  <button type="button" class="btn btn-info"><p>จัดการบัญชี</p></button>
</div>
  <div class="right box1">
  <h1>รายวิชา</h1>
  <button type="button" class="btn btn-info"><p>จัดการรายวิชา</p></button>
</div>
<div class="text box2">
<h1>รีวิวรายวิชา</h1>
<button type="button" class="btn btn-info"><a href="manage_reviews.php"><p>จัดการรีวิวรายวิชา</p></a></button>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>

