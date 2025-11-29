<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\StudentTrainingPhoto;
use Illuminate\Http\Request;

class FaceRecognitionController extends Controller
{
    public function recognizeFace(Request $request)
    {
        // In a real application, you would process the image here
        // and extract the face embedding
        
        // For this example, we'll simulate the recognition process
        
        $request->validate([
            'image' => 'required|image',
            'type' => 'required|in:in,out' // 'in' for time in, 'out' for time out
        ]);
        
        // Simulate face recognition
        // In a real application, you would compare the face embedding
        // with the embeddings stored in the database
        
        // For demonstration, we'll randomly select a student
        $student = Student::inRandomOrder()->first();
        
        if (!$student) {
            return response()->json([
                'message' => 'No student found',
                'status' => 'not_found'
            ], 404);
        }
        
        // Create attendance record
        $attendance = Attendance::updateOrCreate(
            [
                'student_id' => $student->id,
                'date' => date('Y-m-d')
            ],
            [
                'status' => 'hadir'
            ]
        );
        
        // Update time based on type
        if ($request->type === 'in') {
            $attendance->time_in = date('H:i:s');
        } else {
            $attendance->time_out = date('H:i:s');
        }
        
        $attendance->save();
        
        // Return student data
        return response()->json([
            'message' => 'Student recognized',
            'status' => 'found',
            'student' => $student,
            'attendance' => $attendance
        ]);
    }

    public function manualAttendance(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'type' => 'required|in:in,out'
        ]);
        
        $student = Student::findOrFail($request->student_id);
        
        // Create attendance record
        $attendance = Attendance::updateOrCreate(
            [
                'student_id' => $student->id,
                'date' => date('Y-m-d')
            ],
            [
                'status' => 'manual'
            ]
        );
        
        // Update time based on type
        if ($request->type === 'in') {
            $attendance->time_in = date('H:i:s');
        } else {
            $attendance->time_out = date('H:i:s');
        }
        
        $attendance->save();
        
        return response()->json([
            'message' => 'Manual attendance recorded',
            'student' => $student,
            'attendance' => $attendance
        ]);
    }
}
