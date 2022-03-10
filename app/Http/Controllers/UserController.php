<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:255|string',
            'username' =>  'required|max:255|string|unique:users,username',
            'email' =>  'required|max:255|email|unique:users,email',
            'gender' => 'required|string',
            'password' => 'required|min:8|max:255|confirmed',
            'phoneNumber' => 'required|numeric|unique:users,phoneNumber',
            'address' => 'required',
            'dateOfBirth' => 'required|date',
        ]);
        User::create([
            'fullname' => $request->fullname,
            'username' =>  $request->username,
            'email' =>  $request->email,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'dateOfBirth' => $request->dateOfBirth,
        ]);
        return response([ 'message ' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'fullname' => 'required|max:255|string',
            'username' =>  'required|max:255|string',
            'email' =>  'required|max:255|email',
            'gender' => 'required|string',
            'phoneNumber' => 'required|numeric',
            'address' => 'required|string',
            'dateOfBirth' => 'required|date',
        ]);

        $user = User::find($id);

        if($user) {
            $user->update($request->all());
            return response(['message' => 'the user updated successfully']);
        }
        return response(['error' => 'non user founded'] , 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return response(['message' => 'the user deleted successfully'] );
    }
}
 