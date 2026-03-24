<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../config/db.php';

$sql = "SELECT * FROM doctors_profile ORDER BY doctor_name";
$result = $conn->query($sql);

$doctors = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}
echo json_encode($doctors);
$conn->close();
?>
