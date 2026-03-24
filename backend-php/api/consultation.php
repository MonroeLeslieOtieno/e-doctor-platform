<?php
// ============================================================
// API: Save Consultation
// Method: POST
// ============================================================
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM consultations ORDER BY created_at DESC";
    $result = $conn->query($sql);
    $data = [];
    if($result){
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
    }
    echo json_encode($data);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$patient_name = trim($_POST['patient_name'] ?? '');
$patient_id   = trim($_POST['patient_id']   ?? '');
$doctor       = trim($_POST['doctor']       ?? '');
$symptoms     = trim($_POST['symptoms']     ?? '');
$diagnosis    = trim($_POST['diagnosis']    ?? '');
$notes        = trim($_POST['notes']        ?? '');

if (!$patient_name || !$doctor || !$symptoms) {
    http_response_code(400);
    echo json_encode(['error' => 'patient_name, doctor, and symptoms are required']);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO consultations (patient_name, patient_id, doctor, symptoms, diagnosis, notes)
     VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("ssssss", $patient_name, $patient_id, $doctor, $symptoms, $diagnosis, $notes);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Consultation saved successfully', 'id' => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Could not save consultation: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
