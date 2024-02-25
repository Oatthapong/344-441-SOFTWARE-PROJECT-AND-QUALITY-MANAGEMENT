<?php
require_once "connect.php";
require_once "session.php";
require_once "check.php";
    if (!empty($_POST["myReview"]) && !empty($_POST["rating"])) {
        $review = $_POST["myReview"];
        $rating = $_POST["rating"];
        $idr = $_POST["idr"];
        
        $stmt = $conn->prepare("UPDATE review SET Detail_R = ?, Rating = ? WHERE ID_R = ?");
        $stmt->bind_param("sss", $review, $rating, $idr);

        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(array('message' => 'Password updated successfully'));
        } else {
            http_response_code(500);
            echo json_encode(array('message' => 'Failed to update password'));
        }
        $stmt->close();
        $conn->close();
    }else{
        http_response_code(400);
        $error = '<div class="d-flex align-items-start mx-auto text-danger">กรุณากรอกข้อมูลให้ครบทุกช่อง</div>';
    }
?>
