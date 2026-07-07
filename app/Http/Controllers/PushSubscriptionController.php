<?php

namespace App\Http\Controllers;

use App\Models\PushSubscibe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PushSubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'endpoint'    => ['required', 'string'],
            'keys.p256dh' => ['required', 'string'],
            'keys.auth'   => ['required', 'string'],
        ]);

        PushSubscibe::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'endpoint' => $request->endpoint
            ],

            [
                'device_id' => $request->device_id,
                'public_key' => $request->input('keys.p256dh'),
                'auth_token' => $request->input('keys.auth'),
                'device_name' => $request->device_name,
                'browser' => $request->browser,
                'platform' => $request->platform,
                'user_agent' => $request->user_agent,
                'is_active' => true,
                'last_used_at' => now(),
                // reset ketika subscribe baru
                'last_push_status' => null,
                'last_push_error' => null,
                'push_fail_count'  => 0,
            ]
        );

        return response()->json([
            'success' => true
        ]);
    }
}
