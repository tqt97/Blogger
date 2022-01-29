<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    public function index()
    {
        return Role::orderBy('id', 'desc')->get();
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'roleName' => 'required|unique:roles,roleName',
        ]);
        return  Role::create([
            'roleName' => $request->roleName
        ]);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'roleName' => 'required|unique:roles,roleName,' . $request->id,
        ]);
        Role::where('id', $request->id)->update([
            'roleName' => $request->roleName
        ]);
        return  response()->json([
            'roleName' => $request->roleName
        ]);
    }
    public function delete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        return  Role::where('id', $request->id)->delete();
    }
    public function assign(Request $request)
    {
        $this->validate($request, [
            'permission' => 'required',
            'id' => 'required',
        ]);
        return Role::where('id', $request->id)->update([
            'permission' => $request->permission,
        ]);
    }
}
