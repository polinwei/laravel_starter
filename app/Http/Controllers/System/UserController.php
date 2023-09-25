<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-action|user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    //
    /**
     * index
     * 顯示所有帳號
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request) {

        /** 以下使用 spatie/laravel-html tag */
        /**
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('system.users.index', compact('data'))
            ->with('i', ($request->input('page,1') - 1) * 5);
         */

        $data = User::all();
        return view('system.users.index', compact('data'));
    }

    public function create()
    {
        $permission = Permission::get();
        $roles = Role::pluck('name','name')->all();
        return view('system.users.create',compact('roles','permission'));

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('system.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('system.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
