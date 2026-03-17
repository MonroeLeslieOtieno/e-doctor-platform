const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();
app.use(cors());
app.use(bodyParser.json());

// ─── MySQL Connection ────────────────────────────────────────
// Reads credentials from environment variables.
// Set these in a .env file or your system environment.
const db = mysql.createConnection({
  host: process.env.NODE_DB_HOST || "localhost",
  user: process.env.NODE_DB_USER || "root",
  password: process.env.NODE_DB_PASSWORD || "",
  database: process.env.NODE_DB_NAME || "edoc_platform"
});

db.connect((err) => {
  if (err) {
    console.error("❌ Database connection failed:", err.message);
    process.exit(1);
  }
  console.log("✅ Connected to MySQL Database");
});

// ─── Health Check ────────────────────────────────────────────
app.get("/", (req, res) => {
  res.json({ status: "ok", message: "E-Doctor Backend is running" });
});

// ─── Appointments ─────────────────────────────────────────────
app.get("/api/appointments", (req, res) => {
  db.query("SELECT * FROM appointments ORDER BY appointment_date DESC", (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

// ─── Consultations ─────────────────────────────────────────────
app.get("/api/consultations", (req, res) => {
  db.query("SELECT * FROM consultations ORDER BY created_at DESC", (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

// ─── Lab Requests ─────────────────────────────────────────────
app.get("/api/lab-requests", (req, res) => {
  db.query("SELECT * FROM lab_requests ORDER BY created_at DESC", (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

// ─── Prescriptions ─────────────────────────────────────────────
app.get("/api/prescriptions", (req, res) => {
  db.query("SELECT * FROM prescriptions ORDER BY created_at DESC", (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

// ─── Doctors ─────────────────────────────────────────────────
app.get("/api/doctors", (req, res) => {
  db.query("SELECT * FROM doctors_profile ORDER BY doctor_name", (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

// ─── Students ─────────────────────────────────────────────────
app.get("/api/students", (req, res) => {
  db.query("SELECT * FROM students ORDER BY fullname", (err, results) => {
    if (err) return res.status(500).json({ error: err.message });
    res.json(results);
  });
});

// ─── Start Server ─────────────────────────────────────────────
const PORT = process.env.NODE_PORT || 5000;
app.listen(PORT, () => {
  console.log(`🚀 Server running on http://localhost:${PORT}`);
});
