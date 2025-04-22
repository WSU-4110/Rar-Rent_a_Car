# Rar-Rent_a_Car

A lightweight PHP web application that demonstrates the core workflow of a car‑rental platform—browsing vehicles, creating user accounts, and preparing for payment processing. The code base is intentionally minimal so that students and hobbyists can understand every line.

---

## Features

| Area | Details |
|------|---------|
| Front‑end | Responsive pages for Home, Browse, FAQ, Terms & Conditions, and Privacy, styled with plain HTML and CSS. |
| Authentication | Session‑based login and sign‑up implemented with simple PHP classes. |
| Database Layer | Small PDO wrapper (approximately 30 lines) for MySQL connectivity. |
| Payments | Strategy‑pattern stubs prepared for credit‑card and PayPal integration. |
| Deployment | Runs on any standard LAMP stack or inside Docker with no external dependencies. |

---

## Project Structure

```
Rar-Rent_a_Car-main/
├── CSS/            # Page‑specific and global stylesheets
├── PHP/            # Public pages rendered as PHP files containing HTML
├── classes/        # Database connector and authentication helpers
├── logoimages/     # Icons and hero images
├── *.php           # Payment stubs and checkout placeholder
└── README.md       # Project documentation
```

---

## Quick Start

### Option A — Local LAMP/WAMP/MAMP Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/your‑username/Rar‑Rent‑a‑Car.git
   cd Rar‑Rent‑a‑Car
   ```
2. **Move the project to your web root** (for example, `/var/www/html` on Linux or `htdocs` on XAMPP).
3. **Create the database**
   ```sql
   CREATE DATABASE rar_rental;
   ```
4. **Configure credentials** by editing `classes/connect.php` and setting the host, user name, and password that match your MySQL installation.
5. **(Optional) Import the sample schema** shown later in this document.
6. **Start the built‑in PHP server**
   ```bash
   php -S localhost:8000
   ```
7. **Open** `http://localhost:8000/PHP/home.php` in your browser to verify the installation.

### Option B — Docker

```bash
git clone https://github.com/your‑username/Rar‑Rent‑a‑Car.git
cd Rar‑Rent‑a‑Car
docker compose up --build -d
```
The application will be available at `http://localhost:8080`. The MySQL service is exposed inside the Docker network as `rar_mysql:3306` with the credentials `root/pass`.

To load the sample schema:
```bash
docker exec -i rar_mysql mysql -uroot -ppass rar_rental < docs/sql/schema.sql
```

---

## Configuration

| File | Purpose |
|------|---------|
| `classes/connect.php` | Stores database connection parameters. Replace hard‑coded values or refactor to use environment variables. |
| `PaymentStrategy.php` | Base interface for future payment gateways. Implement `process()` and extend as needed. |
| `CSS/*.css` | Adjust branding, typography, and breakpoints. |

---

## Sample Database Schema

```sql
CREATE TABLE users (
  userid      BIGINT PRIMARY KEY,
  email       VARCHAR(120) UNIQUE NOT NULL,
  username    VARCHAR(50)  NOT NULL,
  password    VARCHAR(255) NOT NULL,
  created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
**Security Notice:** The demonstration code stores plain‑text passwords and uses unprepared SQL. Replace this with `password_hash()` and prepared statements in any non‑trivial deployment.

---

## Roadmap

- Implement secure password hashing and CSRF protection.
- Complete payment integration for credit cards and PayPal.
- Add an administrative dashboard for vehicle and booking management.
- Provide a REST API for use with mobile or single‑page front‑ends.
- Introduce automated testing with PHPUnit and Cypress.

Contributions and suggestions are welcome.

---

## Contributing

1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/<name>`).
3. Commit changes (`git commit -m "Add feature"`).
4. Open a pull request.

Please follow PSR‑12 style guidelines and ensure that all PHP files pass syntax checks with `php -l` before submitting.

---




