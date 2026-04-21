<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::latest()->get(); // fetch all users
        return view('pages.admin.users.index', compact('users'));
    }
    
    public function create()
    {

        return view('pages.admin.users.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        'phone' => $request->phone,
        'address' => $request->address,
        'is_active' => $request->is_active,
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('pages.admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'phone' => $request->phone,
        'address' => $request->address,
        'is_active' => $request->is_active,
    ]);

    // update password only if entered
    if ($request->filled('password')) {
        $user->update([
            'password' => bcrypt($request->password)
        ]);
    }

    return redirect()->route('users.index')->with('success', 'User updated successfully');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->back()->with('success', 'User deleted successfully');
}
}
