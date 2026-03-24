<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include '../config/db.php';

$sql = "SELECT id, reg_number, fullname, phone, age, previous_condition FROM students ORDER BY fullname";
$result = $conn->query($sql);

$students = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
echo json_encode($students);
$conn->close();
?>
