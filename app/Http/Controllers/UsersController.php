<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class UsersController extends Controller
{
    use HasRoles;
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.users.form', compact('roles'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);
    
        $validatedData['password'] = Hash::make($validatedData['password']);
    
        $user = User::create($validatedData);
    
        if (!empty($validatedData['roles'])) {
            foreach ($validatedData['roles'] as $roleId) {
                $role = Role::findById($roleId);
                if ($role) {
                    $user->roles()->attach($role->id);
                }
            }
        }
    
        return redirect('admin/users')->with('success', 'User added successfully.');
    }
    

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id');
        $selectedRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.form', compact('user', 'roles', 'selectedRoles'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'sometimes|string|min:8|confirmed',
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id',
    ]);

    if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }

    $user->update($validatedData);

    // Sync roles
    $user->roles()->sync($validatedData['roles'] ?? []);

    return redirect('admin/users')->with('success', 'User updated successfully.');
}


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('admin/users')->with('success', 'User deleted successfully.');
    }
}
