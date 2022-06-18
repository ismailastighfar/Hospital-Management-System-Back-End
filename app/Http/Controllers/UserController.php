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
            'username' =>  'required|max:255|string|unique:users,username',
            'email' =>  'required|max:255|email|unique:users,email',
            'gender' => 'required|string',
            'password' => 'required|string|min:8|max:16|confirmed',
            'role' => 'integer'
        ]);
        User::create([
                
            'username' =>  $request->username,
            'email' =>  $request->email,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        
        ]);

        $user = User::all()->last();
        if( $user->role == 1){
            $token = $user->createToken('logintoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response(['user' => $response ]);
        }else{
            return response([
                'message ' => 'success',
                'user' => $user
        ]);
        }


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

        if( auth()->user()->id == $id || auth()->user()->role == 0){
            $request->validate([
                'username' =>  'required|max:255|string',
                'email' =>  'required|max:255|email',
            ]);

            $user = User::find($id);

            if($user) {
                $user->update($request->all());
                return response(['message' => 'the user updated successfully'], 200);
            }
            return response(['error' => 'non user founded'] , 404);
        }
        return response(['message' => 'you are not authorized to do this oparation'], 405);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function destroy(User $user){
        if( auth()->user()->id == $user->id || auth()->user()->role == 0){
            User::find($user->id)->delete();
            return response(['message' => 'the user deleted successfully'] );
        }
        else{
            return response(['message' => 'you are not authorized to do this oparation'], 405);
        }
    }
}
 