<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AdminAddUserRequest;
use App\Http\Requests\User\AdminEditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        return User::where('role_id', '!=', 4)->orderBy('id', 'DESC')->get();
    }
    public function store(AdminAddUserRequest $request)
    {
        $password = bcrypt($request->password);
        return User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $request->role_id,
        ]);
    }
    public function update(AdminEditUserRequest $request)
    {
        // $user = User::findOrFail($request->id);
        $data = [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];
        if ($request->password) {
            $password = bcrypt($request->password);
            $data['password'] = $password;
        }
        return User::where('id',$request->id)->update($data);
    }
}
