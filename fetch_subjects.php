<?php

include "db_connect.php";

$branch_id = $_GET['branch_id'];

$sql = "SELECT subject_id, subject_name 
        FROM subjects 
        WHERE branch_id = '$branch_id'";

$result = $conn->query($sql);

$subjects = array();

while($row = $result->fetch_assoc()) {
    $subjects[] = $row;
}

echo json_encode($subjects);

?>