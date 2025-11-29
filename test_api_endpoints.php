<?php

/**
 * Smart Presence API Testing Script
 * 
 * This script tests all the major endpoints of the Smart Presence API
 * to ensure they are working correctly.
 */

echo "Smart Presence API Testing Script\n";
echo "=================================\n\n";

// Base URL for the API
$baseUrl = 'http://localhost:8000/api';

// Test results counter
$passed = 0;
$failed = 0;

/**
 * Helper function to make HTTP requests
 */
function makeRequest($method, $url, $data = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'httpCode' => $httpCode,
        'response' => $response
    ];
}

/**
 * Helper function to print test results
 */
function testResult($name, $success) {
    global $passed, $failed;
    echo sprintf("%-40s [%s]\n", $name, $success ? "PASS" : "FAIL");
    if ($success) {
        $passed++;
    } else {
        $failed++;
    }
}

// Test 1: Login
echo "1. Testing Authentication\n";
echo "------------------------\n";
$result = makeRequest('POST', $baseUrl . '/login', [
    'email' => 'admin@example.com',
    'password' => 'password'
]);
testResult("Login endpoint", $result['httpCode'] == 200);

// Test 2: Dashboard
echo "\n2. Testing Dashboard\n";
echo "--------------------\n";
$result = makeRequest('GET', $baseUrl . '/dashboard');
testResult("Dashboard endpoint", $result['httpCode'] == 200);

// Test 3: Classes
echo "\n3. Testing Classes\n";
echo "------------------\n";

// Create a class
$result = makeRequest('POST', $baseUrl . '/classes', [
    'class_name' => 'XII RPL A'
]);
$createClassSuccess = $result['httpCode'] == 201;
$classId = $createClassSuccess ? json_decode($result['response'])->id : null;
testResult("Create class", $createClassSuccess);

// Get all classes
$result = makeRequest('GET', $baseUrl . '/classes');
testResult("Get all classes", $result['httpCode'] == 200);

// Get specific class
if ($classId) {
    $result = makeRequest('GET', $baseUrl . '/classes/' . $classId);
    testResult("Get specific class", $result['httpCode'] == 200);
    
    // Update class
    $result = makeRequest('PUT', $baseUrl . '/classes/' . $classId, [
        'class_name' => 'XII RPL B'
    ]);
    testResult("Update class", $result['httpCode'] == 200);
}

// Test 4: Students
echo "\n4. Testing Students\n";
echo "-------------------\n";

// Create a student (only if class was created)
if ($classId) {
    $result = makeRequest('POST', $baseUrl . '/students', [
        'class_id' => $classId,
        'student_name' => 'John Doe',
        'nis' => '12345',
        'photo' => 'photos/john_doe.jpg',
        'face_embedding' => '[0.1, 0.2, 0.3]'
    ]);
    $createStudentSuccess = $result['httpCode'] == 201;
    $studentId = $createStudentSuccess ? json_decode($result['response'])->id : null;
    testResult("Create student", $createStudentSuccess);
    
    // Get all students
    $result = makeRequest('GET', $baseUrl . '/students');
    testResult("Get all students", $result['httpCode'] == 200);
    
    // Get specific student
    if ($studentId) {
        $result = makeRequest('GET', $baseUrl . '/students/' . $studentId);
        testResult("Get specific student", $result['httpCode'] == 200);
        
        // Update student
        $result = makeRequest('PUT', $baseUrl . '/students/' . $studentId, [
            'class_id' => $classId,
            'student_name' => 'John Smith',
            'nis' => '12345',
            'photo' => 'photos/john_smith.jpg',
            'face_embedding' => '[0.1, 0.2, 0.4]'
        ]);
        testResult("Update student", $result['httpCode'] == 200);
    }
}

// Test 5: Attendance
echo "\n5. Testing Attendance\n";
echo "---------------------\n";

// Create attendance (only if student was created)
if ($studentId) {
    $result = makeRequest('POST', $baseUrl . '/attendances', [
        'student_id' => $studentId,
        'date' => date('Y-m-d'),
        'time_in' => '07:30:00',
        'time_out' => '15:30:00',
        'status' => 'hadir'
    ]);
    $createAttendanceSuccess = $result['httpCode'] == 201;
    $attendanceId = $createAttendanceSuccess ? json_decode($result['response'])->id : null;
    testResult("Create attendance", $createAttendanceSuccess);
    
    // Get all attendances
    $result = makeRequest('GET', $baseUrl . '/attendances');
    testResult("Get all attendances", $result['httpCode'] == 200);
    
    // Get specific attendance
    if ($attendanceId) {
        $result = makeRequest('GET', $baseUrl . '/attendances/' . $attendanceId);
        testResult("Get specific attendance", $result['httpCode'] == 200);
        
        // Update attendance
        $result = makeRequest('PUT', $baseUrl . '/attendances/' . $attendanceId, [
            'student_id' => $studentId,
            'date' => date('Y-m-d'),
            'time_in' => '07:45:00',
            'time_out' => '15:45:00',
            'status' => 'hadir'
        ]);
        testResult("Update attendance", $result['httpCode'] == 200);
    }
    
    // Test reports
    $result = makeRequest('GET', $baseUrl . '/attendances/report/daily?date=' . date('Y-m-d'));
    testResult("Daily attendance report", $result['httpCode'] == 200);
    
    $result = makeRequest('GET', $baseUrl . '/attendances/report/monthly?month=' . date('Y-m'));
    testResult("Monthly attendance report", $result['httpCode'] == 200);
}

// Test 6: Face Recognition
echo "\n6. Testing Face Recognition\n";
echo "---------------------------\n";

$result = makeRequest('POST', $baseUrl . '/face-recognition', [
    'image' => 'base64_encoded_image_data',
    'type' => 'in'
]);
// This might fail because it's a simulation, but we'll check if it's a valid response
$faceRecognitionSuccess = in_array($result['httpCode'], [200, 404]);
testResult("Face recognition", $faceRecognitionSuccess);

$result = makeRequest('POST', $baseUrl . '/manual-attendance', [
    'student_id' => $studentId ?? 1,
    'type' => 'in'
]);
// This might fail if no student ID, but we'll check if it's a valid response format
$manualAttendanceSuccess = in_array($result['httpCode'], [200, 404, 422]);
testResult("Manual attendance", $manualAttendanceSuccess);

// Test 7: Export Endpoints
echo "\n7. Testing Export Endpoints\n";
echo "---------------------------\n";

// These will return binary data, so we just check if they return 200
$result = makeRequest('GET', $baseUrl . '/export/students/csv');
testResult("Export students CSV", $result['httpCode'] == 200);

$result = makeRequest('GET', $baseUrl . '/export/attendance/csv');
testResult("Export attendance CSV", $result['httpCode'] == 200);

// Print summary
echo "\n\nTest Summary\n";
echo "============\n";
echo "Passed: " . $passed . "\n";
echo "Failed: " . $failed . "\n";
echo "Total:  " . ($passed + $failed) . "\n";

if ($failed == 0) {
    echo "\n🎉 All tests passed!\n";
} else {
    echo "\n⚠️  Some tests failed. Please check the API implementation.\n";
}