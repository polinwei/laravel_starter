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
    /**
     * __construct
     * 權限設定
     * @return void
     */
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
     * 顯示所有資料
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

        $users = User::all();
        return view('system.users.index', compact('users'));
    }

    /**
     * create
     * 建立資料前的資料準備
     * @return void
     */
    public function create()
    {
        $permission = Permission::get();
        $roles = Role::pluck('name','name')->all();
        return view('system.users.create',compact('roles','permission'));

    }

    /**
     * store
     * 儲存資料
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['is_email_verified'] = true;
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('success', '帳號建立成功');
    }

    /**
     * show
     * 顯示單筆資料
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('system.users.show', compact('user'));
    }

    /**
     * edit
     * 編輯資料
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('system.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * update
     * 更新資料
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * destroy
     * 刪除單筆資料
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
