<?php
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (!empty($_POST["id"]) && !empty($_POST["password"]) && !empty($_POST["confirmPassword"])) {
        $id = htmlspecialchars($_POST["id"]);
        $password = htmlspecialchars($_POST["password"]);
        $confirmPassword = htmlspecialchars($_POST["confirmPassword"]);
        $error = "";
        $error2 = "";
        if ($password === $confirmPassword){
            $stmt = mysqli_prepare($conn, "SELECT ID_U FROM user WHERE Username=?");
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $result = mysqli_fetch_assoc($result);

            $stmt2 = mysqli_prepare($conn, "SELECT Username FROM account WHERE Username=?");
            mysqli_stmt_bind_param($stmt2, "s", $id);
            mysqli_stmt_execute($stmt2);
            $result2 = mysqli_stmt_get_result($stmt2);
            $result2 = mysqli_fetch_assoc($result2);

            if($result !== null && isset($result["ID_U"]) && $result["ID_U"] == $id){
                if($result2 == 0){
                    $options = [
                        'cost' => 10,
                    ];
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);
                    $stmt = $conn->prepare("INSERT INTO account (`Username`, `password`, `role`) VALUES (?, ?, ?)");
                    $role = "student";
                    $stmt->bind_param("sss", $id, $passwordHash, $role);
                    
                    if ($stmt->execute()) {
                        require_once "session.php";
                        header("Location: login.php");
                        exit;
                    } else {
                        echo '<div class="d-flex align-items-start mt-2 text-danger">มีข้อมูลผู้ใช้อยู่ในระบบแล้ว</div>';
                    }
                
                    $stmt->close();
                    $conn->close();
                }else{
                    $error = '<div class="d-flex align-items-start mt-2 text-danger">มีข้อมูลผู้ใช้อยู่ในระบบแล้ว</div>';
                }
            }else{
                $error2 = '<div class="d-flex align-items-start mt-2 text-danger">โปรดตรวจสอบ รหัสนักศึกษาให้ถูกต้อง</div>';
            }
        }else{
            $error = '<div class="d-flex align-items-start mt-2 text-danger">กรุณากรอกรหัสผ่านให้ตรงกัน</div>';
        }
    }else{
        $error = '<div class="d-flex align-items-start mt-2 text-danger">กรุณากรอกข้อมูลให้ครบทุกช่อง</div>';
    }
}
?>

<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Register</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap">
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" >
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <meta name="theme-color" content="#712cf9">
      <style>
         @media (min-width: 768px) {
         .bd-placeholder-img-lg {
         font-size: 3.5rem;
         }
         }
      </style>
      <link href="./css/register.css" rel="stylesheet">
   </head>

   <body class="">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex align-items-center justify-content-start">
                    <div class="display-1 text-center fw-bold">
                        <p>PSU</p>
                        <p>REVIEW</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <form method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"])?>">
                        <div class="card card-style">
                            <div class="h3 d-flex align-item-center justify-content-center mt-5">
                                สร้างบัญชีผู้ใช้
                            </div>
                            <div class="col-auto mx-10 my-auto">
                                <div class="mt-3">
                                    <div class="d-flex align-items-start">
                                        <label for="floatingInput" class="form-label text-start fw-bold">รหัสนักศึกษา:</label>  
                                    </div>
                                    <input type="text" name="id" class="form-control input-color input-size shadow-sm" placeholder="รหัสนักศึกษา">
                                </div>
                                <div class="d-flex align-items-start">
                                    <?php
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            echo $error2;
                                        }
                                    ?>
                                </div>
                                <div class="mt-3">
                                        <div class="d-flex align-items-start">
                                            <label for="floatingInput" class="form-label text-start fw-bold">รหัสผ่าน:</label>  
                                        </div>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control input-color input-size shadow-sm" id="floatingPassword" placeholder="รหัสผ่าน">
                                        <div class="input-group-append">
                                            <button class="btn btn-light eye shadow-sm" id="togglePassword">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                        <div class="d-flex align-items-start">
                                            <label for="floatingInput" class="form-label text-start fw-bold">ยืนยันรหัสผ่าน:</label>  
                                        </div>
                                    <div class="input-group">
                                        <input type="password" name="confirmPassword" class="form-control input-color input-size shadow-sm" id="confirmPasswordInput" placeholder="ยืนยันรหัสผ่าน">
                                        <div class="input-group-append">
                                            <button class="btn btn-light eye shadow-sm" id="toggleConfirmPassword">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start my-2">
                                    <?php
                                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                            echo $error;
                                        }
                                    ?>
                                </div>
                                <div class="mx-12 mt-5">
                                    <button class="btn btn-lg btn-color mx-auto border border-dark fw-bold" type="submit">
                                        ลงทะเบียน
                                    </button>
                                    <div class="fw-bold mt-4">
                                    ㅤㅤㅤมีบัญชีอยู่แล้ว?
                                        <a href="login.php" class="text-dark">  เข้าสู่ระบบ</a>
                                    </div>
                                </div>
                            </div>                   
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
         document.getElementById("togglePassword").addEventListener("click", function(event) {
            var passwordField = document.getElementById("floatingPassword");
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                this.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                passwordField.type = "password";
                this.innerHTML = '<i class="fa fa-eye"></i>';
            }
            
            event.preventDefault(); 
         });

         document.getElementById("toggleConfirmPassword").addEventListener("click", function(event) {
            var confirmPasswordField = document.getElementById("confirmPasswordInput");
            
            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
                this.innerHTML = '<i class="fa fa-eye-slash"></i>';
            } else {
                confirmPasswordField.type = "password";
                this.innerHTML = '<i class="fa fa-eye"></i>';
            }
            
            event.preventDefault();
        });
      </script>
   </body>
</html>