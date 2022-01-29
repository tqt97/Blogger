<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role->isAdmin == 0) {
                Auth::logout();
                return response()->json([
                    'msg' => 'User does not allow to access 💥💥💥'
                ], 401);
            }
            return response()->json([
                'msg' => 'You are logged in successfully 🎉🎉🎉',
                'user' => $user
            ]);
        } else {
            return response()->json([
                'msg' => 'Log in error 💥💥💥'
            ], 401);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
