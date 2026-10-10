
<?php
header("Content-Type: application/json; charset=UTF-8");
mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli("127.0.0.1", "root", "", "dsa_hub", 3307);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => $conn->connect_error]);
    exit;
}

$conn->set_charset("utf8mb4");
$data = ["subjects" => [], "debug" => 0, "output" => 0];

$sql1 = "SELECT ts.subject_name, COUNT(tq.question_id) AS total
         FROM tech_subjects ts
         LEFT JOIN technical_questions tq
         ON ts.subject_id = tq.subject_id
         GROUP BY ts.subject_id, ts.subject_name";

$result1 = $conn->query($sql1);

if ($result1) {
    while ($row = $result1->fetch_assoc()) {
        $data["subjects"][$row["subject_name"]] = (int)$row["total"];
    }
}

$sql2 = "SELECT COUNT(*) AS total FROM debugging_questions";
$result2 = $conn->query($sql2);

if ($result2) {
    $row2 = $result2->fetch_assoc();
    $data["debug"] = (int)$row2["total"];
}

$sql3 = "SELECT COUNT(*) AS total FROM output_questions";
$result3 = $conn->query($sql3);

if ($result3) {
    $row3 = $result3->fetch_assoc();
    $data["output"] = (int)$row3["total"];
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
