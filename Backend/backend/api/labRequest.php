<?php
include "../config/db.php";

$patient_name = $_POST['patient_name'];
$patient_id = $_POST['patient_id'];
$test_type = $_POST['test_type'];
$doctor = $_POST['doctor'];

$sql = "INSERT INTO lab_requests
(patient_name, patient_id, test_type, doctor)
VALUES ('$patient_name','$patient_id','$test_type','$doctor')";

if ($conn->query($sql) === TRUE) {
    echo "Lab Request Submitted";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>