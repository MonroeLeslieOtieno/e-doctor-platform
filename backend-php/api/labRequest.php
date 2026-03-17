<?php
// ============================================================
// API: Submit Lab Request
// Method: POST
// ============================================================
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$patient_name = trim($_POST['patient_name'] ?? '');
$patient_id   = trim($_POST['patient_id']   ?? '');
$test_type    = trim($_POST['test_type']    ?? '');
$doctor       = trim($_POST['doctor']       ?? '');
$notes        = trim($_POST['notes']        ?? '');

if (!$patient_name || !$test_type || !$doctor) {
    http_response_code(400);
    echo json_encode(['error' => 'patient_name, test_type and doctor are required']);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO lab_requests (patient_name, patient_id, test_type, doctor, notes)
     VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssss", $patient_name, $patient_id, $test_type, $doctor, $notes);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Lab request submitted successfully', 'id' => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Could not submit lab request: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
