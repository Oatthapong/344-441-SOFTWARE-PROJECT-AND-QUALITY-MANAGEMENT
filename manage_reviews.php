<?php
    require_once "connect.php";
    //require_once "session.php";

    $query = "SELECT u.Name_U, u.Last_U, r.Detail_R, r.Rating, c.ID_C, c.Name_C FROM review as r, course as c, user as u WHERE r.username = u.username AND r.ID_C = c.ID_C";
    $result_review = mysqli_query($conn, $query);
                            
    $details = array();
    while ($row = mysqli_fetch_assoc($result_review)) {
        $details[] = $row;
    }

    $query = "SELECT ID_C FROM course";
    $cousre = mysqli_query($conn, $query);

    $cousres = array();
    while ($row = mysqli_fetch_assoc($cousre)) {
        $cousres[] = $row;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_c = $_POST['show_details'];
        $query = "SELECT u.Name_U, u.Last_U, r.Detail_R, r.Rating, c.ID_C, c.Name_C FROM review as r, course as c, user as u WHERE r.username = u.username AND r.ID_C = c.ID_C AND c.ID_C='".$id_c.'\'';
        $result_review = mysqli_query($conn, $query);
                            
        $details = array();
        while ($row = mysqli_fetch_assoc($result_review)) {
            $details[] = $row;
        }   
                
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Signin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
        <meta name="theme-color" content="#712cf9" />
        <link rel='stylesheet' type='text/css' href='manage_reviews.css'>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <style>
        .scroll-down {
            margin-top: 50px; /* กำหนดระยะห่างด้านบนของข้อความ */
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
  .scroll-right {
            margin-left: 650px; /* กำหนดระยะห่างด้านซ้ายของข้อความ */
        }
    </style>
    </head>
    <body >
    <ul>
<i class="bi bi-caret-right-fill"></i>
  <li><a href="#home">หน้าหลัก</a></li>
  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="50" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg></li>
<li><a href="#home">จัดการข้อมูลนักศึกษา</a></li>
  <li style="float:right"><a class="active" href="#about">ออกจากระบบ</a></li>
</ul>
<div class="scroll-down" style="text-align:center;"><h2>จัดการรีวิวรายวิชา</h2></div>
        <div class="text-center d-flex justify-content-center vh-100">
        <div class="container m-5">
            <!--<div class="row">
                <div class="col-md-9 mt-5">
                    <a href="addReview.php"><button class="card-style btn w-50 text-start px-4"><img src="./picture/i-1.png" style="height: 36x; width:36px;" />ㅤㅤเพิ่มรีววิวรายวิชา</button></a>
                </div>
            </div>-->
            <div class="row my-5">
                <div class="col-md-9">
                    <?php foreach ($details as $detail): ?>
                            <div class="col-md-12 mt-4">
                                <div class="px-5 mx-5">
                                <div class="card w-100 card-style2 shadow-sm mx-auto">
                                    <div class="card-body d-flex flex-column">
                                        <div class="card-title h5 text-start">
                                            <p><i class="fas fa-user-circle"></i>ㅤ<?php echo $detail['Name_U'] . "  " . $detail['Last_U']; ?></p>
                                            <p><?php echo $detail['ID_C'] . " " . $detail['Name_C']; ?></p>
                                        </div>
                                        <div class="card-text mt-auto mb-auto"><?php echo $detail['Detail_R'] ?></div>
                                        <div class="card-rating mt-auto mb-2 text-start">
                                            <?php
                                            $rating = intval($detail['Rating']);
                                            echo '<div class="rating-stars d-flex">';
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $rating) {
                                                    echo '<i class="fas fa-star text-warning"></i>';
                                                } else {
                                                    echo '<i class="far fa-star text-warning"></i>';
                                                }
                                            }
                                            ?>
                                            </div><div class="scroll-right"> <button class="buttonred" type="submit">ลบ</button></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                </div>
                    <?php endforeach; ?>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-start">
                    <form method="post">
                        <?php foreach ($cousres as $i => $cousre): ?>
                            <button class="btn" type="submit" name="show_details" value="<?php echo $cousre['ID_C']; ?>">
                                <p class="h5 pb-2"><?php echo ($i + 1) . '. ' . $cousre['ID_C']; ?></p>
                            </button>
                            <br />
                        <?php endforeach; ?>
                    </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
                        </div>
    </body>
</html>