<?php
include '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $patient_name = $conn->real_escape_string($_POST['patient_name'] ?? '');
    $patient_id   = $conn->real_escape_string($_POST['patient_id'] ?? '');
    $doctor       = $conn->real_escape_string($_POST['doctor'] ?? '');
    $symptoms     = $conn->real_escape_string($_POST['symptoms'] ?? '');
    $diagnosis    = $conn->real_escape_string($_POST['diagnosis'] ?? '');
    $notes        = $conn->real_escape_string($_POST['notes'] ?? '');

    $stmt = $conn->prepare("INSERT INTO consultations
        (patient_name, patient_id, doctor, symptoms, diagnosis, notes)
        VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssss", $patient_name, $patient_id, $doctor, $symptoms, $diagnosis, $notes);

    if ($stmt->execute()) {
        echo "Consultation Saved Successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>