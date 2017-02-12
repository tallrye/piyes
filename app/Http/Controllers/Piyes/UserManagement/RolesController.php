<?php

namespace App\Http\Controllers\Piyes\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Piyes\BaseController;
use App\Models\Piyes\User\Role;
use App\Models\Piyes\User\Permission;

class RolesController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the listing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        checkPermissionFor('manage_roles');
        $roles = Role::all();
        return view('piyes.user-management.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        checkPermissionFor('manage_roles');
        return view('piyes.user-management.roles.create');
    }

    /**
     * Store new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        checkPermissionFor('manage_roles');
        $this->validate($request, Role::$rules);
        Role::create($request->all());
        session()->flash('success', 'New role has been created.');
        return redirect()->route('piyes.user-management.roles.index');
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        checkPermissionFor('manage_roles');
        $permissions = Permission::pluck('name','id')->all();
        return view('piyes.user-management.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        checkPermissionFor('manage_roles');
        $role->permissions()->sync($request->permission_list ?: []);
        $role->update($request->all());
        session()->flash('success', 'Role has been updated.');
        return redirect()->back();
    }

    /**
     * Delete existing record
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Role $role)
    {
        checkPermissionFor('manage_roles');
        $role->delete();
        session()->flash('success', 'Role deleted');
        return redirect()->route('piyes.user-management.roles.index');
    }

}
