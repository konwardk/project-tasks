<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
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
        // get user
        $user = $request->user();

        //validate inputs
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);

        if($validator->fails()){
            Log::error("Please check the inputs");
            return response()->json([
                'errors' => $validator->errors()
            ],422);

        }

        try{
            $project = Project::create([
            'project_name' => $request->project_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => $user->id,
            'status_id' => $request->status_id,
        ]);

        Log::info('Project created successful by '.$user->name);

        }catch(Exception $e){
            Log::error("Project created failed by $user->name".$e->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Project created failed by $user->name ",
                'error' => $e->getMessage()
            ],422);

        }
        
        return response()->json([
            'success' => true,
            'message' => " Project created successful by $user->name ",
            'data' => $project
        ],200);


    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
