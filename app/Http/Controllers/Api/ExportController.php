<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportStudentsCSV()
    {
        $students = Student::with('schoolClass')->get();
        
        $csvData = "ID,NIS,Name,Class,Photo,Created At\n";
        
        foreach ($students as $student) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s\n",
                $student->id,
                $student->nis,
                $student->student_name,
                $student->schoolClass ? $student->schoolClass->class_name : '',
                $student->photo,
                $student->created_at
            );
        }
        
        $filename = 'students_' . date('Y-m-d_H-i-s') . '.csv';
        
        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
    
    public function exportAttendanceCSV(Request $request)
    {
        $date = $request->get('date', date('Y-m-d'));
        $attendances = Attendance::with('student.schoolClass')->where('date', $date)->get();
        
        $csvData = "ID,Student NIS,Student Name,Class,Date,Time In,Time Out,Status,Created At\n";
        
        foreach ($attendances as $attendance) {
            $csvData .= sprintf(
                "%d,%s,%s,%s,%s,%s,%s,%s,%s\n",
                $attendance->id,
                $attendance->student->nis,
                $attendance->student->student_name,
                $attendance->student->schoolClass ? $attendance->student->schoolClass->class_name : '',
                $attendance->date,
                $attendance->time_in ?? '',
                $attendance->time_out ?? '',
                $attendance->status,
                $attendance->created_at
            );
        }
        
        $filename = 'attendance_' . $date . '_' . date('Y-m-d_H-i-s') . '.csv';
        
        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
    
    public function exportStudentsPDF()
    {
        $students = Student::with('schoolClass')->get();
        
        $pdf = Pdf::loadView('exports.students', compact('students'));
        
        return $pdf->download('students_' . date('Y-m-d_H-i-s') . '.pdf');
    }
    
    public function exportAttendancePDF(Request $request)
    {
        $date = $request->get('date', date('Y-m-d'));
        $attendances = Attendance::with('student.schoolClass')->where('date', $date)->get();
        
        $pdf = Pdf::loadView('exports.attendance', compact('attendances', 'date'));
        
        return $pdf->download('attendance_' . $date . '_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}
