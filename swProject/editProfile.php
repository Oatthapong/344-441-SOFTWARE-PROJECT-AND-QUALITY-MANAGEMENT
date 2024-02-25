<?php
require_once "connect.php";
require_once "session.php";
require_once "check.php";

$username = $_SESSION['username'];
$query = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query); 
$result = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!empty($_POST["password"]) && !empty($_POST["confirmPassword"])) {
        $password = htmlspecialchars($_POST["password"]);
        $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);
        $error = "";
        if ($password == $confirmPassword){
            $options = [
                'cost' => 10,
            ];
            $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);
        
            $stmt = $conn->prepare("UPDATE account SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $passwordHash, $username);
            
            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(array('message' => 'Password updated successfully'));
            } else {
                http_response_code(500);
                echo json_encode(array('message' => 'Failed to update password'));
            }
            $stmt->close();
            $conn->close();
        } else {
            http_response_code(400);
            echo json_encode(array('error' => 'รหัสผ่านไม่ตรงกัน'));
        }        
    } else {
        http_response_code(400);
        echo json_encode(array('error' => 'กรุณากรอกข้อมูลให้ครบทุกช่อง'));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Edit Profile</title>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
        <meta name="theme-color" content="#712cf9" />

        <link href="./css/editProfile.css" rel="stylesheet" />
    </head>

    <body class="text-center d-flex justify-content-center vh-100">
    <?php include 'navbar.php'; ?>
        <div class="container mt-5">
            <div class="row">
                <div class="h1 mt-5">แก้ไขโปรไฟล์</div>
                <form method="POST" id="editForm" action="<?php echo htmlentities($_SERVER["PHP_SELF"])?>">
                    <div class="card w-50 mx-auto card-style">
                        <div class="card-body">
                            <div class="input-group mx-auto m-4">
                                <div class="d-flex align-items-center">
                                    <label class="form-label text-start fw-bold">ชื่อ :ㅤ ㅤ ㅤ ㅤ ㅤㅤㅤ</label>
                                </div>
                                <input type="text" name="name" class="form-control w-50 input-style shadow-sm" style="color: #9D9D9D;" value="<?php echo $result['Name_U']; ?>" placeholder="ชื่อ" readonly>
                            </div>
                            <div class="input-group mx-auto m-4">
                                <div class="d-flex align-items-center">
                                    <label class="form-label text-start fw-bold">สกุล :ㅤㅤ ㅤㅤㅤㅤㅤ</label>
                                </div>
                                <input type="text" name="lname" class="form-control w-50 input-style shadow-sm" style="color: #9D9D9D;" value="<?php echo $result['Last_U']; ?>" placeholder="สกุล" readonly>
                            </div>
                            <div class="input-group mx-auto m-4">
                                <div class="d-flex align-items-center">
                                    <label class="form-label text-start fw-bold">รหัสนักศึกษา : ㅤ ㅤ ㅤ </label>
                                </div>
                                <input type="text" name="student_id" class="form-control w-50 input-style shadow-sm" style="color: #9D9D9D;" value="<?php echo $result['ID_U']; ?>" placeholder="รหัสนักศึกษา" readonly>
                            </div>
                            <div class="input-group mx-auto m-4">
                                <div class="d-flex align-items-center">
                                    <label class="form-label text-start fw-bold">รหัสผ่าน : ㅤㅤㅤ  ㅤ ㅤ </label>
                                </div>
                                <input type="password" name="password" class="form-control w-50 input-style shadow-sm" placeholder="รหัสผ่าน">
                            </div>
                            <div class="input-group mx-auto m-4">
                                <div class="d-flex align-items-center">
                                    <label class="form-label text-start fw-bold">ยืนยันรหัสผ่าน : ㅤㅤㅤ</label>
                                </div>
                                <input type="password" name="confirmPassword" class="form-control w-50 input-style shadow-sm" placeholder="ยืนยันรหัสผ่าน">
                            </div> 
                        </div>
                        <button class="btn btn-lg btn-color fw-bold mx-auto shadow" type="button" onclick="confirmUpdate()">แก้ไข</button>
                    </div>    
                </form>
            </div>
        </div>
    </body>
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
    </script>
</html>

