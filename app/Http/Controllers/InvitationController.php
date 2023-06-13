<?php

namespace App\Http\Controllers;
use App\Models\Invitation;

use Illuminate\Http\Request;

class InvitationController extends Controller
{
    //@param Name
    //@param Email
    //@param Phone number
    //@param Alternate email id (optional)
    //@param Organizations (optional)
        //@param Organization name
        //@param Role in organization
        //@param Valid till (date)
    public function invite(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'alternate_email' => 'nullable|email',
            'organization_name'=> 'nullable|string',
            'organization_role'=> 'nullable|string',
            'valid_till'=> 'nullable|date',
        ]);
        $invitation = Invitation::create($data);

        if($invitation){
            return response()->json([
                'message' => 'Invitation sent successfully',
                'invitation_id' => $invitation->id,
            ]);
        }
        else{
            return response()->json([
                'message' => 'Invitation failed',
            ]);
        }

        
    }
}
