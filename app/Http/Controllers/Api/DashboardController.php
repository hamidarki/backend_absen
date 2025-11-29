<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalClasses = SchoolClass::count();
        $todayAttendances = Attendance::whereDate('created_at', date('Y-m-d'))->count();
        
        // Get attendance data for the last 7 days
        $attendanceData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $count = Attendance::whereDate('created_at', $date)->count();
            $attendanceData[] = [
                'date' => $date,
                'count' => $count
            ];
        }
        
        return response()->json([
            'total_students' => $totalStudents,
            'total_classes' => $totalClasses,
            'today_attendances' => $todayAttendances,
            'attendance_data' => $attendanceData
        ]);
    }
}
