const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");
const bodyParser = require("body-parser");

const app = express();
app.use(cors());
app.use(bodyParser.json());

// MySQL Connection
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "edoc_platform"
});

db.connect((err) => {
  if (err) {
    console.log("Database connection failed", err);
  } else {
    console.log("Connected to MySQL Database");
  }
});

// Test route
app.get("/", (req, res) => {
  res.send("E-Doctor Backend Running");
});

app.listen(5000, () => {
  console.log("Server running on port 5000");
});
