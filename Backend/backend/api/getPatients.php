<?php

include '../../config/db.php';

$sql = "SELECT patient, id FROM appointments";
$result = $conn->query($sql);

if(!$result){
    die("Query Failed: " . $conn->error);
}

while($row = $result->fetch_assoc()){

echo "<option value='".$row['patient_id']."'>"
.$row['patient_name']." (".$row['patient_id'].")"
."</option>";

}

$conn->close();

?>