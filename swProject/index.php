<?php
    session_start();
    if(isset($_SESSION['username'])) {
        header("Location: index_logged_in.php");
        exit;
    } else {
        header("Location: index_non_logged_in.php");
        exit;
    }
?>
