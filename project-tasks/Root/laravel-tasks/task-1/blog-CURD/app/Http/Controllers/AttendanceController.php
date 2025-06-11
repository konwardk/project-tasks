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

    //get all attendance
    public function getAllAttendance(){
        
        $query = Attendance::all();
        // dd($query);

        return response()->json([
            'data' => $query
        ],201);
    }

    //get todays attendance
    public function getTodayAttendance(){
        $today = now()->toDateString(); // YYYY-MM-DD
        $attendance = Attendance::whereDate('date', $today)->get();
        // dd($attendance);

        if($attendance->isEmpty()){
            return response()->json([

            'message' => "No data today",
            'count' => $attendance->count()
        ],201);
        }

        return response()->json([
            'date' => $today,
            'data' => $attendance,
            'count' => $attendance->count()

        ],200);
    }

    //get attendance by date
    public function getAttendanceByDate(Request $request){
        $date = $request->date;
        $getAttendance = Attendance::where('date',$date)->get();
        // dd($getAttendance);

        if($getAttendance->isEmpty()){
            return response()->json([
                'message' => "No data found"
            ],200);
        }

        return response()->json([
            'date' => $date,
            'data' => $getAttendance
        ],200);

    }

    // get attendance details of a particular employee
    public function getAttendance(Request $request)
    {
        $emp = $request->employee_id;
        // $date = $request->date;

        $attendance = Attendance::where('employee_id', $emp)
            // ->where('date', $date)
            ->get();

        if ($attendance->isEmpty()) {
            return response()->json(['message' => 'Attendance record not found.'], 200);
        }

        return response()->json([
            'data' => $attendance
        ]);
    }
}
