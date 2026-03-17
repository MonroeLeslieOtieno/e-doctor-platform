-- ============================================================
-- MUT E-Doctor Platform — Database Schema
-- Database: edoc_platform
-- Run this script once to set up all required tables.
-- ============================================================

CREATE DATABASE IF NOT EXISTS edoc_platform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE edoc_platform;

-- ----------------------------------------------------------------
-- Students (patients registered with the university health unit)
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS students (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    reg_number      VARCHAR(20)  NOT NULL UNIQUE,
    fullname        VARCHAR(100) NOT NULL,
    email           VARCHAR(100) UNIQUE,
    phone           VARCHAR(20),
    age             INT,
    previous_condition TEXT,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------
-- Doctors
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS doctors_profile (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    doctor_name     VARCHAR(100) NOT NULL,
    medical_number  VARCHAR(50)  NOT NULL UNIQUE,
    practice        VARCHAR(100),
    specialization  VARCHAR(100),
    phone           VARCHAR(20),
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------
-- Appointments
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS appointments (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    student_id          INT,
    doctor_id           INT,
    patient_name        VARCHAR(100),
    patient_id          VARCHAR(50),
    doctor              VARCHAR(100),
    appointment_date    DATE NOT NULL,
    appointment_time    TIME NOT NULL,
    reason              TEXT,
    status              ENUM('pending','confirmed','completed','cancelled') DEFAULT 'pending',
    created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id)  REFERENCES students(id) ON DELETE SET NULL,
    FOREIGN KEY (doctor_id)   REFERENCES doctors_profile(id) ON DELETE SET NULL
);

-- ----------------------------------------------------------------
-- Consultations
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS consultations (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    patient_name    VARCHAR(100),
    patient_id      VARCHAR(50),
    doctor          VARCHAR(100),
    symptoms        TEXT,
    diagnosis       TEXT,
    notes           TEXT,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------
-- Lab Requests
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS lab_requests (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    patient_name    VARCHAR(100),
    patient_id      VARCHAR(50),
    test_type       VARCHAR(100),
    doctor          VARCHAR(100),
    notes           TEXT,
    status          ENUM('requested','processing','completed') DEFAULT 'requested',
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------
-- Prescriptions
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS prescriptions (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    patient_name    VARCHAR(100),
    patient_id      VARCHAR(50),
    doctor          VARCHAR(100),
    medicine        VARCHAR(200),
    dosage          VARCHAR(100),
    instructions    TEXT,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ----------------------------------------------------------------
-- Feedback
-- ----------------------------------------------------------------
CREATE TABLE IF NOT EXISTS feedback (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    message         TEXT NOT NULL,
    submitted_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
