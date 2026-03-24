<?php
// ============================================================
// API: Save Prescription
// Method: POST
// ============================================================
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM prescriptions ORDER BY created_at DESC";
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
$medicine     = trim($_POST['medicine']     ?? '');
$dosage       = trim($_POST['dosage']       ?? '');
$instructions = trim($_POST['instructions'] ?? '');

if (!$patient_name || !$doctor || !$medicine) {
    http_response_code(400);
    echo json_encode(['error' => 'patient_name, doctor and medicine are required']);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO prescriptions (patient_name, patient_id, doctor, medicine, dosage, instructions)
     VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("ssssss", $patient_name, $patient_id, $doctor, $medicine, $dosage, $instructions);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Prescription saved successfully', 'id' => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Could not save prescription: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
