<?php
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $searchTerm = $_POST['searchInput'];
    $sql = "SELECT course.*
            FROM course
            LEFT JOIN teach ON course.ID_C = teach.ID_C
            LEFT JOIN teacher ON teach.ID_T = teacher.ID_T
            WHERE 
                course.Name_C LIKE ? OR
                teacher.Name_T LIKE ? OR
                course.ID_C = ?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id_c = $row["ID_C"];
            $conn->close();
            header("Location: description.php?ID_C=$id_c");
            exit();
        }
    }else{
        $conn->close();
        header("Location: noResult.php");   
    }
}
?>