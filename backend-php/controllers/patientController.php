<?php
// ============================================================
// Patient Controller — business logic layer (future use)
// API endpoints call functions defined here.
// ============================================================

include '../config/db.php';

function getAllStudents() {
    global $conn;
    $result = $conn->query("SELECT * FROM students ORDER BY fullname");
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    return $students;
}

function getStudentById(int $id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getStudentByRegNumber(string $reg) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM students WHERE reg_number = ?");
    $stmt->bind_param("s", $reg);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
