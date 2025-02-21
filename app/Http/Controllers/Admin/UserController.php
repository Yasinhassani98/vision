<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $query = User::query();

        if ($name = request('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($role = request('role')) {
            $query->where('role', $role);
        }

        if ($gender = request('gender')) {
            $query->where('gender', $gender);
        }

        $users = $query->paginate();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $levels = Level::all();
        return view('admin.users.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8|max:255',
            'role' => 'required|in:admin,parent,transport manager,teacher,supervisor',
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|string|max:255|min:3',
            'address' => 'nullable|string|max:255|min:3',
            'DOB' => 'nullable|date',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);
        if ($request->role == 'teacher') {
            $request->validate([
                'level_ids' => 'required|string',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'DOB' => $request->DOB,
            'image' => $request->image,
            'status' => $request->status,
        ]);
        if ($request->role == 'teacher') {
            $level_ids = explode(',', $request->level_ids);
            $user->levels()->attach($level_ids);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $levels = Level::all();
        return view('admin.users.edit', compact('user', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8|max:255',
            'role' => 'required|in:admin,parent,driver,transport manager,teacher,supervisor',
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|string|max:255|min:3',
            'address' => 'nullable|string|max:255|min:3',
            'DOB' => 'nullable|date',
            'image' => 'nullable|image',
            'status' => 'required|in:active,inactive',
        ]);
        if ($request->role == 'teacher') {
            $request->validate([
                'level_ids' => 'required|string',
            ]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'DOB' => $request->DOB,
            'image' => $request->image,
            'status' => $request->status,
        ]);
        if ($request->role == 'teacher') {
            $level_ids = json_decode($request->level_ids);
            $level_ids = collect($level_ids)->pluck('value')->toArray();
            $user->levels()->sync($level_ids);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
