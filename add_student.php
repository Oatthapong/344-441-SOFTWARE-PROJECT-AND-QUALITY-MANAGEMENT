<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มนักศึกษา</title>
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
  <li><a href="#home">หน้าหลัก</a></li>
  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="#home">จัดการข้อมูลนักศึกษา</a></li>
<li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="#home">เพิ่มนักศึกษา</a></li>
  <li style="float:right"><a class="active" href="#about">ออกจากระบบ</a></li>
</ul>
<div class="content">
            <h2>เพิ่มนักศึกษา</h2>
            <form action="/add-student" method="post">
                <div class="center">
                <div class="col-25">
                <label for="student_id">รหัสนักศึกษา :</label>
                </div>
                <div class="col-75">
                <input type="text" id="student_id" name="student_id" value="6410210256"></div></br>
                <div class="col-25">
                <label for="name">ชื่อ :</label>
                </div>
                <div class="col-75">
                <input type="text" id="name" name="name" value="มัสรียา"></div></br>
                <div class="col-25">
                <label for="surname">สกุล :</label>
                </div>
                <div class="col-75">
                <input type="text" id="surname" name="surname" value="ทอดทิ้ง"></div></br>
                <button type="submit">เพิ่ม</button>
            </form>
</dev>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>