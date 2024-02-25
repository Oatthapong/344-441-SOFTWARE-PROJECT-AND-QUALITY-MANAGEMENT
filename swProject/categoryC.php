<?php
require_once "connect.php";
require_once "session.php";

$query = "SELECT ID_C, Name_C FROM course WHERE ID_Ca = '2'";
$result = mysqli_query($conn, $query);

$courses = array();
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
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

        <link href="./css/categoryC.css" rel="stylesheet" />
    </head>

    <body class="text-center d-flex justify-content-center align-items-center vh-100">
    <?php include 'navbar.php'; ?>
        <div class="container">
            <div class="row mt-5">
                <div class="h1 mt-5">รายวิชาเลือก</div>
            </div>
            <div class="row mt-5" style="height: 550px;">
                <?php foreach ($courses as $course): ?>
                <div class="col-md-4 d-flex justify-content-center">
                    <a href="description.php?ID_C=<?php echo $course['ID_C']; ?>" style="text-decoration: none;">
                        <div class="card card-style shadow-sm">
                            <div class="card-body">
                                <div class="card-title h1">
                                    <?php echo $course['ID_C']; ?>
                                </div>
                                <div class="card-text mt-4">
                                    <?php echo $course['Name_C']; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>

