
<?php
header("Content-Type: application/json; charset=UTF-8");

mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli("127.0.0.1", "root", "", "dsa_hub", 3307);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "error" => "Database connection failed"
    ]);
    exit;
}

$conn->set_charset("utf8mb4");

$subject = trim($_GET["subject"] ?? "");

if ($subject === "") {
    http_response_code(400);
    echo json_encode([
        "error" => "Subject name is required"
    ]);
    $conn->close();
    exit;
}

$sql = "SELECT tq.question_text, tq.answer_text
        FROM technical_questions AS tq
        INNER JOIN tech_subjects AS ts
            ON tq.subject_id = ts.subject_id
        WHERE ts.subject_name = ?
        ORDER BY RAND()
        LIMIT 10";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        "error" => "Query preparation failed"
    ]);
    $conn->close();
    exit;
}

$stmt->bind_param("s", $subject);

if (!$stmt->execute()) {
    http_response_code(500);
    echo json_encode([
        "error" => "Unable to fetch questions"
    ]);
    $stmt->close();
    $conn->close();
    exit;
}

$result = $stmt->get_result();

$questions = [];

while ($row = $result->fetch_assoc()) {
    $questions[] = [
        "q" => $row["question_text"],
        "a" => $row["answer_text"]
    ];
}

echo json_encode(
    $questions,
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);

$stmt->close();
$conn->close();
?>
