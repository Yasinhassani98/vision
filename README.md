# School Management System

## Overview
The **School Management System** is a web-based application built with **Laravel** to help schools efficiently manage their students, teachers, classes, and schedules. This system is designed to be user-friendly, secure, and scalable, making it ideal for small to medium-sized schools.

## Features
### 🔹 Student & Teacher Management
- Add, update, and delete student and teacher records
- Assign students to specific classes
- Manage teacher profiles and subjects

### 📆 Attendance & Scheduling
- Track student and teacher attendance
- Generate class schedules
- Notify students and teachers of upcoming sessions

### 📊 Reports & Analytics
- Generate reports for student performance
- Track attendance trends
- View statistics on student enrollment and teacher workload

### 💳 Fees & Payment Management
- Record and track student payments
- Generate invoices and payment receipts
- Set up automatic fee reminders

### 🛑 Role-Based Access Control
- Admin, teacher, and student roles
- Secure access to sensitive information
- Permissions based on user roles

### 📢 Notifications & Alerts
- Send email and SMS notifications
- Reminders for fee payments, attendance, and exams

### 📍 Student Tracking
- Integration with **Google Maps API** for real-time student location tracking

## Technology Stack
- **Backend:** Laravel 11 (PHP Framework)
- **Frontend:** Blade
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Payment Integration:** Stripe 

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/Yasinhassani98/vision.git
   ```
2. Navigate to the project directory:
   ```sh
   cd vision
   ```
3. Install dependencies:
   ```sh
   composer install
   npm install && npm run dev
   ```
4. Configure the environment file:
   ```sh
   cp .env.example .env
   ```
   Update database and mail settings.

5. Run migrations and seed database:
   ```sh
   php artisan migrate --seed
   ```
6. Start the development server:
   ```sh
   php artisan serve
   ```

## License
This project is licensed under the MIT License.

## Contact
For inquiries or support, reach out via [Yasin.h1199@gmail.com](mailto:Yasin.h1199@gmail.com).

