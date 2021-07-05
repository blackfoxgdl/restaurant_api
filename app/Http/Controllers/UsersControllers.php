<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsersControllers extends Controller
{
    //
    public function index() {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Create Users
     */
    public function store(Request $request) {
        try {
            // Validate
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email'
            ]);

            if (!$validate->fails()) {
                $user = $request->all();        
                $userdata = User::create($user);

                return response()->json([
                    'message' => 'The account has been created successfully!',
                    'id' => $userdata->id,
                    'email' => $userdata->email,
                    'name' => $userdata->name
                ]);
            }

            return response()->json([
                'error' => 'Error with some fields. The account was not created!',
                'message' => $validate->errors()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error with the request!',
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show single user
     */
    public function show($id) {
        try {
            $user = User::findOrFail($id);
            
            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'id'    => $user->id
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'error' => 'Invalid value',
                'message' => 'The user does not exists!'
            ]);
        }
    }

    public function update(Request $request, $id) {
        // TODO
    }

    public function delete($id) {
        // TODO
    }
}
