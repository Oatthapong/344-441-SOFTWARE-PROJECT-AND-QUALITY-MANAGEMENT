<?php
    include("connect.php");

    // ตรวจสอบว่ามีการส่งค่า 'username_id' ผ่าน URL มาหรือไม่
    if(isset($_GET["username_id"])) {
        $username = $_GET["username_id"];
    } else {
        // หากไม่มีการส่งค่า 'username_id' ผ่าน URL ให้กำหนดค่าเริ่มต้นหรือทำการแจ้งเตือน
        $username = "ไม่มีการส่งค่า 'username_id'";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Edit Username</title>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
        <meta name="theme-color" content="#712cf9" />
        <link href="./css/showCourse.css" rel="stylesheet" />
    </head>
    <body class="background text-center d-flex justify-content-center vh-100">
        <div class="container mx-auto">
            <h2 style="margin-top: 10%; margin-bottom: 5%">แก้ไขบัญชีนักศึกษา</h2>
            
            <form class="formEditUser" method="get" action="updatestudent-AD.php">
                <div class="topnav mt-3 mb-5">
                    <input type="hidden" name="old_username" value="<?php echo $username; ?>">
                    <p style="font-size: 20px; margin-right: 50px"> username :
                    <input class="searckUsernameBar" type="text" name="username" value="<?php echo $username; ?>" ></p>
                    
                    <button class='btn-primary2 mx-4' style='margin: 5%;' type='button' onclick="confirmEdit()">แก้ไข</button>
                </div>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
             function confirmEdit() {
                Swal.fire({
                    title: 'คุณต้องการแก้ไขหรือไม่?',
                    showCancelButton: true,
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#dc3545'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ทำสิ่งที่ต้องการเมื่อกดปุ่ม "ตกลง"
                        document.querySelector('.formEditUser').submit();
                    }
                });
            }
        </script>
    </body>
</html>
<?php
    include("connect.php");

    if(isset($_GET["username"])) {
        $newUsername = $_GET["username"];
        $oldUsername = $_GET["old_username"]; 

        $sql1 = "UPDATE account SET 
                Username = '$newUsername'
                WHERE Username='$oldUsername'"; 

        $result1 = mysqli_query($conn, $sql1) or die ("Error in query: $sql1 " . mysqli_error($conn));

        $sql2 = "UPDATE user SET 
                ID_U = '$newUsername',
                Username = '$newUsername'
                WHERE ID_U='$oldUsername'"; 

        $result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error($conn));

        mysqli_close($conn);

        if($result1 && $result2) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'เสร็จสิ้น',
                    text: 'แก้ไขเสร็จสิ้น',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'showUserFAdmin.php'; 
                    }
                });
            </script>";
        } else {
            echo "<script type='text/javascript'>";
            echo "</script>";
        }
       
        
    }
 
?>
