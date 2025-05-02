<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryManager;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Routing\Controller as BaseController;

class LibraryManagerController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $managers = User::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('managers.index', compact('managers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $manager = new User();
        return view('managers.create', compact('manager'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,library_manager,user',
            'telephone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'date_embauche' => 'required|date',
            'affiliation' => 'nullable|in:professor,student,extern',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'affiliation' => $request->affiliation,
            'telephone' => $request->telephone,
            'department' => $request->department,
            'date_embauche' => $request->date_embauche
        ]);

        return redirect()->route('admin.managers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $manager)
    {

        return view('managers.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $manager)
    {
        return view('managers.edit', compact('manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $manager)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($manager->id)
            ],
            'role' => 'required|in:admin,library_manager,user',
            'telephone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'date_embauche' => 'required|date',
            'affiliation' => 'nullable|in:professor,student,extern',
        ]);

        $manager->update($request->only([
            'name',
            'email',
            'role',
            'telephone',
            'department',
            'date_embauche',
            'affiliation'
        ]));

        return redirect()->route('admin.managers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $manager)
    {
        $manager->delete();
        return redirect()->route('admin.managers.index');
    }
}
