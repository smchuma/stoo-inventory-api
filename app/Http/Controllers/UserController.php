<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            "first_name"=> "required|string|max:255",
            "last_name"=> "required|string|max:255",
            "email"=> "required|unique:suppliers,email",
            "password"=> "required",
           'phone_number' => [
                'required',
                'regex:/^0[67]\d{8}$/',
                'unique:suppliers,phone_number'
                ],
        ]);

        $user = User::create($fields);


        return [
            'message'=> 'User Created Successfully',
            'user'=> $user,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return $request->user();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        $fields = $request->validate([
            "first_name"=> "required|string|max:255",
            "last_name"=> "required|string|max:255",
            "password"=> "required",
            "role" => "required",
        ]);

        $user->update($fields);

        return response()->json([
            'message'=> 'User Updated Successfully',
            'user'=> $user,
        ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message'=> 'User Deleted Successfully'
            ]);
    }



    public function show_user( $id)
    {
        //
        $user = User::find($id);

        if ($user ) {
            return response()->json([
                'user'=> $user,
             ]);

        } else {

            return response()->json([
                'message'=> 'User Not Exist'
                ]);

        }


    }
}
