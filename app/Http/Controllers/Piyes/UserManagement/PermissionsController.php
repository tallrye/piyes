<?php

namespace App\Http\Controllers\Piyes\UserManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Piyes\BaseController;
use App\Models\Piyes\User\Permission;

class PermissionsController extends BaseController
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
        checkPermissionFor('manage_permissions');
        $permissions = Permission::all();
        return view('piyes.user-management.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        checkPermissionFor('manage_permissions');
        return view('piyes.user-management.permissions.create');
    }

    /**
     * Store new record.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        checkPermissionFor('manage_permissions');
        $this->validate($request, Permission::$rules);
        Permission::create($request->all());
        session()->flash('success', 'New permission has been created.');
        return redirect()->route('piyes.user-management.permissions.index');
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        checkPermissionFor('manage_permissions');
        return view('piyes.user-management.permissions.edit', compact('permission'));
    }

    /**
     * Edit existing record.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        checkPermissionFor('manage_permissions');
        $permission->update($request->all());
        session()->flash('success', 'Permission has been updated.');
        return redirect()->back();
    }

    /**
     * Delete existing record
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Permission $permission)
    {
        checkPermissionFor('manage_permissions');
        $permission->delete();
        session()->flash('success', 'Permission deleted');
        return redirect()->route('piyes.user-management.permissions.index');
    }

}
