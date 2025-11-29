<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentTrainingPhoto;
use Illuminate\Http\Request;

class StudentTrainingPhotoController extends Controller
{
    public function index()
    {
        $trainingPhotos = StudentTrainingPhoto::with('student')->get();
        return response()->json($trainingPhotos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'photo' => 'required|string|max:255',
            'face_embedding' => 'nullable|string'
        ]);

        $trainingPhoto = StudentTrainingPhoto::create($request->all());
        return response()->json($trainingPhoto, 201);
    }

    public function show(StudentTrainingPhoto $studentTrainingPhoto)
    {
        $studentTrainingPhoto->load('student');
        return response()->json($studentTrainingPhoto);
    }

    public function update(Request $request, StudentTrainingPhoto $studentTrainingPhoto)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'photo' => 'required|string|max:255',
            'face_embedding' => 'nullable|string'
        ]);

        $studentTrainingPhoto->update($request->all());
        return response()->json($studentTrainingPhoto);
    }

    public function destroy(StudentTrainingPhoto $studentTrainingPhoto)
    {
        $studentTrainingPhoto->delete();
        return response()->json(null, 204);
    }
}
