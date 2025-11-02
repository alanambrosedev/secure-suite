<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();

        $user->password = Hash::make($request->password);
        $user->save();

        // Invalidate other sessions (keep current)
        Auth::logoutOtherDevices($request->password);

        // If you use Sanctum personal access tokens and want to revoke them:
        // $user->tokens()->delete(); // uncomment if desired to revoke tokens too

        return response()->json(['status' => 'Password updated; other sessions invalidated.']);
    }
}
