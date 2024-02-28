<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->allUsers();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->userRepository->destoryUser($id);
        return back()->with('deleted', 'User Deleted Successfully');
    }

    public function assignRoleIndex($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::all();
        return view('admin.users.assign-role', compact('user', 'roles'));
    }

    // public function search(Request $request, RoomTypeRepositoryInterface $roomTypeRepository)
    // {
    //     $searchData = '%' . $request->search . '%';
    //     $roomTypes = $roomTypeRepository->searchRoomType($searchData);
    //     return view('admin.roomtype.index', compact('roomTypes'));
    // }

    public function search(Request $request, UserRepositoryInterface $userRepository)
    {
        $searchData = '%' . $request->search . '%';
        $users = $userRepository->searchUser($searchData);
        return view('admin.users.index', compact('users'));
    }

    // public function assignRole(Request $request)
    // {
    //     $user = User::findOrFail($request->user_id);
    //     $user->syncRoles($request->role_ids);
    //     return view('admin/users')->with('success', 'Role Assigned!');
    // }
//     public function assignRole(Request $request)
// {
//     $user = User::findOrFail($request->user_id);

//     if (!$request->has('role_ids') || !is_array($request->role_ids)) {
//         return redirect('admin/users')->with('error', 'Invalid roles provided.');
//     }

//     // Convert roles to assign to an array
//     $rolesToAssign = Role::whereIn('id', $request->role_ids)->pluck('id')->toArray();

//     // If user has more than one role, remove all roles except the first one
//     if ($user->roles->count() > 1) {
//         // Remove the first role from the array (keep at least one role)
//         array_shift($rolesToAssign);
//         // Sync the roles
//         $user->syncRoles($rolesToAssign);
//     } else {
//         // If user has only one role, just assign the new roles
//         $user->syncRoles($rolesToAssign);
//     }

//     return redirect('admin/users')->with('success', 'Roles Assigned Successfully');
// }

// public function assignRole(Request $request)
// {
//     $user = User::findOrFail($request->user_id);

//     // Ensure that the role IDs are provided and are an array
//     if (!$request->has('role_ids') || !is_array($request->role_ids)) {
//         return redirect('admin/users')->with('error', 'Invalid roles provided.');
//     }

//     try {
//         // Begin a database transaction
//         DB::beginTransaction();

//         // Fetch roles only if the user is allowed to have these roles
//         $rolesToAssign = Role::whereIn('id', $request->role_ids)
//                              ->where('guard_name', 'web')
//                              ->get();

//         // Sync the roles with the user, removing any existing roles
//         $user->syncRoles($rolesToAssign);

//         // Commit the transaction
//         DB::commit();

//         return redirect('admin/users')->with('success', 'Roles Assigned Successfully');
//     } catch (\Exception $e) {
//         // If an exception occurs, rollback the transaction
//         DB::rollback();
//         return redirect('admin/users')->with('error', 'Failed to assign roles. Please try again.');
//     }
// }

    public function assignRole(Request $request)
    {
        // Retrieve the user based on the user_id from the request
        $user = User::findOrFail($request->user_id);

        // Retrieve the role IDs from the request
        $roleIds = $request->role_ids ?? []; // Use empty array if role_ids is null

        // Check if the user exists
        if (!$user) {
            return redirect('admin/users')->with('error', 'User not found.');
        }

        // Check if any role IDs were provided
        if (empty($roleIds)) {
            // If no role IDs were provided, remove all roles from the user
            $user->roles()->detach();
        } else {
            // Retrieve roles based on the role IDs
            $roles = Role::whereIn('id', $roleIds)->get();

            // Check if all role IDs were found
            if ($roles->count() !== count($roleIds)) {
                return redirect('admin/users')->with('error', 'One or more roles were not found.');
            }

            // Sync roles to the user
            $user->syncRoles($roles);
        }

        // Redirect back with a success message
        return redirect('admin/users')->with('success', 'Roles assigned successfully');
    }

}
