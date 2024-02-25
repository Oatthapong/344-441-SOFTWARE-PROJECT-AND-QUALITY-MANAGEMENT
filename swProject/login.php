<?php 
require_once "connect.php";
require_once "session.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $stmt = mysqli_prepare($conn, "SELECT * FROM account WHERE Username=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
      if (password_verify($password, $user["password"])) {
          $_SESSION["username"] = $username;
          $_SESSION["role"] = $user["role"];
          if ($user["role"] == "student") {
              $_SESSION["page"] = "index.php";
              header("Location:index.php");
          } else {
              $_SESSION["page"] = "admin.php";
              header("Location:admin.php");
          }
          exit();
      }
  }
}
?>

<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Signin</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" >
      <meta name="theme-color" content="#712cf9">
      <style>
         @media (min-width: 768px) {
         .bd-placeholder-img-lg {
         font-size: 3.5rem;
         }
         }
      </style>
      <link href="./css/signin.css" rel="stylesheet">
   </head>
   
   <body class="text-center d-flex justify-content-center align-items-center vh-100">
      <main class="form-signin m-auto pb-5">
         <form method="POST" action="<?php echo htmlentities($_SERVER["PHP_SELF"])?>">
            <h1 class="h3 mb-3 pb-5 font-size">เข้าสู่ระบบ</h1>
            <div class="row g-4 card card-style border border-dark shadow justify-content-center">
               <div class="col-auto">
                  <div class="d-flex align-items-start">
                     <label for="floatingInput" class="form-label text-start fw-bold">ชื่อผู้ใช้:</label>  
                  </div>
                  <input type="text" name="username" class="form-control input-color input-size" id="floatingInput" placeholder="ชื่อผู้ใช้">
               </div>
               <div class="col-auto">
                  <div class="d-flex align-items-start">
                     <label label for="floatingInput" class="form-label text-start fw-bold">รหัสผ่าน:</label>
                  </div>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control input-color input-size pass-swap" id="floatingPassword" placeholder="รหัสผ่าน">
                    <div class="input-group-append">
                      <button class="btn btn-light eye" id="togglePassword">
                      <i class="fa fa-eye"></i>
                      </button>
                    </div>
                  </div>
                  <div>
                      <?php
                      if ($_SERVER["REQUEST_METHOD"] == "POST") {
                          echo '<div class="d-flex align-items-start mt-2 text-danger">โปรดตรวจสอบ ชื่อผู้ใช้และรหัสผ่านให้ถูกต้อง</div>';
                      }
                      ?>
                    </div>
               </div>
               <div class="col-auto">
                  <button class="btn btn-lg btn-color border border-dark border-3 fw-bold" type="submit">เข้าสู่ระบบ</button>
               </div>
               <div class="fw-bold">
                  หากยังไม่มีบัญชี
                  <a href="register.php" class="text-dark"> สมัครที่นี่</a>
               </div>
            </div>
         </form>
      </main>
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
            
            event.preventDefault(); // ยกเลิกการส่งฟอร์ม
         });
      </script>
   </body>
</html>