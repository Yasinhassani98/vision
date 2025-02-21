<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class ScheduleController extends Controller
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
        $schedules = Schedule::query();
        if (request('level_id')) {
            $schedules->where('level_id', request('level_id'));
        }
        if (request('type')) {
            $schedules->where('type', request('type'));
        }
        if (request('start_date')) {
            $schedules->where('start_time', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $schedules->where('end_time', '<=', request('end_date'));
        }
        $schedules = $schedules->get();
        return view('admin.schedules.index', compact('schedules', 'levels'));
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
        return view('admin.schedules.create', compact('levels'));
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'level_id' => 'required|exists:levels,id',
            'type' => 'required|in:exam,activity,daily',
            'description' => 'required|string|min:3|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        Schedule::create($validatedData);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        return view('admin.schedules.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $levels = Level::all();
        return view('admin.schedules.edit', compact('schedule', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $validatedData = $request->validate([
            'title' => 'required|string|max:255|min:3',
            'level_id' => 'required|exists:levels,id',
            'type' => 'required|in:exam,activity,daily',
            'description' => 'required|string|min:3|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $schedule->update($validatedData);

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $schedule->delete();

        return redirect()->route('admin.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
