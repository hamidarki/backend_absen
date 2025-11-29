<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('schoolClass')->get();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'nullable|exists:classes,id',
            'student_name' => 'required|string|max:100',
            'nis' => 'required|string|unique:students,nis|max:50',
            'photo' => 'nullable|string|max:255',
            'face_embedding' => 'nullable|string'
        ]);

        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show(Student $student)
    {
        $student->load('schoolClass');
        return response()->json($student);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'class_id' => 'nullable|exists:classes,id',
            'student_name' => 'required|string|max:100',
            'nis' => 'required|string|unique:students,nis,'.$student->id.'|max:50',
            'photo' => 'nullable|string|max:255',
            'face_embedding' => 'nullable|string'
        ]);

        $student->update($request->all());
        return response()->json($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
