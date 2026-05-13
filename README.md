# Student Academic Advisory System (SAS)

A web-based academic advisory platform built for Nigerian polytechnics and universities. SAS connects students with their assigned academic advisors through a structured portal - covering course tracking, CGPA monitoring, appointment scheduling, and direct messaging.

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat-square&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-22c55e?style=flat-square)

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Default Credentials](#default-credentials)
- [Database Schema](#database-schema)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [Authors](#authors)
- [License](#license)

---

## Overview

SAS is a role-based academic management system designed to digitalise the advisory relationship between students, academic advisors, and institution administrators. It replaces manual, paper-based advisory processes with a centralised, always-accessible web portal.

The system supports three distinct roles, each with a dedicated dashboard and permissions:

| Role | Purpose |
|---|---|
| **Student** | View courses & grades, track CGPA, book appointments, message advisor |
| **Advisor** | Manage student caseload, approve/reject appointments, send messages |
| **Admin** | Full system control - users, courses, advisor assignments, score entry |

---

## Features

### Student Portal
- Personal dashboard with CGPA calculation and academic progress overview
- Course list with credit units, scores, and letter grades per semester
- Appointment booking with real-time status tracking (Pending / Approved / Rejected)
- Direct messaging with assigned academic advisor

### Advisor Portal
- View all assigned students with individual profile and academic details
- Approve or reject student appointment requests with notes
- Monitor student academic progress and CGPA trends
- Direct messaging with each student

### Admin Portal
- Create and manage Student and Advisor accounts
- Assign advisors to students (many-to-many)
- Full course catalogue CRUD - code, title, credit units, semester, level
- Enter and update student scores per course
- Institution-wide user and activity oversight

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 |
| Language | PHP 8.3+ |
| Authentication | Laravel Breeze (with custom role middleware) |
| Database | MySQL 8.0+ |
| Frontend | Bootstrap 5.3, Alpine.js |
| Icons | HugeIcons via Iconify CDN |
| Typography | Outfit (Google Fonts) |
| Build Tool | Vite 6 |

---

## Prerequisites

Before you begin, make sure the following are installed on your machine:

- **PHP** 8.3 or higher - with extensions: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`
- **Composer** 2.x - [getcomposer.org](https://getcomposer.org)
- **Node.js** 20+ and **npm** - [nodejs.org](https://nodejs.org)
- **MySQL** 8.0+ (or MariaDB 10.6+)
- **Git**

---

## Installation

**1. Clone the repository**

```bash
git clone https://github.com/enioladev1/Student-Advisory-System.git
cd academic-advisory-system
```

**2. Install PHP dependencies**

```bash
composer install
```

**3. Set up your environment file**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Configure your database**

Open `.env` and update the database block with your MySQL credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=academic_advisory
DB_USERNAME=root
DB_PASSWORD=
```

Then create the database:

```sql
CREATE DATABASE academic_advisory CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**5. Run migrations and seed the database**

```bash
php artisan migrate
php artisan db:seed
```

**6. Install frontend dependencies and build assets**

```bash
npm install
npm run build
```

**7. Start the development server**

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

> **Tip - one-command setup:** The following script chains steps 2–6 automatically:
>
> ```bash
> composer run setup
> ```

---

## Default Credentials

The database seeder creates the following test accounts. **Change these credentials before deploying to production.**

| Role | Email | Password |
|---|---|---|
| Administrator | `admin@admin.com` | `password` |
| Academic Advisor | `advisor@advisor.com` | `password` |
| Student | `student@student.com` | `password` |

The seeder also creates 9 sample Computer Science courses (100 Level, First and Second Semester) and assigns the sample student to the sample advisor.

---

## Database Schema

| Table | Description |
|---|---|
| `users` | All users - stores `name`, `email`, `password`, `role` |
| `student_profiles` | Extended student data - matric number, department, faculty, level, program |
| `advisor_profiles` | Extended advisor data - staff ID, department, faculty, bio, max students |
| `advisor_student` | Pivot table linking advisors to their assigned students |
| `courses` | Course catalogue - code, title, credit units, semester, level, department |
| `student_courses` | Enrolment records - links students to courses with scores and grades |
| `appointments` | Appointment requests between students and advisors with status tracking |
| `messages` | Direct messages between a student and their advisor |

---

## Project Structure

```
.
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   ├── Advisor/        # Advisor controllers
│   │   │   └── Student/        # Student controllers
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   └── Models/                 # Eloquent models
├── database/
│   ├── migrations/             # All database migrations
│   └── seeders/
│       └── DatabaseSeeder.php  # Seeds demo users, courses, assignments
├── docker/
│   ├── entrypoint.sh
│   ├── nginx.conf
│   └── supervisord.conf
├── resources/
│   └── views/
│       ├── admin/              # Admin dashboard views
│       ├── advisor/            # Advisor dashboard views
│       ├── student/            # Student dashboard views
│       ├── layouts/
│       │   └── app.blade.php   # Main authenticated layout
│       └── welcome.blade.php   # Public landing page
├── routes/
│   ├── web.php                 # All application routes
│   └── auth.php                # Breeze auth routes
├── .env.example
├── composer.json
└── package.json
```

---

## Contributing

Contributions are welcome and appreciated. To get started:

1. **Fork** the repository
2. **Create** a feature branch: `git checkout -b feature/your-feature-name`
3. **Commit** your changes: `git commit -m "Add: your feature description"`
4. **Push** to your branch: `git push origin feature/your-feature-name`
5. **Open** a Pull Request against `main`

### Good first contributions

- Add a `docker-compose.yml` for a full local stack (app + MySQL)

Please keep PRs focused - one feature or fix per PR. Ensure `php artisan test` passes before submitting.


---

## License

This project is open-source and available under the [MIT License](LICENSE).

```
MIT License

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
```
