<?php
    require_once('connect.php');
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['course_id']) && isset($_GET['course_name']) && isset($_GET['teacher_name']) && isset($_GET['course_detail']) && isset($_GET['Name_Ca'])) {
            $cid = $_GET['course_id'];
            $cName = $_GET['course_name'];
            $tName = $_GET['teacher_name'];
            $cDetail = $_GET['course_detail'];
            $caName = $_GET['Name_Ca'];
            $caid;
            if($caName == 'วิชาเลือก'){
                $caid = 2;
            }else{
                $caid = 1;
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["course_id"]) && !empty($_POST["course_name"]) && !empty($_POST["course_description"]) && !empty($_POST["course_instructor"])) {
          $ID_C = $_POST['course_id'];
          $Name_C = $_POST['course_name'];
          $course = $_POST['couse'];
          $Detail_C = $_POST['course_description'];
          $Name_T = $_POST['course_instructor'];
          $cid = $_POST['cid'];
          $tName = $_POST['tName'];
          $ID_Ca = "";
          if($course == 'วิชาเลือก'){
            $ID_Ca = 2;
          }else{
            $ID_Ca = 1;
          }
      
          $stmt = $conn->prepare("UPDATE course SET ID_C=?, Name_C=?, ID_Ca=?, Detail_C=? WHERE ID_C=?");
          $stmt->bind_param("sssss", $ID_C, $Name_C, $ID_Ca, $Detail_C, $cid);
      
          $stmt2 = $conn->prepare("UPDATE teacher SET Name_T=? WHERE Name_T=?");
          $stmt2->bind_param("ss", $Name_T, $tName);
      
          if ($stmt->execute() && $stmt2->execute()) {
            $query = "SELECT ID_T FROM teacher WHERE Name_T = '$Name_T'";
            $result = mysqli_query($conn, $query);
            $result = mysqli_fetch_assoc($result);
      
            $stmt3 = $conn->prepare("UPDATE teach SET ID_C=?, ID_T=? WHERE ID_C=?");
            $stmt3->bind_param("sss", $ID_C, $result['ID_T'], $cid);
      
            if($stmt3->execute()){
              $stmt->close();
              $conn->close();
              http_response_code(200);
            } else {
              $stmt->close();
              $conn->close();
              http_response_code(400);
            }
          } else {
            $stmt->close();
            $conn->close();
            http_response_code(400);
          }       
        }else{
            http_response_code(400);
        }
      }
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เพิ่มรายวิชา</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="EditCourse.css">
</head>
<body>
  <ul>
      <i class="bi bi-caret-right-fill"></i>
      <li><a href="#home">หน้าหลัก</a></li>
      <li>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
              <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
          </svg>
      </li>
      <li><a href="#home">จัดการรายวิชา</a></li>
      <li>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
              <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
          </svg>
      </li>
      <li><a href="#home">แก้ไขรายวิชา</a></li>
      <li style="float: right;"><a class="active" href="#about">ออกจากระบบ</a></li>
  </ul>
  <h1><span class="center">แก้ไขรายวิชา</span></h1>
  <br />
  <br />
  <form class="formAddCourse" id="addCourse" method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"])?>">

    <div class="container1">
        <label for="course_id">รหัสวิชา:</label>
        <input type="text" id="course_id" name="course_id" value="<?php echo $cid; ?>"/>
        <input type="hidden" name="cid" value="<?php echo $cid; ?>"/>
    </div>
    <br />
    <div class="container2">
        <label for="course_name">ชื่อวิชา:</label>
        <input type="text" id="course_name" name="course_name" value="<?php echo $cName; ?>" />
    </div>
    <br />
    <div class="container3">
        <label for="course_category">หมวดหมู่:</label>
        <select name="couse" style="width: 600px; padding: 10px; border-radius: 10px; border: none;">
          <?php
            if($caName == 'วิชาเลือก'){
                echo '<option value="วิชาเลือก">รายวิชาเลือก</option>';
                echo '<option value="เสรี">รายวิชาเสรี</option>';
            }else{
                echo '<option value="เสรี">รายวิชาเสรี</option>';
                echo '<option value="วิชาเลือก">รายวิชาเลือก</option>';
            }
          ?>
        </select>
    </div>
    <br />
    <div class="container4">
        <label for="course_description">รายละเอียด:</label>
        <textarea id="course_description" name="course_description"><?php echo $cDetail; ?></textarea>
    </div>
    <br />
    <div class="container5">
        <label for="course_instructor">อาจารย์ผู้สอน:</label>
        <input type="text" id="course_instructor" name="course_instructor" value="<?php echo $tName; ?>"/>
        <input type="hidden" name="tName" value="<?php echo $tName; ?>"/>
    </div>
    <br />
    <br />
    <br />
    <button type="button" onclick="confirmUpdate()">ยืนยัน</button>
  </form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        async function confirmUpdate() {
            const result = await Swal.fire({
                title: 'คุณต้องการแก้ไขรายวิชาหรือไม่?',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545'
            });

            if (result.isConfirmed) {
                fetch(document.querySelector('#addCourse').action, {
                    method: 'POST',
                    body: new FormData(document.querySelector('#addCourse'))
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เสร็จสิ้น',
                            text: 'แก้ไขรายวิชาสำเร็จ',
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'showCourseFAdmin.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถแก้ไขรายวิชาได้',
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
</body>
</html>
