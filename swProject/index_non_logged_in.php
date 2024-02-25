<?php
    require_once "connect.php";
    require_once "session.php";
    
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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
        <meta name="theme-color" content="#712cf9" />

        <link href="./css/index.css" rel="stylesheet" />
    </head>

    <body class="text-center d-flex justify-content-center vh-100">
        <?php include 'navbar.php'; ?>
        <div class="container m-5">
        <div style="margin-top: 3rem;">
            <div class="row">
                <div class="col-md-9">
                    <?php foreach ($details as $detail): ?>
                    <div class="col-md-12 mb-5">
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
                                                        echo '<div class="rating-stars d-flex">'; for ($i = 1; $i <= 5; $i++) { if ($i <= $rating) { echo '<i class="fas fa-star text-warning"></i>'; } else { echo '
                                        <i class="far fa-star text-warning"></i>'; } } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-3">
                <div class="row m-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="h4 text-muted">Top Review</div>
                        </div>
                    </div>
                </div>
                <div class="row m-auto mt-5">
                    <div class="card">
                        <div class="card-body text-start">
                            <form method="post">
                                <?php foreach ($cousres as $i =>
                                $cousre): ?>
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

