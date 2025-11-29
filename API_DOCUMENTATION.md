# Smart Presence API Documentation

This document provides detailed information about the Smart Presence REST API endpoints.

## Base URL

```
http://localhost:8000/api
```

## Autentifikasi

### Login
```
POST /login
```

**Request Body:**
```json
{
  "email": "admin@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "message": "Login successful",
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@example.com",
    "email_verified_at": null,
    "created_at": "2025-11-27T03:53:46.000000Z",
    "updated_at": "2025-11-27T03:53:46.000000Z"
  }
}
```

### Logout
```
POST /logout
```

**Response:**
```json
{
  "message": "Logout successful"
}
```

## Dashboard

### Get Dashboard Statistics
```
GET /dashboard
```

**Response:**
```json
{
  "total_students": 0,
  "total_classes": 0,
  "today_attendances": 0,
  "attendance_data": [
    {
      "date": "2025-11-21",
      "count": 0
    },
    // ... more dates
  ]
}
```

## Classes

### Get All Classes
```
GET /classes
```

**Response:**
```json
[
  {
    "id": 1,
    "class_name": "XII RPL A",
    "created_at": "2025-11-27T04:15:22.000000Z",
    "updated_at": "2025-11-27T04:15:22.000000Z"
  }
]
```

### Create New Class
```
POST /classes
```

**Request Body:**
```json
{
  "class_name": "XII RPL A"
}
```

**Response:**
```json
{
  "class_name": "XII RPL A",
  "updated_at": "2025-11-27T04:15:22.000000Z",
  "created_at": "2025-11-27T04:15:22.000000Z",
  "id": 1
}
```

### Get Specific Class
```
GET /classes/{id}
```

**Response:**
```json
{
  "id": 1,
  "class_name": "XII RPL A",
  "created_at": "2025-11-27T04:15:22.000000Z",
  "updated_at": "2025-11-27T04:15:22.000000Z"
}
```

### Update Class
```
PUT /classes/{id}
```

**Request Body:**
```json
{
  "class_name": "XII RPL B"
}
```

**Response:**
```json
{
  "id": 1,
  "class_name": "XII RPL B",
  "created_at": "2025-11-27T04:15:22.000000Z",
  "updated_at": "2025-11-27T04:20:15.000000Z"
}
```

### Delete Class
```
DELETE /classes/{id}
```

**Response:** HTTP 204 No Content

## Students

### Get All Students
```
GET /students
```

**Response:**
```json
[
  {
    "id": 1,
    "class_id": 1,
    "student_name": "John Doe",
    "nis": "12345",
    "photo": "photos/john_doe.jpg",
    "face_embedding": "[0.1, 0.2, 0.3, ...]",
    "created_at": "2025-11-27T04:25:33.000000Z",
    "updated_at": "2025-11-27T04:25:33.000000Z",
    "school_class": {
      "id": 1,
      "class_name": "XII RPL A",
      "created_at": "2025-11-27T04:15:22.000000Z",
      "updated_at": "2025-11-27T04:15:22.000000Z"
    }
  }
]
```

### Create New Student
```
POST /students
```

**Request Body:**
```json
{
  "class_id": 1,
  "student_name": "John Doe",
  "nis": "12345",
  "photo": "photos/john_doe.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]"
}
```

**Response:**
```json
{
  "class_id": 1,
  "student_name": "John Doe",
  "nis": "12345",
  "photo": "photos/john_doe.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]",
  "updated_at": "2025-11-27T04:25:33.000000Z",
  "created_at": "2025-11-27T04:25:33.000000Z",
  "id": 1
}
```

### Get Specific Student
```
GET /students/{id}
```

**Response:**
```json
{
  "id": 1,
  "class_id": 1,
  "student_name": "John Doe",
  "nis": "12345",
  "photo": "photos/john_doe.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]",
  "created_at": "2025-11-27T04:25:33.000000Z",
  "updated_at": "2025-11-27T04:25:33.000000Z",
  "school_class": {
    "id": 1,
    "class_name": "XII RPL A",
    "created_at": "2025-11-27T04:15:22.000000Z",
    "updated_at": "2025-11-27T04:15:22.000000Z"
  }
}
```

### Update Student
```
PUT /students/{id}
```

**Request Body:**
```json
{
  "class_id": 1,
  "student_name": "John Smith",
  "nis": "12345",
  "photo": "photos/john_smith.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]"
}
```

**Response:**
```json
{
  "id": 1,
  "class_id": 1,
  "student_name": "John Smith",
  "nis": "12345",
  "photo": "photos/john_smith.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]",
  "created_at": "2025-11-27T04:25:33.000000Z",
  "updated_at": "2025-11-27T04:30:45.000000Z"
}
```

### Delete Student
```
DELETE /students/{id}
```

**Response:** HTTP 204 No Content

## Attendances

### Get All Attendances
```
GET /attendances
```

**Response:**
```json
[
  {
    "id": 1,
    "student_id": 1,
    "date": "2025-11-27",
    "time_in": "07:30:00",
    "time_out": "15:30:00",
    "status": "hadir",
    "created_at": "2025-11-27T04:35:12.000000Z",
    "updated_at": "2025-11-27T04:35:12.000000Z",
    "student": {
      "id": 1,
      "class_id": 1,
      "student_name": "John Smith",
      "nis": "12345",
      "photo": "photos/john_smith.jpg",
      "face_embedding": "[0.1, 0.2, 0.3, ...]",
      "created_at": "2025-11-27T04:25:33.000000Z",
      "updated_at": "2025-11-27T04:30:45.000000Z"
    }
  }
]
```

### Create New Attendance
```
POST /attendances
```

**Request Body:**
```json
{
  "student_id": 1,
  "date": "2025-11-27",
  "time_in": "07:30:00",
  "time_out": "15:30:00",
  "status": "hadir"
}
```

**Response:**
```json
{
  "student_id": 1,
  "date": "2025-11-27",
  "time_in": "07:30:00",
  "time_out": "15:30:00",
  "status": "hadir",
  "updated_at": "2025-11-27T04:35:12.000000Z",
  "created_at": "2025-11-27T04:35:12.000000Z",
  "id": 1
}
```

### Get Specific Attendance
```
GET /attendances/{id}
```

**Response:**
```json
{
  "id": 1,
  "student_id": 1,
  "date": "2025-11-27",
  "time_in": "07:30:00",
  "time_out": "15:30:00",
  "status": "hadir",
  "created_at": "2025-11-27T04:35:12.000000Z",
  "updated_at": "2025-11-27T04:35:12.000000Z",
  "student": {
    "id": 1,
    "class_id": 1,
    "student_name": "John Smith",
    "nis": "12345",
    "photo": "photos/john_smith.jpg",
    "face_embedding": "[0.1, 0.2, 0.3, ...]",
    "created_at": "2025-11-27T04:25:33.000000Z",
    "updated_at": "2025-11-27T04:30:45.000000Z"
  }
}
```

### Update Attendance
```
PUT /attendances/{id}
```

**Request Body:**
```json
{
  "student_id": 1,
  "date": "2025-11-27",
  "time_in": "07:45:00",
  "time_out": "15:45:00",
  "status": "hadir"
}
```

**Response:**
```json
{
  "id": 1,
  "student_id": 1,
  "date": "2025-11-27",
  "time_in": "07:45:00",
  "time_out": "15:45:00",
  "status": "hadir",
  "created_at": "2025-11-27T04:35:12.000000Z",
  "updated_at": "2025-11-27T04:40:22.000000Z"
}
```

### Delete Attendance
```
DELETE /attendances/{id}
```

**Response:** HTTP 204 No Content

### Get Daily Attendance Report
```
GET /attendances/report/daily?date=2025-11-27
```

**Response:**
```json
[
  {
    "id": 1,
    "student_id": 1,
    "date": "2025-11-27",
    "time_in": "07:45:00",
    "time_out": "15:45:00",
    "status": "hadir",
    "created_at": "2025-11-27T04:35:12.000000Z",
    "updated_at": "2025-11-27T04:40:22.000000Z",
    "student": {
      "id": 1,
      "class_id": 1,
      "student_name": "John Smith",
      "nis": "12345",
      "photo": "photos/john_smith.jpg",
      "face_embedding": "[0.1, 0.2, 0.3, ...]",
      "created_at": "2025-11-27T04:25:33.000000Z",
      "updated_at": "2025-11-27T04:30:45.000000Z",
      "school_class": {
        "id": 1,
        "class_name": "XII RPL A",
        "created_at": "2025-11-27T04:15:22.000000Z",
        "updated_at": "2025-11-27T04:15:22.000000Z"
      }
    }
  }
]
```

### Get Monthly Attendance Report
```
GET /attendances/report/monthly?month=2025-11
```

**Response:**
```json
[
  {
    "id": 1,
    "student_id": 1,
    "date": "2025-11-27",
    "time_in": "07:45:00",
    "time_out": "15:45:00",
    "status": "hadir",
    "created_at": "2025-11-27T04:35:12.000000Z",
    "updated_at": "2025-11-27T04:40:22.000000Z",
    "student": {
      "id": 1,
      "class_id": 1,
      "student_name": "John Smith",
      "nis": "12345",
      "photo": "photos/john_smith.jpg",
      "face_embedding": "[0.1, 0.2, 0.3, ...]",
      "created_at": "2025-11-27T04:25:33.000000Z",
      "updated_at": "2025-11-27T04:30:45.000000Z"
    }
  }
]
```

## Student Training Photos

### Get All Training Photos
```
GET /student-training-photos
```

**Response:**
```json
[
  {
    "id": 1,
    "student_id": 1,
    "photo": "training/john_smith_1.jpg",
    "face_embedding": "[0.1, 0.2, 0.3, ...]",
    "created_at": "2025-11-27T04:45:33.000000Z",
    "updated_at": "2025-11-27T04:45:33.000000Z",
    "student": {
      "id": 1,
      "class_id": 1,
      "student_name": "John Smith",
      "nis": "12345",
      "photo": "photos/john_smith.jpg",
      "face_embedding": "[0.1, 0.2, 0.3, ...]",
      "created_at": "2025-11-27T04:25:33.000000Z",
      "updated_at": "2025-11-27T04:30:45.000000Z"
    }
  }
]
```

### Create New Training Photo
```
POST /student-training-photos
```

**Request Body:**
```json
{
  "student_id": 1,
  "photo": "training/john_smith_1.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]"
}
```

**Response:**
```json
{
  "student_id": 1,
  "photo": "training/john_smith_1.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]",
  "updated_at": "2025-11-27T04:45:33.000000Z",
  "created_at": "2025-11-27T04:45:33.000000Z",
  "id": 1
}
```

### Get Specific Training Photo
```
GET /student-training-photos/{id}
```

**Response:**
```json
{
  "id": 1,
  "student_id": 1,
  "photo": "training/john_smith_1.jpg",
  "face_embedding": "[0.1, 0.2, 0.3, ...]",
  "created_at": "2025-11-27T04:45:33.000000Z",
  "updated_at": "2025-11-27T04:45:33.000000Z",
  "student": {
    "id": 1,
    "class_id": 1,
    "student_name": "John Smith",
    "nis": "12345",
    "photo": "photos/john_smith.jpg",
    "face_embedding": "[0.1, 0.2, 0.3, ...]",
    "created_at": "2025-11-27T04:25:33.000000Z",
    "updated_at": "2025-11-27T04:30:45.000000Z"
  }
}
```

### Update Training Photo
```
PUT /student-training-photos/{id}
```

**Request Body:**
```json
{
  "student_id": 1,
  "photo": "training/john_smith_2.jpg",
  "face_embedding": "[0.1, 0.2, 0.4, ...]"
}
```

**Response:**
```json
{
  "id": 1,
  "student_id": 1,
  "photo": "training/john_smith_2.jpg",
  "face_embedding": "[0.1, 0.2, 0.4, ...]",
  "created_at": "2025-11-27T04:45:33.000000Z",
  "updated_at": "2025-11-27T04:50:12.000000Z"
}
```

### Delete Training Photo
```
DELETE /student-training-photos/{id}
```

**Response:** HTTP 204 No Content

## Activity Logs

### Get All Activity Logs
```
GET /activity-logs
```

**Response:**
```json
[
  {
    "id": 1,
    "user_id": 1,
    "description": "User logged in",
    "created_at": "2025-11-27T04:55:22.000000Z",
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@example.com",
      "email_verified_at": null,
      "created_at": "2025-11-27T03:53:46.000000Z",
      "updated_at": "2025-11-27T03:53:46.000000Z"
    }
  }
]
```

### Create New Activity Log
```
POST /activity-logs
```

**Request Body:**
```json
{
  "user_id": 1,
  "description": "User logged in"
}
```

**Response:**
```json
{
  "user_id": 1,
  "description": "User logged in",
  "created_at": "2025-11-27T04:55:22.000000Z",
  "updated_at": "2025-11-27T04:55:22.000000Z",
  "id": 1
}
```

### Get Specific Activity Log
```
GET /activity-logs/{id}
```

**Response:**
```json
{
  "id": 1,
  "user_id": 1,
  "description": "User logged in",
  "created_at": "2025-11-27T04:55:22.000000Z",
  "updated_at": "2025-11-27T04:55:22.000000Z",
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@example.com",
    "email_verified_at": null,
    "created_at": "2025-11-27T03:53:46.000000Z",
    "updated_at": "2025-11-27T03:53:46.000000Z"
  }
}
```

### Update Activity Log
```
PUT /activity-logs/{id}
```

**Request Body:**
```json
{
  "user_id": 1,
  "description": "User performed action"
}
```

**Response:**
```json
{
  "id": 1,
  "user_id": 1,
  "description": "User performed action",
  "created_at": "2025-11-27T04:55:22.000000Z",
  "updated_at": "2025-11-27T05:00:33.000000Z"
}
```

### Delete Activity Log
```
DELETE /activity-logs/{id}
```

**Response:** HTTP 204 No Content

## Face Recognition

### Recognize Face
```
POST /face-recognition
```

**Request Body:**
```json
{
  "image": "base64_encoded_image_data",
  "type": "in" // or "out"
}
```

**Response:**
```json
{
  "message": "Student recognized",
  "status": "found",
  "student": {
    "id": 1,
    "class_id": 1,
    "student_name": "John Smith",
    "nis": "12345",
    "photo": "photos/john_smith.jpg",
    "face_embedding": "[0.1, 0.2, 0.3, ...]",
    "created_at": "2025-11-27T04:25:33.000000Z",
    "updated_at": "2025-11-27T04:30:45.000000Z"
  },
  "attendance": {
    "id": 1,
    "student_id": 1,
    "date": "2025-11-27",
    "time_in": "07:45:00",
    "time_out": null,
    "status": "hadir",
    "created_at": "2025-11-27T04:35:12.000000Z",
    "updated_at": "2025-11-27T05:05:44.000000Z"
  }
}
```

### Manual Attendance
```
POST /manual-attendance
```

**Request Body:**
```json
{
  "student_id": 1,
  "type": "in" // or "out"
}
```

**Response:**
```json
{
  "message": "Manual attendance recorded",
  "student": {
    "id": 1,
    "class_id": 1,
    "student_name": "John Smith",
    "nis": "12345",
    "photo": "photos/john_smith.jpg",
    "face_embedding": "[0.1, 0.2, 0.3, ...]",
    "created_at": "2025-11-27T04:25:33.000000Z",
    "updated_at": "2025-11-27T04:30:45.000000Z"
  },
  "attendance": {
    "id": 1,
    "student_id": 1,
    "date": "2025-11-27",
    "time_in": "07:45:00",
    "time_out": null,
    "status": "manual",
    "created_at": "2025-11-27T04:35:12.000000Z",
    "updated_at": "2025-11-27T05:10:55.000000Z"
  }
}
```

## Export Data

### Export Students to CSV
```
GET /export/students/csv
```

**Response:** CSV file download

### Export Attendance to CSV
```
GET /export/attendance/csv?date=2025-11-27
```

**Response:** CSV file download

### Export Students to PDF
```
GET /export/students/pdf
```

**Response:** PDF file download

### Export Attendance to PDF
```
GET /export/attendance/pdf?date=2025-11-27
```

**Response:** PDF file download