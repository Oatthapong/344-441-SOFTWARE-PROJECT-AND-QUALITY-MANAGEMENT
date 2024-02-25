<?php
require_once "connect.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['id'])) {
        $idr = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM review WHERE ID_R = ?");
        $stmt->bind_param("s", $idr);
            
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
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Profile</title>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
        <meta name="theme-color" content="#712cf9" />

        <link href="./css/profile.css" rel="stylesheet" />
    </head>

    <body class="text-center d-flex justify-content-center vh-100">
    <?php include 'navbar.php'; ?>
        <div class="container mt-5">
            <?php
                if(!isset($_SESSION['username'])){
                    echo '
                    <div class="card mt-5 p-5 card-style">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="text">
                                    <div class="h1">โปรไฟล์ของฉัน</div>
                                    <div class="icon-p">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mx-auto d-flex justify-content-center flex-column">
                                <a href="login.php">
                                    <button class="btn w-50 btn-style mb-3 mx-auto">
                                        <div class="text-style h5">
                                            เข้าสู่ระบบ
                                        </div>
                                    </button>
                                </a>
                                <div class="mb-3 text-muted">หรือ</div>
                                <a href="register.php">
                                    <button class="btn w-50 btn-style mx-auto">
                                        <div class="text-style h5">
                                            สมัครสมาชิก
                                        </div>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                    ';
                }else{
                        $username = $_SESSION['username'];
                    
                        $username = mysqli_real_escape_string($conn, $username);
                        $query = "SELECT r.ID_R, u.Name_U, u.Last_U, r.Detail_R, r.Rating, c.ID_C, c.Name_C 
                                FROM review as r, course as c, user as u 
                                WHERE r.username = u.username 
                                AND r.ID_C = c.ID_C 
                                AND r.username = '".$username."'";
                        $result_review = mysqli_query($conn, $query);
                        
                        $details = array();
                        while ($row = mysqli_fetch_assoc($result_review)) {
                            $details[] = $row;
                        }
                        $query = "SELECT * FROM user WHERE username = ".$username;
                        $result = mysqli_query($conn, $query);
                        $result = mysqli_fetch_assoc($result);
                        echo '<div class="card mt-5 p-5 card-style shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text">
                                        <div class="h1">โปรไฟล์ของฉัน</div>
                                        <div class="icon-p">
                                            <i class="fas fa-user-circle"></i>
                                        </div><br />
                                        <a href="editProfile.php">
                                        <button class="btn w-50 btn-style2 shadow mx-auto">
                                            <div class=" h5">
                                                แก้ไขโปรไฟล์
                                            </div>
                                        </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 mx-auto d-flex justify-content-center flex-column">
                                    <div class="row mt-5 h3">
                                        ชื่อ-นามสกุล : '; echo $result['Name_U'] . "  " . $result['Last_U']; 
                                    echo '</div>
                                    <div class="row mt-4 h3">
                                        รหัสนักศึกษา : '; echo $result['username']; 
                                    echo '</div>
                                    <a href="logout.php">
                                    <button class="btn w-50 btn-style shadow mx-auto mt-5">
                                            <div class="text-style h5">
                                                ออกจากระบบ
                                            </div>
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-auto mt-5 mb-5">
                        <div class="h2 text-start">
                            ประวัติการรีวิว :
                        </div>';
                        foreach ($details as $detail):
                            echo '<div class="col-md-12 mt-5">
                                    <div class="card w-50 card-style2 shadow-sm mx-auto">
                                        <div class="card-body d-flex flex-column">
                                            <div class="card-title h5 text-start">
                                                <p><i class="fas fa-user-circle"></i>' . $detail['Name_U'] . "  " . $detail['Last_U'] . '</p>
                                                <p>' . $detail['ID_C'] . " " . $detail['Name_C'] . '</p>
                                            </div>
                                            <div class="card-text mt-auto mb-auto">' . $detail['Detail_R'] . '</div>
                                            <div class="card-rating mt-auto mb-2 text-start">';
                                                $rating = intval($detail['Rating']);
                                                echo '<div class="rating-stars d-flex">';
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating) {
                                                        echo '<i class="fas fa-star text-warning"></i>';
                                                    } else {
                                                        echo '<i class="far fa-star text-warning"></i>';
                                                    }
                                                }
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="d-flex justify-content-end mt-3">
                                                        <form id="editForm" action="editReview.php" method="post">
                                                            <input type="hidden" value="' . $detail["ID_R"] . '" name="id" />
                                                            <button class="btn btn-success edit-btn mr-3" style="margin-right: 1rem;" style="display: inline;">แก้ไข</button>
                                                        </form>
                                                        <form id="deleteForm" method="POST" action="'. htmlentities($_SERVER["PHP_SELF"]).'">
                                                            <input type="hidden" value="' . $detail["ID_R"] . '" name="id" />
                                                            <button class="btn btn-danger delete-btn" style="margin-right: 1rem;" type="button" onclick="confirmDelete()">ลบ</button>
                                                        </form>
                                                    </div>';
                                        echo '</div>
                                    </div>
                                </div>';
                        endforeach;
                        echo '</div>';                       
                }
            ?>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        async function confirmDelete() {
            const result = await Swal.fire({
                title: 'คุณต้องการลบรีวิวหรือไม่?',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545'
            });

            if (result.isConfirmed) {
                fetch(document.querySelector('#deleteForm').action, {
                    method: 'POST',
                    body: new FormData(document.querySelector('#deleteForm'))
                })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เสร็จสิ้น',
                            text: 'ลบรีวิวเสร็จสิ้น',
                            showConfirmButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'profile.php'; // Redirect ไปยังหน้า profile.php
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถลบรีวิวได้',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'profile.php'; // Redirect ไปยังหน้า profile.php
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
