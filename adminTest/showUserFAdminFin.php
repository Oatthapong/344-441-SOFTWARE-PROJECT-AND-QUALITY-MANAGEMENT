<?php
    require("connect.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST['delete_username'])) {
            $user = $_POST['delete_username'];
            $stmt = $conn->prepare("DELETE FROM account WHERE Username = ?");
            $stmt->bind_param("s", $user);
                
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
    <html>
        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <title>Management Student</title>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <sc8ript src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></sc8ript>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
            <meta name="theme-color" content="#712cf9" />

            <link href="./css/showUser.css" rel="stylesheet" />
        </head>
        <body class = "background text-center d-flex justify-content-center vh-100">
            <div class="container m-auto">
                <h1>จัดการบัญชีนักศึกษา</h1>
                
                <form class="formSearchUser" method="get" action="showUserFAdminFin.php">
                    <div class="topnav mt-3 mb-5 ml-3">
                        <label> ค้นหา : </label>
                        <input class ="searckUsernameBar" type="text" name="Username">
                        <input class="btn-primary" name="btnSubmit" type="submit">
                    </div>
                </form>
                <table class = "showStdTable">
                    <tr>
                        <th width="54%" class ="headColor">Username</th>
                        <th width="13%" class ="headColor">แก้ไข</th>
                        <th width="13%" class ="headColor">ลบ</th>
                    </tr>
                <?php
                    $i=0;
                    if (isset($_GET['Username'])) {
                        $username = $_GET['Username'];       
                        $sql = "SELECT Username 
                                FROM account 
                                WHERE role LIKE 'student' AND Username = '$username'"; 
                        $result = mysqli_query($conn, $sql);

                        
                        if (mysqli_num_rows($result) > 0) {
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='textnotCenter'>".$row['Username']."</td>";
                                echo "<td><a class='btn btn-warning' href='####.php?username_id=".$row['Username']."'>แก้ไข</a></td>";
                                echo '<td>';
                                echo '<form id="deleteForm" method="POST" action="'. htmlentities($_SERVER["PHP_SELF"]).'">';
                                echo '<input type="hidden" name="delete_username" value="' . $row['Username'] . '">';
                                echo '<button class="btn btn-danger delete-btn" style="margin-right: 1rem;" type="button" onclick="confirmDelete()">ลบ</button>';
                                echo '</form>';
                                echo '</td>';                                
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "ไม่พบข้อมูลที่ตรงกับคำค้นหา";
                        }
                    }
                    if($i < 8){
                        for($j = 0; $j < 8 - $i; $j++) {
                            echo "<tr>";
                            echo "<td>&nbsp;<d>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
            </div>
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
                                        window.location.href = 'showUserFAdmin.php'; 
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
                                        window.location.href = 'showUserFAdmin.php'; 
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
        </body>
</html>