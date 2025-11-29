<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->get();
        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'description' => 'required|string'
        ]);

        $log = ActivityLog::create($request->all());
        return response()->json($log, 201);
    }

    public function show(ActivityLog $activityLog)
    {
        $activityLog->load('user');
        return response()->json($activityLog);
    }

    public function update(Request $request, ActivityLog $activityLog)
    {
        $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'description' => 'required|string'
        ]);

        $activityLog->update($request->all());
        return response()->json($activityLog);
    }

    public function destroy(ActivityLog $activityLog)
    {
        $activityLog->delete();
        return response()->json(null, 204);
    }
}
