<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class LevelController extends Controller
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
        $levels = Level::all();
        return view('admin.levels.index', compact('levels'));
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
        return view('admin.levels.create');
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
            'grade_level' => 'required|integer|min:1|max:12|unique:levels,grade_level',
        ]);
        Level::create($request->only('grade_level'));
        return redirect()->route('admin.levels.index')->with('success', 'Level created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        return view('admin.levels.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $request->validate([
            'grade_level' => 'required|integer|min:1|max:12|unique:levels,grade_level,' . $level->id,
        ]);

        $level->update($request->only('grade_level'));

        return redirect()->route('admin.levels.index')->with('success', 'Level updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $level->delete();

        return redirect()->route('admin.levels.index')->with('success', 'Level deleted successfully');
    }
}
