<?php

include "db_connect.php";

$subject_id = $_GET['subject_id'];
$unit_id = $_GET['unit_id'];

$sql = "SELECT pdf_title, pdf_path
        FROM pdfs
        WHERE subject_id = $subject_id
        AND unit_id = $unit_id";

$result = $conn->query($sql);

$pdfs = array();

while($row = $result->fetch_assoc()) {
    $pdfs[] = $row;
}

echo json_encode($pdfs);

?>