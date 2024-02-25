<?php
require_once "connect.php";
require_once "session.php";
require_once "check.php";

$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($result);

$error="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['id'])){
        $idr = $_POST['id'];
        $query = "SELECT * FROM review WHERE ID_R=".$idr;
        $review = mysqli_query($conn, $query);
        $review = mysqli_fetch_assoc($review);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Signin</title>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
        <meta name="theme-color" content="#712cf9" />

        <link href="./css/addReview.css" rel="stylesheet" />
    </head>
    <body class="text-center d-flex justify-content-center align-items-center vh-100">
    <?php include 'navbar.php'; ?>
        <div class="container">
                <form id="reviewForm" method="POST" action="editReviewProcess.php">
                    <div class="card w-50 mx-auto">
                        <div class="card-header header-style my-auto">
                            <div class="h1">แก้ไขรีวิวรายวิชา</div>
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
                                <select class="form-select" name="couse" disabled> 
                                    <option value="<?php echo $review['ID_C']; ?>" ><?php echo $review['ID_C']; ?></option>
                                </select>
                            </div>
                            <div class="input-group mx-auto m-4 px-4">
                                <div class="">
                                    <label class="form-label text-start fw-bold">Review : ㅤ ㅤ ㅤ </label>
                                </div>
                                <textarea class="form-control w-50 input-style shadow-sm rounded-0" name="myReview" rows="4" cols="50" placeholder="กรุณากรอกการรีวิว"><?php echo $review['Detail_R']; ?></textarea>
                            </div>
                            <div class="card-rating mx-auto mb-2 text-center">
                                <div class="rating-stars d-flex justify-content-center">
                                    <div class="stars h3">
                                        <span onclick="gfg(1)" class="star">
                                            <i id="star1" class="<?php echo ($review['Rating'] >= 1) ? 'fas' : 'far'; ?> fa-star text-warning" onclick="toggleStar(1)"></i>
                                        </span>
                                        <span onclick="gfg(2)" class="star">
                                            <i id="star2" class="<?php echo ($review['Rating'] >= 2) ? 'fas' : 'far'; ?> fa-star text-warning" onclick="toggleStar(2)"></i>
                                        </span>
                                        <span onclick="gfg(3)" class="star">
                                            <i id="star3" class="<?php echo ($review['Rating'] >= 3) ? 'fas' : 'far'; ?> fa-star text-warning" onclick="toggleStar(3)"></i>
                                        </span>
                                        <span onclick="gfg(4)" class="star">
                                            <i id="star4" class="<?php echo ($review['Rating'] >= 4) ? 'fas' : 'far'; ?> fa-star text-warning" onclick="toggleStar(4)"></i>
                                        </span>
                                        <span onclick="gfg(5)" class="star">
                                            <i id="star5" class="<?php echo ($review['Rating'] >= 5) ? 'fas' : 'far'; ?> fa-star text-warning" onclick="toggleStar(5)"></i>
                                        </span>
                                        <input type="hidden" id="rating" name="rating" value="<?php echo isset($review['Rating']) ? $review['Rating'] : $review['Rating'] ; ?>">
                                        <input type="hidden" id="idr" name="idr" value="<?php echo $idr; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="my-2 mx-auto">
                                <?php 
                                    echo $error;
                                ?>
                            </div>
                            <div class="pb-auto">
                            <button class="btn btn-lg btn-color fw-bold border border-dark shadow" type="button" onclick="confirmUpdate()">
                                แก้ไข
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
                title: 'คุณต้องการแก้ไขหรือไม่?',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545'
            });

            if (result.isConfirmed) {
                fetch(document.querySelector('#reviewForm').action, {
                    method: 'POST',
                    body: new FormData(document.querySelector('#reviewForm'))
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
                                window.location.href = 'profile.php';
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