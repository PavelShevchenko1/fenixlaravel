<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FxFcmNotificationAttempt;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function notifications(Request $request)
    {
        $time = $request->query('time');

        if ($time && !strtotime($time)) {
            return response()->json(['error' => 'Invalid time format'], 400);
        }
        $attempts = FxFcmNotificationAttempt::where('planned', '<=', $time)->where('status', 0)->get();

        $server_time = now();
        return response()->json(
            array(
                'server_time' => $server_time,
                'request_time' => $time,
                'attempts' => $attempts
            )
        );
    }

    public function notification(Request $request, $id)
    {
        $attempt = FxFcmNotificationAttempt::where('id', $id)->first();

        if ($attempt) {
            return response()->json($attempt->notification);
        } else {
            return response()->json(['error' => 'Notification not found'], 404);
        }
    }

    public function setSended(Request $request, $id)
    {
        $attempt = FxFcmNotificationAttempt::where('id', $id)->with('notification')->first();
        
        if (!$attempt) {
            return response()->json(['error' => 'Notification not found'], 404);
        }
        
        $attempt->sended = now();
        $attempt->status = 1;
        $attempt->save();
        return response()->json(array('status' => $attempt->status));
        
    }
}
