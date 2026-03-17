<?php
include '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize inputs
    $patient_name     = $conn->real_escape_string($_POST['patient_name'] ?? '');
    $patient_id       = $conn->real_escape_string($_POST['patient_id'] ?? '');
    $doctor           = $conn->real_escape_string($_POST['doctor'] ?? '');
    $appointment_date = $conn->real_escape_string($_POST['appointment_date'] ?? '');
    $appointment_time = $conn->real_escape_string($_POST['appointment_time'] ?? '');

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO appointments 
        (patient_name, patient_id, doctor, appointment_date, appointment_time)
        VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $patient_name, $patient_id, $doctor, $appointment_date, $appointment_time);

    if ($stmt->execute()) {
        echo "Appointment Saved Successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>