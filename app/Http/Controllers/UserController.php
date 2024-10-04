<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::filter($request->only([
            'first_name',
            'last_name',
            'birth_date',
            'gender',
        ]))->get();
        return $this->sendResponse(
            $users,
            "users retrieved successfully."
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:' . User::class,
            'password' => ['required', 'string', Password::defaults()],
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = User::create($request->all());

        return $this->sendResponse($user, 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->sendResponse($user, "User retrieved successfully.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'email' => 'email|string|max:255|unique:' . User::class,
            'birth_date' => 'date',
            'gender' => 'string|max:255',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = User::findOrFail($request->all()['id']);
        $user->update($request->all());
        return $this->sendResponse($user, "User updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        User::findOrFail($request->all()['id'])->delete();
        return $this->sendResponse(null, "User deleted successfully.");
    }
}
