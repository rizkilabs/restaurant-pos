<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // public function create()
    // {
    //     return view('users.create');
    // }

    public function create()
    {
        return view('users.create', [
            'action' => route('users.store'),  // ARAHKAN ke store()
            'method' => 'POST',
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:superadmin,kasir,pimpinan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // public function edit(User $user)
    // {
    //     return view('users.edit', compact('user'));
    // }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'action' => route('users.update', $user->id),  // ARAHKAN ke update()
            'method' => 'PUT',
        ]);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:superadmin,kasir,pimpinan',
        ]);

        $data = $request->only('name', 'email', '', 'password' . 'role');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
