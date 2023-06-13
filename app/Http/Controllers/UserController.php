<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //check if user exists
        // $user = User::where('email', $request->email)->first();
        // if(!$user){
        //     return response()->json([
        //         'message' => 'User does not exist'
        //     ], 401);
        // }
        // else{
        //     $password = hash('sha256', $request->password);
        //     if($user->password != $password){
        //         return response()->json([
        //             'message' => 'Invalid credentials'
        //         ], 401);
        //     }
            
        //     else{
        //         $token = $user->createToken('admin')->plainTextToken;
        //         return response()->json([
        //             'token' => $token,
        //             'message' => 'Login successful'
        //         ]);
        //     }
        // }


        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        else{
            $user = auth()->user();
            $token = $user->createToken('admin')->plainTextToken;
            return response()->json([
                'token' => $token,
                'message' => 'Login successful'
            ]);
        }
    } 
    

    public function register(Request $request){
       $request->validate([
            'invitation_id' => 'required',
            'password' => 'required'
        ]);


        // return response()->json([
        //     'message' => $request->password
        // ]);
    
        //$password = hash('sha256', $request->password);
        $password = $request->password;


        $invitation = Invitation::find($request->invitation_id);

        User :: create([
            'name' => $invitation->name,
            'email' => $invitation->email,
            'password' => $password,
            'phone_number' => $invitation->phone_number,
            'alternate_email' => $invitation->alternate_email,
            'organization_name' => $invitation->organization_name,
            'organization_role' => $invitation->organization_role,
            'valid_till' => $invitation->valid_till,
        ]);

        return response()->json([
            'message' => 'User created successfully',
        ]);
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful']);
    }

    public function test_auth(Request $request){
        return response()->json([
            'message' => 'Authenticated',
        ]);
    }
}
