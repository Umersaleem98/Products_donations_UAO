<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Exports\UsersSelectedExport;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminUserController extends Controller
{
    public function index(Request $request)
{
    $perPage = $request->get('per_page', 10); // default 10
    $search = $request->get('search');

    $users = User::query()

        // 🔍 SEARCH
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('qalam_id', 'like', "%{$search}%");
        })

        ->latest()
        ->paginate($perPage)
        ->withQueryString(); // keep params in pagination

    return view('pages.admin.users.index', compact('users', 'perPage', 'search'));
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();

            // Save in: public/admin/asset/profilephoto
            $request->image->move(public_path('admin/asset/profilephoto'), $imageName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'qalam_id' => $request->qalam_id,
            'image' => $imageName, // only filename saved
        ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('pages.admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // IMAGE UPDATE
        if ($request->hasFile('image')) {

            // Delete old image
            if ($user->image && file_exists(public_path('admin/asset/profilephoto/'.$user->image))) {
                unlink(public_path('admin/asset/profilephoto/'.$user->image));
            }

            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('admin/asset/profilephoto'), $imageName);

            $user->image = $imageName;
        }

        // BASIC FIELDS
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->qalam_id = $request->qalam_id;

        // PASSWORD (only if filled)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete profile image if exists
        if ($user->image && file_exists(public_path('admin/asset/profilephoto/'.$user->image))) {
            unlink(public_path('admin/asset/profilephoto/'.$user->image));
        }

        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'User deleted successfully');
    }


    public function deleteSelected(Request $request)
{
    if (!$request->ids) {
        return back()->with('error', 'No users selected');
    }

    User::whereIn('id', $request->ids)->delete();

    return back()->with('success', 'Selected users deleted successfully');
}



   // IMPORT
    public function importUsers(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return back()->with('success', 'Users imported successfully!');
    }

    // EXPORT ALL
    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    // EXPORT SELECTED
    public function exportSelected(Request $request)
    {
        $ids = $request->ids;

        if (!$ids) {
            return back()->with('error', 'Please select at least one user.');
        }

        return Excel::download(new UsersSelectedExport($ids), 'selected_users.xlsx');
    }
}
