<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function create()
{
    return view('admin.create'); // Créez cette vue
}

public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
    ]);

    User::create([
        'name' => 'Admin', // Adaptez selon besoin
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'admin',
    ]);

    return redirect()->route('admin.dashboard');
}
}
