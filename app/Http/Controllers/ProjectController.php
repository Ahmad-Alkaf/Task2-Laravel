<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::filter($request->only([
            'name',
            'department',
            'start_date',
            'end_date',
            'status',
        ]))->get();
        return $this->sendResponse(
            $projects,
            "Projects retrieved successfully."
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $project = Project::create($request->all());

        return $this->sendResponse($project, 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return $this->sendResponse($project, "Project retrieved successfully.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:projects,id',
            'name' => 'string|max:255',
            'department' => 'string|max:255',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'status' => 'string|max:255',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $project = Project::findOrFail($request->all()['id']);
        $project->update($request->all());
        return $this->sendResponse($project, "Project updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:projects,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        Project::findOrFail($request->all()['id'])->delete();
        return $this->sendResponse(null, "Project deleted successfully.");
    }
}
