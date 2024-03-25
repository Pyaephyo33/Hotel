<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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
        $this->middleware(function($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            } 
            if (session('updated')) {
                Alert::success(session('updated'));
            }
            if (session('error')) {
                Alert::error(session('error'));
            }
            if (session('toggled')) {
                Alert::success(session('toggled'));
            }
            if (session('deleted')) {
                Alert::success(session('deleted'));
            }
            return $next($request);
        });
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

    public function assignPermission(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        if (empty($request->permission_ids)) {
            $role->syncPermissions([]);
            session()->flash('success', 'No Permission Assign to the role');
            return redirect('admin/roles');
        }

        $permissions = Permission::whereIn('id', $request->permission_ids)->get();

        if ($permissions->count() !== count($request->permission_ids)) {
            session()->flash('error', 'One or more permissions were not found');
            return redirect('admin/roles');
        }

        // Sync permissions to the role
        $role->syncPermissions($permissions);
        session()->flash('success', 'Permission assigned successfully');
        return redirect('admin/roles');
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
        session()->flash('success', 'Successfully Created!');
        return redirect('admin/roles');
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
        session()->flash('updated', 'Successfully Updated!');
        return redirect('admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        session()->flash('deleted', 'Successfully Deleted');
        return back();
    }

    public function search(Request $request)
    {
        $searchData = "%" . $request->search . "%";
        $roles = Role::where('name', 'like', $searchData)->get();
        $permissions = Permission::all();
        return view('admin.role.index', compact('roles', 'permissions'));
    }
}
