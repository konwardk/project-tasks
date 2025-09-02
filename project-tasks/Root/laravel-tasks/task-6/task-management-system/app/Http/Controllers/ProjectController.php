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
   public function index(Request $request)
    {
        $query = Project::join('statuses', 'statuses.id', '=', 'projects.status_id')
            ->join('users', 'projects.created_by', '=', 'users.id')
            ->select(
                'projects.id',
                'projects.project_name',
                'projects.start_date',
                'projects.end_date',
                'statuses.status_name as status',
                'users.name as created_by',
                'projects.created_at',
                'projects.updated_at'
            )
            ->orderBy('projects.created_at', 'desc');

        // 🔹 Apply search filter if query param exists
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('projects.project_name', 'LIKE', "%{$search}%")
                ->orWhere('users.name', 'LIKE', "%{$search}%")
                ->orWhere('statuses.status_name', 'LIKE', "%{$search}%");
            });
        }

        $projects = $query->paginate(8);

        if ($projects->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => "No project found"
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $projects
        ], 200);
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
    public function show($id)
    {
        $project = Project::join('statuses', 'statuses.id', '=', 'projects.status_id')
            ->join('users', 'projects.created_by', '=', 'users.id')
            ->select(
                'projects.id',
                'projects.project_name',
                'projects.start_date',
                'projects.end_date',
                'statuses.status_name as status',
                'users.name as created_by',
                'projects.created_at',
                'projects.updated_at'
            )
            ->where('projects.id', $id)
            ->first();

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $project
        ], 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return response()->json([
            'data' => $project
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // get user
        $user = $request->user();

        // validate inputs
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status_id' => 'required|exists:statuses,id'
        ]);

        if ($validator->fails()) {
            Log::error("Validation failed while updating project ID {$project->id}");
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $project->update([
                'project_name' => $request->project_name,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status_id' => $request->status_id
            ]);

            Log::info("Project updated successfully by {$user->name}");
        } catch (\Exception $e) {
            Log::error("Project update failed by {$user->name}: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => "Project update failed by {$user->name}",
                'error' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => "Project updated successfully by {$user->name}",
            'data' => $project
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // get user
        $user = request()->user();

        try {
            $projectName = $project->name;
            $project->delete();

            Log::info("Project ID {$projectName} deleted by {$user->name}");

            return response()->json([
                'success' => true,
                'message' => "Project ID {$projectName} deleted successfully by {$user->name}"
            ], 200);

        } catch (\Exception $e) {
            Log::error("Failed to delete project ID {$project->id} by {$user->name}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Project deletion failed by {$user->name}",
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function showProjectByStatus(Request $request)
    {
        $query = Project::join('statuses', 'statuses.id', '=', 'projects.status_id')
            ->join('users', 'projects.created_by', '=', 'users.id')
            ->select(
                'projects.id',
                'projects.project_name',
                'projects.start_date',
                'projects.end_date',
                'statuses.status_name as status',
                'users.name as created_by',
                'projects.created_at',
                'projects.updated_at'
            )
            ->where('statuses.id','=',$request->status_id);
            
            // dd($query);


        // Apply filters
        // if ($request->has('status_id')) {
        //     $query->where('projects.status_id', $request->status_id);
        // }

        // if ($request->has('start_date')) {
        //     $query->whereDate('projects.start_date', '>=', $request->start_date);
        // }

        // if ($request->has('end_date')) {
        //     $query->whereDate('projects.end_date', '<=', $request->end_date);
        // }

        // if ($request->has('created_by')) {
        //     $query->where('projects.created_by', $request->created_by);
        // }

        // Get results with pagination (10 per page)
        $projects = $query->orderBy('projects.created_at', 'desc')->paginate(10);

        if (!$projects) {
            return response()->json([
                'success' => false,
                'message' => 'No project found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $projects
        ], 200);
    }



    public function assign(){
        
    }
}
