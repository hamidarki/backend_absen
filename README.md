# Smart Presence (Absen Cerdas) Backend API

This is the backend API for the Smart Presence application built with Laravel.

## Features Implemented

1. ✅ Login Sederhana (Admin login with email & password)
2. ✅ Manajemen Siswa (CRUD students)
3. ✅ Manajemen Kelas (CRUD classes)
4. ✅ Pengenalan Wajah (Face recognition simulation)
5. ✅ Absensi Otomatis (Automatic attendance)
6. ✅ Laporan Kehadiran (Attendance reports)
7. ✅ Dashboard Admin Sederhana (Simple admin dashboard)
8. ✅ Log Aktivitas (Activity logs)
9. ✅ Upload Foto Wajah untuk Training (Upload training photos)

## API Endpoints

### Authentication
- `POST /api/login` - User login
- `POST /api/logout` - User logout

### Dashboard
- `GET /api/dashboard` - Get dashboard statistics

### Classes
- `GET /api/classes` - Get all classes
- `POST /api/classes` - Create a new class
- `GET /api/classes/{id}` - Get a specific class
- `PUT /api/classes/{id}` - Update a class
- `DELETE /api/classes/{id}` - Delete a class

### Students
- `GET /api/students` - Get all students
- `POST /api/students` - Create a new student
- `GET /api/students/{id}` - Get a specific student
- `PUT /api/students/{id}` - Update a student
- `DELETE /api/students/{id}` - Delete a student

### Attendances
- `GET /api/attendances` - Get all attendances
- `POST /api/attendances` - Create a new attendance record
- `GET /api/attendances/{id}` - Get a specific attendance record
- `PUT /api/attendances/{id}` - Update an attendance record
- `DELETE /api/attendances/{id}` - Delete an attendance record
- `GET /api/attendances/report/daily` - Get daily attendance report
- `GET /api/attendances/report/monthly` - Get monthly attendance report

### Student Training Photos
- `GET /api/student-training-photos` - Get all training photos
- `POST /api/student-training-photos` - Upload a new training photo
- `GET /api/student-training-photos/{id}` - Get a specific training photo
- `PUT /api/student-training-photos/{id}` - Update a training photo
- `DELETE /api/student-training-photos/{id}` - Delete a training photo

### Activity Logs
- `GET /api/activity-logs` - Get all activity logs
- `POST /api/activity-logs` - Create a new activity log
- `GET /api/activity-logs/{id}` - Get a specific activity log
- `PUT /api/activity-logs/{id}` - Update an activity log
- `DELETE /api/activity-logs/{id}` - Delete an activity log

### Face Recognition
- `POST /api/face-recognition` - Recognize face from image
- `POST /api/manual-attendance` - Record manual attendance

### Export Data
- `GET /api/export/students/csv` - Export students to CSV
- `GET /api/export/attendance/csv` - Export attendance to CSV
- `GET /api/export/students/pdf` - Export students to PDF
- `GET /api/export/attendance/pdf` - Export attendance to PDF

## Database Setup

1. Create a MySQL database named `smart_presence`
2. Update your `.env` file with the correct database credentials
3. Run the migrations:
   ```
   php artisan migrate
   ```
4. Seed the database with default data:
   ```
   php artisan db:seed
   ```

## Default Admin User

- Email: admin@example.com
- Password: password

## Requirements

- PHP >= 8.1
- MySQL
- Composer
- Laravel 10

## Installation

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and configure your database settings
4. Run `php artisan key:generate`
5. Run `php artisan migrate`
6. Run `php artisan db:seed`
7. Start the server with `php artisan serve`

## Documentation

- [API Documentation](API_DOCUMENTATION.md) - Detailed API endpoint documentation
- [Postman Collection](SmartPresence_API.postman_collection.json) - Importable Postman collection for testing
- [Postman Environment](SmartPresence_API.postman_environment.json) - Environment configuration for Postman

## Testing

You can test the API using the provided testing script:

```
php test_api_endpoints.php
```

## Notes

This is a simplified implementation without security features as requested:
- No JWT tokens
- No password encryption
- No complex roles
- No GPS validation
- No API firewall
- No request limiting