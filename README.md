# MUT E-Doctor Platform

> A web-based teleconsultation and health records management system for **Murang'a University of Technology (MUT)** Health Unit.

---

## 📋 Overview

The MUT E-Doctor Platform enables students, staff, and faculty to:

- 📅 **Book appointments** with university health unit doctors
- 🩺 **Log consultations** with symptoms, diagnosis, and notes
- 🧪 **Submit lab test requests** and view results
- 💊 **Manage prescriptions** digitally
- 👨‍⚕️ **Register doctors** with their medical license and specialization

---

## 🗂 Project Structure

```
e-doctor-platform/
│
├── index.html                  # Main landing page (entry point)
│
├── frontend/
│   ├── pages/
│   │   ├── home.html           # Dashboard
│   │   ├── appointments.html   # Book appointments
│   │   ├── consultation.html   # Patient consultations
│   │   ├── labs.html           # Lab test requests
│   │   ├── prescriptions.html  # Prescriptions
│   │   └── doctors-registration.html
│   └── js/
│       └── script.js           # Shared JavaScript
│
├── css/
│   └── style.css               # Global stylesheet
│
├── backend/
│   └── api/
│       ├── appointment.php     # POST: book appointment
│       ├── consultation.php    # POST: save consultation
│       ├── labRequest.php      # POST: submit lab request
│       ├── prescriptions.php   # POST: save prescription
│       ├── registerDoctor.php  # POST: register doctor
│       └── getPatients.php     # GET: list patients (JSON)
│
├── config/
│   └── db.php                  # MySQL connection (reads from env vars)
│
├── Backend/                    # Node.js REST API (optional/supplemental)
│   ├── server.js
│   └── package.json
│
├── database/
│   └── schema.sql              # Full database setup script — run this first
│
├── .env.example                # Environment variable template
├── .gitignore
└── README.md
```

---

## ⚙️ Setup Instructions

### 1. Database

1. Open **phpMyAdmin** or any MySQL client
2. Run the SQL schema:
   ```bash
   mysql -u root -p < database/schema.sql
   ```
   Or paste the contents of `database/schema.sql` into phpMyAdmin's SQL tab.

### 2. PHP Backend (XAMPP / Apache)

1. Copy or clone this repo into your web server root:
   - **XAMPP (Windows):** `C:\xampp\htdocs\e-doctor-platform\`
   - **XAMPP (macOS):** `/Applications/XAMPP/htdocs/e-doctor-platform/`

2. Create a `.env` file (or set PHP environment variables) using `.env.example` as a template:
   ```
   DB_HOST=localhost
   DB_USER=root
   DB_PASSWORD=your_password
   DB_NAME=edoc_platform
   ```
   > **Note:** If your environment does not support `getenv()`, you can edit `config/db.php` directly for local development — but **never commit real credentials**.

3. Open your browser and navigate to:
   ```
   http://localhost/e-doctor-platform/
   ```

### 3. Node.js REST API (optional)

The `Backend/` folder provides a supplemental Node.js REST API for reading data:

```bash
cd Backend
npm install
cp ../.env.example ../.env   # fill in your values
node server.js
```

API will run on `http://localhost:5000`

---

## 🔗 API Endpoints

### PHP API (form submissions — served at web root)

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/backend/api/appointment.php` | Book an appointment |
| POST | `/backend/api/consultation.php` | Save a consultation |
| POST | `/backend/api/labRequest.php` | Submit a lab test request |
| POST | `/backend/api/prescriptions.php` | Save a prescription |
| POST | `/backend/api/registerDoctor.php` | Register a doctor |
| GET  | `/backend/api/getPatients.php` | List patients (JSON) |

### Node.js REST API (GET endpoints — `http://localhost:5000`)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/appointments` | All appointments |
| GET | `/api/consultations` | All consultations |
| GET | `/api/lab-requests` | All lab requests |
| GET | `/api/prescriptions` | All prescriptions |
| GET | `/api/doctors` | All doctors |
| GET | `/api/students` | All students |

---

## 🛡️ Security Notes

- All PHP API endpoints use **prepared statements** (PDO/MySQLi) to prevent SQL injection
- Database credentials are read from **environment variables** — do not hardcode them
- `.env` is excluded from version control via `.gitignore`
- Authentication (JWT) and HTTPS should be added before production deployment

---

## 🧪 Testing

Recommended testing approach:
- **Black Box Testing:** Test login, booking, and form submissions via the browser
- **White Box Testing:** Review PHP/Node.js logic for edge cases
- **User Acceptance Testing (UAT):** Conduct with students and medical staff
- **Performance Testing:** Use Apache JMeter for load testing

---

## 🗺️ Technology Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, JavaScript |
| PHP Backend | PHP 8+, MySQLi (prepared statements) |
| Node.js API | Node.js, Express, mysql2 |
| Database | MySQL 8 |
| Authentication (planned) | JWT |
| Deployment | XAMPP (local), Apache/Nginx (production) |

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "feat: describe your change"`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 📄 License

This project is developed as a Final Year Project at Murang'a University of Technology.

&copy; 2026 Murang'a University Health Unit
