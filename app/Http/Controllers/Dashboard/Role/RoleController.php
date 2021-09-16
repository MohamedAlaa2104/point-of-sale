<?php

namespace App\Http\Controllers\Dashboard\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['hasAnyPermission']);
        $this->middleware(['can:read roles'])->only(['index']);
        $this->middleware(['can:create roles'])->only(['store']);
        $this->middleware(['can:edit roles'])->only(['update']);
        $this->middleware(['can:delete roles'])->only(['destroy']);
    }

    public function index()
    {
        return view('dashboard.roles.index')->with(['roles'=>Role::where('name', '!=', 'Super Admin')->withCount('users')->oldest()->get()]);
    }

    public function create()
    {
        return view('dashboard.roles.create')->with(['permissions'=>Permission::orderBy('id','asc')->pluck('name','id')]);
    }

    public function edit(Role $role)
    {
        return view('dashboard.roles.edit')->with(['role'=>$role, 'permissions'=>Permission::orderBy('id','asc')->pluck('name','id')]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('dashboard.roles.index');

    }

    public function update(Request $request, Role $role)
    {
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('dashboard.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', 'true');
    }
}
