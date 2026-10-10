<?php

include "db_connect.php";

$year_id = $_GET['year_id'];

$sql = "SELECT branch_id, branch_name 
        FROM branches 
        WHERE year_id = $year_id";

$result = $conn->query($sql);

$branches = array();

while($row = $result->fetch_assoc()) {
    $branches[] = $row;
}

echo json_encode($branches);

?>