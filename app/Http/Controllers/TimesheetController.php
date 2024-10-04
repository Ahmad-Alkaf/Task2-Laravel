<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $timesheets = Timesheet::filter($request->only([
            'task_name',
            'date',
            'hours',
        ]))->get();
        return $this->sendResponse(
            $timesheets,
            "Timesheets retrieved successfully."
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|string|max:255',
            'date' => 'required|date',
            'hours' => 'required|numeric|min:0',
            'user_id' => 'required|integer|exists:users,id',
            'project_id' => 'required|integer|exists:projects,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $timesheet = Timesheet::create($request->all());

        return $this->sendResponse($timesheet, 'Timesheet created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Timesheet $timesheet)
    {
        return $this->sendResponse($timesheet, "Timesheet retrieved successfully.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:timesheets,id',
            'task_name' => 'string|max:255',
            'date' => 'date',
            'hours' => 'numeric|min:0',
            'user_id' => 'integer|exists:users,id',
            'project_id' => 'integer|exists:projects,id',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $timesheet = Timesheet::findOrFail($request->all()['id']);
        $timesheet->update($request->all());
        return $this->sendResponse($timesheet, "Timesheet updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:timesheets,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        Timesheet::findOrFail($request->all()['id'])->delete();
        return $this->sendResponse(null, "Timesheet deleted successfully.");
    }
}
