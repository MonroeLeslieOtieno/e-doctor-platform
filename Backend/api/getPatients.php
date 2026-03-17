<?php
// ============================================================
// API: Get Patients (for dropdown population)
// Method: GET
// Returns: JSON array of patients from appointments table
// ============================================================
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../../config/db.php';

$sql    = "SELECT DISTINCT patient_name, patient_id FROM appointments ORDER BY patient_name";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Query failed: ' . $conn->error]);
    $conn->close();
    exit;
}

$patients = [];
while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

echo json_encode($patients);
$conn->close();
