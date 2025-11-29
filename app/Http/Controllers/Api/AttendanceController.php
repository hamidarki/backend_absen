<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('student')->get();
        return response()->json($attendances);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'time_in' => 'nullable|date_format:H:i:s',
            'time_out' => 'nullable|date_format:H:i:s',
            'status' => 'required|string|max:20'
        ]);

        $attendance = Attendance::create($request->all());
        return response()->json($attendance, 201);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('student');
        return response()->json($attendance);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'time_in' => 'nullable|date_format:H:i:s',
            'time_out' => 'nullable|date_format:H:i:s',
            'status' => 'required|string|max:20'
        ]);

        $attendance->update($request->all());
        return response()->json($attendance);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return response()->json(null, 204);
    }

    public function dailyReport(Request $request)
    {
        $date = $request->get('date', date('Y-m-d'));
        
        $attendances = Attendance::with('student.schoolClass')
            ->where('date', $date)
            ->get();
            
        return response()->json($attendances);
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->get('month', date('Y-m'));
        
        $attendances = Attendance::with('student')
            ->where('date', 'like', $month . '%')
            ->get();
            
        return response()->json($attendances);
    }
}
