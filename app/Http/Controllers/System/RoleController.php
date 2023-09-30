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

    /**
     * __construct
     * 權限設定
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:role-action|role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * index
     * 顯示所有資料
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        //$roles = Role::orderBy('id','DESC')->paginate(5);
        //return view('system.roles.index',compact('roles'))
        //    ->with('i', ($request->input('page', 1) - 1) * 5);
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('system.roles.index', compact('roles'));
    }

    /**
     * create
     * 建立資料前的資料準備
     * @return void
     */
    public function create()
    {
        $role = Role::class;
        $permission = Permission::get();
        return view('system.roles.create', compact('role','permission'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }

    /**
     * show
     * 顯示單筆資料
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join('role_has_permissions','role_has_permissions.permission_id', '=', 'permissions.id')
            ->where('role_has_permissions.role_id', $id)
            ->get();

        return view('system.roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * edit
     * 編輯資料
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('system.roles.edit',compact('role','permission','rolePermissions'));
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
            'name'=>'required',
            'permission' => 'required'
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    /**
     * destroy
     * 刪除單筆資料
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        DB::table('roles')->where('id', $id)->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
    }


}
