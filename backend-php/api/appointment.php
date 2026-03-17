<?php
// ============================================================
// API: Book Appointment
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

$student_id       = intval($_POST['student_id']       ?? 0);
$doctor_id        = intval($_POST['doctor_id']        ?? 0);
$appointment_date = $conn->real_escape_string($_POST['appointment_date'] ?? '');
$appointment_time = $conn->real_escape_string($_POST['appointment_time'] ?? '');
$reason           = $conn->real_escape_string($_POST['reason']           ?? '');

if (!$student_id || !$doctor_id || !$appointment_date || !$appointment_time) {
    http_response_code(400);
    echo json_encode(['error' => 'student_id, doctor_id, appointment_date and appointment_time are required']);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO appointments (student_id, doctor_id, appointment_date, appointment_time, reason)
     VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("iisss", $student_id, $doctor_id, $appointment_date, $appointment_time, $reason);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Appointment booked successfully', 'id' => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Could not save appointment: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
