<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class GradeController extends Controller
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
        $query = Grade::query();
        if (request('first_name')) {
            $query->whereHas('student', function ($query) {
                $query->where('first_name', 'like', '%' . request('first_name') . '%');
            });
        }
        if (request('last_name')) {
            $query->whereHas('student', function ($query) {
                $query->where('last_name', 'like', '%' . request('last_name') . '%');
            });
        }
        if (request('subject')) {
            $query->where('subject', 'like', '%' . request('subject') . '%');
        }
        if (request('start_date')) {
            $query->where('created_at', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $query->where('created_at', '<=', request('end_date'));
        }
        $grades = $query->paginate();
        return view('admin.grades.index', compact('grades'));
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
        $students = Student::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.grades.create', compact('students', 'teachers'));
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
            'student_id' => 'required|exists:students,id',
            'comment' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255|min:3',
            'score' => 'required|numeric|min:0|max:100',
        ]);
        Grade::create($validatedData);
        return redirect()->route('admin.grades.index')->with('success', 'Grade created successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $students = Student::paginate(10);
        return view('admin.grades.edit', compact('grade', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'comment' => 'nullable|string',
            'subject' => 'required|string',
            'score' => 'required|numeric|min:0|max:100',
        ]);
        $grade->update($validatedData);
        return redirect()->route('admin.grades.index')->with('success', 'Grade updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $grade->delete();
        return redirect()->route('admin.grades.index')->with('success', 'Grade deleted successfully');
    }
}
