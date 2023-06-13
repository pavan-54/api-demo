<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        else{
            $user = auth()->user();
            $user->tokens()->delete();
            $token = $user->createToken('admin')->plainTextToken;
            return response()->json([
                'token' => $token,
                'token-description' => 'Bearer token and use this token in Authorization header',
                'message' => 'Login successful',
                'user Details'=> User::find($user->id)
            ]);
        }
    } 
    

    public function register(Request $request){
       $request->validate([
            'invitation_id' => 'required',
            'password' => 'required'
        ]);

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

        return response()->json(
            
            [
                'message' => 'Logout successful',
            ]
        );
    }

    public function edit(Request $request)
    {
        $user = $request->user();

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $path = $file->store('profile_img', 'public');

            // Update the user's profile picture URL in the database
            $user->profile_img = url(Storage::url($path));

            $user->update([$request->all(), 'profile_img' => $user->profile_img]);
            
        }
        else{
            $user->update($request->all());
        }

        //delete all tokens
        $user->tokens()->delete();


        return response()->json(
            [
                'message' => 'User updated successfully',
                'authorization message' => 'all tokens have been revoked for security feautures'
            ]
        );
    }
}
