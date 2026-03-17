<?php
// ============================================================
// API: Register Doctor
// Method: POST
// ============================================================
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$doctor_name    = trim($_POST['doctor_name']    ?? '');
$medical_number = trim($_POST['medical_number'] ?? '');
$specialization = trim($_POST['specialization'] ?? '');
$practice       = trim($_POST['practice']       ?? $specialization);
$phone          = trim($_POST['phone']          ?? '');

if (!$doctor_name || !$medical_number || !$specialization) {
    http_response_code(400);
    echo json_encode(['error' => 'doctor_name, medical_number and specialization are required']);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO doctors_profile (doctor_name, medical_number, practice, specialization, phone)
     VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssss", $doctor_name, $medical_number, $practice, $specialization, $phone);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Doctor registered successfully', 'id' => $stmt->insert_id]);
} else {
    // Handle duplicate medical_number gracefully
    if ($conn->errno === 1062) {
        http_response_code(409);
        echo json_encode(['error' => 'A doctor with this medical license number already exists']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Could not register doctor: ' . $stmt->error]);
    }
}

$stmt->close();
$conn->close();
