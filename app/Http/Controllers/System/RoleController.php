<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('permission:role-action|role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //$roles = Role::orderBy('id','DESC')->paginate(5);
        //return view('system.roles.index',compact('roles'))
        //    ->with('i', ($request->input('page', 1) - 1) * 5);
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('system.roles.index', compact('roles'));
    }

    public function show($id)
    {
        $role = Role::find($id);
        return view('system.roles.show', compact('role'));
    }
}
