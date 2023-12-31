<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginNeedsVerification;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function submit(Request $request)
    {

        // validate phone number
        $request->validate([
            'phone' => ['required', 'numeric', 'min:10']
        ]);



        // find or create a user model
        $user = User::firstOrCreate(
            [
                'phone' => $request->phone
            ]
        );

        // send the user a one time passcode

        if (!$user) {
            return response()->json(['message' => 'Could not process a user with the provided phone number  '], 401);
        }

        // send a one-time verfication
        $user->notify(new LoginNeedsVerification());


        // return back response
        return response()->json(['message' => 'Text message notification sent']);
    }


    public function verify(Request $request)
    {

        // return $request;

        // validate user request
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:111111,999999'
        ]);

        // find user
        $user = User::where('phone', $request->phone)->where('login_code', $request->login_code)->first();

        // is the code provided same as saved?
        // No, return error message
        if (!$user) {
            return response()->json(['message' => 'Invalid verification code'], 401);
        }

        // Yes, return back auth token

        // update login code
        $user->update(
            ['login_code' => null]
        );

        return $user->createToken($request->login_code)->plainTextToken;
    }
}
