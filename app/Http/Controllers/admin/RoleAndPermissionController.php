<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\{Permission, Role};

class RoleAndPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use HasRoles;

    public function __construct()
    {
        // $this->middleware(['permission:all-menu|user-setting']);
    }
    ## role index
    public function roleIndex()
    {
        $roles = Role::get();
        return view('admin.role.index', compact('roles'));
    }

    ## permission index
    public function permissionIndex()
    {
        // 
    }

    ## assign permission index
    public function assignPermissionIndex($roleId)
    {
        $permissions = Permission::all();
        $role = Role::findOrFail($roleId);
        return view('admin.role.assign-role', compact('role', 'permissions'));
    }

    ## assign permission to role
    // public function assignPermission(Request $request)
    // {

    //     $role = Role::findOrFail($request->role_id);

    //     if (!$request->has('permission_ids') || !is_array($request->permission_ids)) {
    //         return redirect('admin/roles')->with('error', 'Invalid permissions provided.');
    //     }
    //     $permissions = Permission::whereIn('id', $request->permission_ids)->get();

    //     if ($permissions->count() !== count($request->permission_ids)) {
    //         return redirect('admin/roles')->with('error', 'Invalid permission IDs provided.');
    //     }

    //     // Sync the permissions with the role
    //     $role->syncPermissions($permissions);

    //     return redirect('admin/roles')->with('success', 'Permissions assigned successfully.');
    // }

    public function assignPermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        if (!$request->has('permission_ids') || !is_array($request->permission_ids)) {
            return redirect('admin/roles')->with('error', 'Invalid permissions provided.');
        }

        // Fetch permissions from the provided IDs
        $permissionsToAssign = Permission::whereIn('id', $request->permission_ids)->get();

        // Filter out permissions that are already assigned to the role
        $permissionsToAssign = $permissionsToAssign->reject(function ($permission) use ($role) {
            return $role->hasPermissionTo($permission);
        });

        // Sync the permissions with the role
        $role->syncPermissions($permissionsToAssign);

        return redirect('admin/roles')->with('success', 'Permissions assigned successfully.');
    }

    
    ## role create 
    public function create()
    {
        $permissions = Permission::all();
        $role = new Role();
        return view('admin.role.form',compact('permissions', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Role::create([
            'name' => $request->name,
        ]);
        return redirect('admin/roles')->with('success', 'Successfully Created!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        // $roles = Role::paginate('10');
        $roles = Role::get();
        $permissions = Permission::all();
        return view('admin.role.form', compact('role', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = $request->validate([
            'name' => 'required',
        ]);
        Role::findOrFail($id)->update($role);
        return redirect('admin/roles')->with('updated', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return back()->with('deleted', 'Successfully Deleted!');
    }

    public function search(Request $request)
    {
        $searchData = "%" . $request->search . "%";
        $roles = Role::where('name', 'like', $searchData)->get();
        $permissions = Permission::all();
        return view('admin.role.index', compact('roles', 'permissions'));
    }
}
