<?php
require_once "connect.php";
require_once "session.php";
require_once "check.php";

// เรียกข้อมูลจากฐานข้อมูล
$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($result);

$query = "SELECT ID_C FROM course";
$couse = mysqli_query($conn, $query);

$courses = array();
while ($row = mysqli_fetch_assoc($couse)) {
    $courses[] = $row;
}

$error="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!empty($_POST["couse"]) && !empty($_POST["myReview"]) && !empty($_POST["rating"])) {
        $cid = $_POST["couse"];
        $review = $_POST["myReview"];
        $rating = $_POST["rating"];
        $stmt = $conn->prepare("INSERT INTO review(`Detail_R`, `Rating`, `ID_C`, `username`) VALUES (?, ?, ?, ?)");
        
        $stmt->bind_param("ssss", $review, $rating, $cid, $username);
                    
        if ($stmt->execute()) {
            header("Location:index.php");
            exit;
        } else {
            $error = '<div class="d-flex align-items-start mx-auto text-danger">เกิดข้อผิดพลาด</div>';
        }       
        $stmt->close();
        $conn->close();
    }else{
        $error = '<div class="d-flex align-items-start mx-auto text-danger">กรุณากรอกข้อมูลให้ครบทุกช่อง</div>';
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

        <link href="./css/addReview.css" rel="stylesheet" />
    </head>

    <body class="text-center d-flex justify-content-center align-items-center vh-100">
        <div class="container">
                <form method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"])?>">
                    <div class="card w-50 mx-auto">
                        <div class="card-header header-style my-auto d-flex justify-content-between align-items-center">
                            <div class="h1 mx-auto">เพิ่มรีวิวรายวิชา</div>
                            <div class="icon-container">
                                <a href="index.php" style="color: black;">
                                <span class="fa-stack fa-xs">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                                </span>
                                </a>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: #DFDFDF;">
                            <div class="input-group mt-3">
                                <div class="d-flex align-items-center">
                                    <div class="fw-bold h5"><?php echo $result['Name_U']; ?> <?php echo $result['Last_U']; ?></div>
                                </div>
                            </div>
                            <div class="input-group mx-auto m-4 px-4">
                                <div class="d-flex align-items-center">
                                    <label class="form-label text-start fw-bold">รายวิชา : ㅤ ㅤ  ㅤ</label>
                                </div>
                                <select class="form-select" name="couse">
                                    <?php 
                                        foreach ($courses as $course):
                                            echo '<option value="'. $course['ID_C'].'">'. $course['ID_C'].'</option>';
                                        endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="input-group mx-auto m-4 px-4">
                                <div class="">
                                    <label class="form-label text-start fw-bold">Review : ㅤ ㅤ ㅤ </label>
                                </div>
                                <textarea class="form-control w-50 input-style shadow-sm rounded-0" name="myReview" rows="4" cols="50" placeholder="กรุณากรอกการรีวิว"></textarea>
                            </div>
                            <div class="card-rating mx-auto mb-2 text-center">
                                <div class="rating-stars d-flex justify-content-center">
                                    <div class="stars h3">
                                        <span onclick="gfg(1)" class="star">
                                            <i id="star1" class="far fa-star text-warning" onclick="toggleStar(1)"></i>
                                        </span>
                                        <span onclick="gfg(2)" class="star">
                                            <i id="star2" class="far fa-star text-warning" onclick="toggleStar(2)"></i>
                                        </span>
                                        <span onclick="gfg(3)" class="star">
                                            <i id="star3" class="far fa-star text-warning" onclick="toggleStar(3)"></i>
                                        </span>
                                        <span onclick="gfg(4)" class="star">
                                            <i id="star4" class="far fa-star text-warning" onclick="toggleStar(4)"></i>
                                        </span>
                                        <span onclick="gfg(5)" class="star">
                                            <i id="star5" class="far fa-star text-warning" onclick="toggleStar(5)"></i>
                                        </span>
                                        <input type="hidden" id="rating" name="rating">
                                    </div>
                                </div>
                            </div>
                            <div class="my-2 mx-auto">
                                <?php 
                                    echo $error;
                                ?>
                            </div>
                            <div class="pb-auto">
                            <button class="btn btn-lg btn-color fw-bold border border-dark shadow" type="submit">
                                โพสต์
                            </button>
                        </div>
                        </div>
                    </div>    
                </form>
        </div>
    </body>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        async function confirmUpdate() {
            const result = await Swal.fire({
                title: 'ต้องการแก้ไขโปรไฟล์หรือไม่?',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545'
            });
            
            if (result.isConfirmed) {
                fetch(document.querySelector('form').action, {
                    method: 'POST',
                    body: new FormData(document.querySelector('form'))
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เสร็จสิ้น',
                            text: 'การแก้ไขโปรไฟล์สำเร็จ',
                            showConfirmButton: true
                        });
                    } else {
                        console.error('มีข้อผิดพลาดเกิดขึ้น');
                    }
                })
                .catch(error => {
                    console.error('มีข้อผิดพลาดในการส่งคำขอ:', error);
                });
            }
        }

        function toggleStar(starNumber) {
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById('star' + i);
                if (i <= starNumber) {
                    star.classList.remove("far");
                    star.classList.add("fas");
                } else {
                    star.classList.remove("fas");
                    star.classList.add("far");
                }
            }
        }

    </script>
</html>