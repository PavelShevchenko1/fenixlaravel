<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FxAppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppUserController extends Controller
{
    public function app()
    {
        return response()->json(['success' => true], 200);
    }


    public function getUserProfile()
    {
        $profile = Session::user();


        if ($profile) {
            return response()->json($profile, 200);
        } else {
            return response()->json(['error' => 'Session not found'], 404);
        }
    }

    public function createProfile(Request $request)
    {
        $this->validate($request, [
            'session_id' => 'required|string',
            'gender' => 'required|string',
            'birth_date' => 'required|string',
            'fcm_token' => 'required|string',
            'platform' => 'required|string'
        ]);

        // check if app user with this session_id exists
        $user_exists = FxAppUser::where('session_id', $request->session_id)->exists();
        if ($user_exists) {
            return response()->json(FxAppUser::where('session_id', $request->session_id)->first(), 200);
        }

        $profile = FxAppUser::create($request->all());
        return response()->json($profile, 201);
    }

    public function updateUserProfile(Request $request)
    {
        $profile = Session::user();

        if ($profile) {
            $profile->update($request->all());
            return response()->json($profile, 200);
        } else {
            return response()->json(['error' => 'Session not found'], 404);
        }
    }

    public function setAsTester()
    {
        $profile = Session::user();

        FxAppUser::where('session_id', $profile->session_id)->update(['tester' => 1]);

        return response()->json(FxAppUser::where('session_id', $profile->session_id)->first(), 200);
    }
}
