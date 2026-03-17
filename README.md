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
├── index.html                      # Landing page (browser entry point)
├── .gitignore
├── .env.example                    # Credentials template — copy to .env
├── README.md
│
├── frontend/                       # All HTML pages & client-side assets
│   ├── pages/
│   │   ├── home.html               # Dashboard with module cards
│   │   ├── appointments.html       # Book appointments
│   │   ├── consultation.html       # Patient consultations
│   │   ├── labs.html               # Lab test requests
│   │   ├── prescriptions.html      # Prescriptions
│   │   └── doctors-registration.html
│   └── js/
│       └── script.js
│
├── css/
│   └── style.css                   # Global stylesheet
│
├── backend-php/                    # PHP API — runs under Apache/XAMPP
│   ├── config/
│   │   └── db.php                  # DB connection (reads env vars)
│   ├── api/
│   │   ├── appointment.php         # POST: book appointment
│   │   ├── consultation.php        # POST: save consultation
│   │   ├── labRequest.php          # POST: submit lab request
│   │   ├── prescriptions.php       # POST: save prescription
│   │   ├── registerDoctor.php      # POST: register doctor
│   │   └── getPatients.php         # GET:  list patients (JSON)
│   └── controllers/
│       ├── doctorController.php    # Business logic — doctors (future use)
│       └── patientController.php   # Business logic — patients (future use)
│
├── backend-node/                   # Node.js REST API — runs on port 5000
│   ├── server.js
│   └── package.json
│
└── database/
    └── schema.sql                  # Run this first to create all tables
```

> **Why two backends?**
> - `backend-php/` handles **form submissions** and runs inside Apache/XAMPP alongside the HTML frontend.
> - `backend-node/` is a **REST JSON API** (Express) intended for future use (React frontend, mobile app, etc.). It runs as a separate process on port 5000.

---

## ⚙️ Setup Instructions

### 1. Database — run schema first

```bash
mysql -u root -p < database/schema.sql
```
Or paste the contents of `database/schema.sql` into phpMyAdmin's **SQL** tab.

### 2. PHP Backend (XAMPP / Apache)

1. Copy/clone the repo into your XAMPP web root:
   - **Windows:** `C:\xampp\htdocs\e-doctor-platform\`
   - **macOS:** `/Applications/XAMPP/htdocs/e-doctor-platform/`

2. Create your `.env` file from the template:
   ```
   DB_HOST=localhost
   DB_USER=root
   DB_PASSWORD=your_password
   DB_NAME=edoc_platform
   ```

3. Open your browser:
   ```
   http://localhost/e-doctor-platform/
   ```

### 3. Node.js REST API (optional)

```bash
cd backend-node
npm install
node server.js
# API runs at http://localhost:5000
```

---

## 🔗 API Endpoints

### PHP API (form submissions — served via Apache at web root)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/backend-php/api/appointment.php` | Book an appointment |
| `POST` | `/backend-php/api/consultation.php` | Save a consultation |
| `POST` | `/backend-php/api/labRequest.php` | Submit a lab test request |
| `POST` | `/backend-php/api/prescriptions.php` | Save a prescription |
| `POST` | `/backend-php/api/registerDoctor.php` | Register a doctor |
| `GET`  | `/backend-php/api/getPatients.php` | List patients (JSON) |

### Node.js REST API (`http://localhost:5000`)

| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/api/appointments` | All appointments |
| `GET` | `/api/consultations` | All consultations |
| `GET` | `/api/lab-requests` | All lab requests |
| `GET` | `/api/prescriptions` | All prescriptions |
| `GET` | `/api/doctors` | All registered doctors |
| `GET` | `/api/students` | All registered students |

---

## 🛡️ Security Notes

- All PHP endpoints use **prepared statements** — SQL injection protected
- Database credentials are read from **environment variables** (never hardcoded)
- `.env` is excluded from version control via `.gitignore`
- `node_modules/` is excluded from version control via `.gitignore`
- JWT authentication and HTTPS should be added before production deployment

---

## 🧪 Testing

| Method | Tool | Scope |
|--------|------|-------|
| Black Box | Browser / Postman | Forms, API responses |
| White Box | Code review | PHP logic, SQL queries |
| UAT | Students & medical staff | Full platform usability |
| Performance | Apache JMeter | Concurrent user load |

---

## 🗺️ Technology Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, JavaScript |
| PHP Backend | PHP 8+, MySQLi (prepared statements) |
| Node.js API | Node.js, Express.js, mysql2 |
| Database | MySQL 8 |
| Authentication (planned) | JWT |
| Local Dev | XAMPP (Apache + MySQL) |
| Deployment (planned) | Apache/Nginx + PM2 |

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit using conventional commits: `git commit -m "feat: describe your change"`
4. Push and open a Pull Request against `main`

---

## 📄 License

Final Year Project — Murang'a University of Technology  
&copy; 2026 MUT Health Unit. All rights reserved.
