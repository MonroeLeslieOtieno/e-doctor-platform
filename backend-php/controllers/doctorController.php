<?php
// ============================================================
// Doctor Controller — business logic layer (future use)
// API endpoints call functions defined here.
// ============================================================

include '../config/db.php';

function getAllDoctors() {
    global $conn;
    $result = $conn->query("SELECT * FROM doctors_profile ORDER BY doctor_name");
    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
    return $doctors;
}

function getDoctorById(int $id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM doctors_profile WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
