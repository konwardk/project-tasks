<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // function for storing atendance record in attendance table
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'employee_id' => 'required|integer',
            'date' => 'required|date',
            'status' => 'required|string|in:present,absent,leave',
        ]);

        $attendance = Attendance::create($validated);

        return response()->json([
            'message' => 'Attendance recorded successfully.',
            'data' => $attendance
        ], 201);
    }
}
