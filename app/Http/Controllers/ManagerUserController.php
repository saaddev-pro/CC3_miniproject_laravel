<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManagerUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:library_manager']);
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::regularUsers()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('manager.users.index', compact('users', 'search'));
    }

    public function create()
    {
        return view('manager.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'required|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('manager.users.index')->with('success', 'User created successfully');
    }
}