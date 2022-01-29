<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() && $request->path() != 'login') {
            return redirect('/login');
        }

        if (!Auth::check() && $request->path() == 'login') {

            return view('welcome');
        }
        // you are already logged in... so check for if you are an admin user..
        $user = Auth::user();
        if ($user->userType == 'user') {
            return redirect('/login');
        }
        if ($request->path() == 'login') {
            return redirect('/');
        }
        return $this->checkForPermission($user, $request);
        // return view('404');
        // return view('welcome');
    }
    public function checkForPermission($user, $request)
    {
        $permissions = json_decode($user->role->permission);
        $hasPermission = false;
        if (!$permissions) {
            return view('welcome');
        }
        foreach ($permissions as $p) {
            if ($p->name == $request->path()) {
                if ($p->read) {
                    $hasPermission = true;
                }
            }
        }
        if ($hasPermission) return view('welcome');
        // return view('welcome');
        return view('404');
    }
}
