<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::all();
        return response()->json($classes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name' => 'required|string|max:50'
        ]);

        $schoolClass = SchoolClass::create($request->all());
        return response()->json($schoolClass, 201);
    }

    public function show(SchoolClass $schoolClass)
    {
        return response()->json($schoolClass);
    }

    public function update(Request $request, SchoolClass $schoolClass)
    {
        $request->validate([
            'class_name' => 'required|string|max:50'
        ]);

        $schoolClass->update($request->all());
        return response()->json($schoolClass);
    }

    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
        return response()->json(null, 204);
    }
}
