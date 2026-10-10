
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

$sql = "SELECT * FROM debugging_questions";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => $conn->error]);
    $conn->close();
    exit;
}

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        "title" => $row["question_title"],
        "code" => $row["code_snippet"],
        "error" => $row["error_description"],
        "fix" => $row["solution_text"]
    ];
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
$conn->close();
?>
