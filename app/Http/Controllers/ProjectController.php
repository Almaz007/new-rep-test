<?php

namespace App\Http\Controllers;


use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\ProjectStoreRequest;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
        // return ProjectResource::collection(Project::all());
        $Projects = Project::all();
        if($Projects->count() > 0){
            return response()->json([
                'status' => 200,
                'data' => $Projects
            ]);
        }
        else{
            return response()->json([
                'status' => 404,
                'errors' => "No Records Found"
            ]);
        }
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
        // $created__project = Project::create($request->validated());
        // return new ProjectResource($created__project);
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:3|max:255',
            'product' => 'required|string|min:3|max:255',
            'client' => 'required|nullable|string|max:255',
            'year' => 'required|max:2030'
        ]);
        if($validator->fails()){
            return  response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else{
            $project = Project::create([
                'name' => $request->name,
                'product' => $request->product,
                'client' => $request->client,
                'year' => $request->year,
            ]);
        }
        if($project) {
            return response()->json([
                'status' => 200,
                'data' =>[  
                            'id' => $project->id,
                            'name' => $project->name,
                            'product' => $project->product,
                            'client' => $project->client,
                            'year' => $project->year,
                        ],
                'message' => "Project Created Successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => "Something Went Wrong!"
            ],200);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);
        if($project) {
            return response()->json([
                'status' => 200,
                "data" => $project,
                'message' => "The project was found successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "The project under this id was not found"
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        if($project) {
            return response()->json([
                'status' => 200,
                "data" => $project,
                'message' => "The project was found successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "The project under this id was not found"
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:3|max:255',
            'product' => 'required|string|min:3|max:255',
            'client' => 'required|nullable|string|max:255',
            'year' => 'required|max:2030'
        ]);
        if($validator->fails()){
            return  response()->json([
                'status'=>422,
                'errors'=>$validator->messages()
            ],422);
        }else{
            $project = Project::find($id);
        }
        if($project) {
            $project->update([
                'name' => $request->name,
                'product' => $request->product,
                'client' => $request->client,
                'year' => $request->year,
            ]);
            return response()->json([
                'status' => 200,
                'message' => "Project Updated Successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "The project under this id was not found!"
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        if($project) {
            // return response()->json([
            //     'status' => 200,
            //     "project" => $project,
            //     'message' => "The project was found successfully"
            // ],200);
            $project->delete($id);
            return response()->json([
                'status' => 200,
                'message' => "Project Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "The project under this id was not found"
            ],404);
        }
    }
}
