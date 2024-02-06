<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
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

    public function assignRole(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->syncRoles($request->role_ids);
        return view('admin/users')->with('success', 'Role Assigned!');
    }
}
