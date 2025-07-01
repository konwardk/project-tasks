<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $user = $request->user();

        // Check if user is admin or manager
        if (!$user->role || !in_array($user->role->role_name, ['admin', 'manager'])) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Only admins or managers can create tasks.'
            ], 403);
        }

        // Validate input
        $validator = Validator::make($request->all(), [
            'task_name'   => 'required|string|max:255',
            'project_id'  => 'required|exists:projects,id',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'assigned_to' => 'required|exists:users,id',
            'status_id'   => 'required|exists:statuses,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create task
            $task = Task::create([
                'task_name'   => $request->task_name,
                'project_id'  => $request->project_id,
                'start_date'  => $request->start_date,
                'end_date'    => $request->end_date,
                'assigned_to' => $request->assigned_to,
                'assigned_by' => $user->id, // logged in user
                'status_id'   => $request->status_id
            ]);

            Log::info("Task '{$task->task_name}' created by {$user->name}");

            return response()->json([
                'success' => true,
                'message' => "Task '{$task->task_name}' created successfully.",
                'data' => $task
            ], 201);

        } catch (\Exception $e) {
            Log::error("Task creation failed by {$user->name}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Task creation failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
