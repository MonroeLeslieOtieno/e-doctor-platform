<?php
include "../config/db.php";

$doctor_name = $_POST['doctor_name'];
$medical_number = $_POST['medical_number'];
$practice = $_POST['practice'];
$phone = $_POST['phone'];

$sql = "INSERT INTO doctors_profile 
(doctor_name, medical_number, practice, phone)
VALUES ('$doctor_name','$medical_number','$practice','$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Doctor Registered Successfully";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>