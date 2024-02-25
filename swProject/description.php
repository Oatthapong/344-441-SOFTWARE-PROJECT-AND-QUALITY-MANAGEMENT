<?php
require_once "connect.php";
if (isset($_GET['ID_C'])){
    $ID_C = htmlspecialchars($_GET['ID_C']);
    
    $query = "SELECT c.ID_C, c.Name_C, c.Detail_C, ca.Name_Ca, tc.Name_T FROM course as c, teach as t, teacher as tc, category as ca WHERE c.ID_Ca = ca.ID_Ca AND c.ID_C = t.ID_C AND t.ID_T = tc.ID_T AND c.ID_C='".$ID_C."'";
    $result = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($result);

    $query = "SELECT r.ID_R, u.Name_U, u.Last_U, r.Detail_R, r.Rating, c.ID_C, c.Name_C FROM review as r, course as c, user as u WHERE r.username = u.username AND r.ID_C = c.ID_C AND c.ID_C = '".$ID_C."'";
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
		<title><?php echo $result['ID_C']." ".$result['Name_C'];; ?></title>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
		<meta name="theme-color" content="#712cf9" />

		<link href="./css/description.css" rel="stylesheet" />
	</head>

	<body class="text-center d-flex justify-content-center vh-100">
	<?php include 'navbar.php'; ?>
		<div class="container-fluid no-padding">
			<div class="row">
				<div class="card shadow mt-5 rounded-0" style="text-align: left; background-color: #ffffff;">
					<div class="head h4 fw-bold mt-5">
						รายละเอียดวิชา
						<div class="couse">
							<p>
								<?php echo $result['ID_C']; ?>
								<?php echo $result['Name_C']; ?>
							</p>
						</div>
					</div>
					<div class="descrip h5">
						<p>
							หมวดหมู่ &nbsp;&nbsp;&nbsp;ㅤㅤㅤ:ㅤ
							<?php echo $result['Name_Ca']; ?>
						</p>
						<p>
							อาจารย์ผู้สอน ㅤ&nbsp;&nbsp;&nbsp;:ㅤ
							<?php echo $result['Name_T']; ?>
						</p>
						<div class="mb-4" style="display: flex;">
							<div style="flex-shrink: 0;">คำอธิบายรายวิชา &nbsp;:ㅤ</div>
							<div style="flex-grow: 1; word-wrap: break-word;"><?php echo $result['Detail_C']; ?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="container">
					<div class="title h1 fw-bold mt-5 text-start title-style">
						<p>
							รีวิวรายวิชา
							<?php echo $result['ID_C']; ?>
						</p>
						<p><?php echo $result['Name_C']; ?></p>
					</div>
					<div class="d-flex justify-content-center">
						<?php foreach ($details as $detail): ?>
						<div class="col-md-12 mt-5">
						<div class="card card-style shadow-sm mx-auto">
							<div class="card-body d-flex flex-column">
								<div class="card-title h5 text-start">
                                    <p><i class="fas fa-user-circle"></i>
                                    <?php echo $detail['Name_U']."  ".$detail['Last_U']; ?></p>
                                    <p><?php echo $result['ID_C']; ?>
								    <?php echo $result['Name_C']; ?></p>
								</div>
								<div class="card-text mt-auto mb-auto">
									<?php echo $detail['Detail_R']; ?>
								</div>
								<div class="card-rating mt-auto mb-2 text-start">
									<?php 
                                        $rating = intval($detail['Rating']);
                                        echo '<div class="rating-stars d-flex">'; 
                                        for ($i = 1; $i <= 5; $i++) { if ($i <= $rating){ 
                                            echo '<i class="fas fa-star text-warning"></i>';
                                        }else{ 
                                            echo '<i class="far fa-star text-warning"></i>'; 
                                        } 
                                    }
                                    echo '</div>'; ?>
							</div>
						</div>
					</div>
					
					<?php endforeach; ?>
				</div>
			</div>
			</div>
		</div>
		<footer class="footer mt-5">
			<div class="container text-center">
				<span class="text-muted">© 2024 PSU REVIEW. 344-342</span>
			</div>
		</footer>
	</body>
</html>


