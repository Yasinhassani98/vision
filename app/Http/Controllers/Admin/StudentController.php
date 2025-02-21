<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Level;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class StudentController extends Controller
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
        $query = Student::query();

        if ($first_name = request('first_name')) {
            $query->where('first_name', 'like', "%{$first_name}%");
        }

        if ($last_name = request('last_name')) {
            $query->where('last_name', 'like', "%{$last_name}%");
        }

        if ($level = request('level_id')) {
            $query->where('level_id', $level);
        }

        if ($gender = request('gender')) {
            $query->where('gender', $gender);
        }

        if ($address = request('address')) {
            $query->where('address', 'like', "%{$address}%");
        }

        if ($start_date = request('start_date')) {
            $query->where('created_at', '>=', $start_date);
        }

        if ($end_date = request('end_date')) {
            $query->where('created_at', '<=', $end_date);
        }

        $students = $query->paginate();
        $levels = Level::all();
        return view('admin.students.index', compact('students', 'levels'));
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
        $parents = User::where('role', 'parent')->get();
        $supervisors = User::where('role', 'supervisor')->get();
        return view('admin.students.create', compact('levels', 'parents', 'supervisors'));
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
            'first_name' => 'required|string|max:255|min:3',
            'last_name' => 'required|string|max:255|min:3',
            'level_id' => 'required|exists:levels,id',
            'parent_id' => 'required|exists:users,id',
            'supervisor_id' => 'required|exists:users,id',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255|min:3',
            'phone' => 'nullable|string|max:255|min:3',
            'image' => 'nullable|image',
            'DOB' => 'required|date',
            'bio' => 'required|string|max:500|min:10',
        ]);

        Student::create($request->all());

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $student = Student::with('teachers')->findOrFail($student->id);
        $comments = Comment::where('student_id', $student->id)->get();
        return view('admin.students.show', compact('student', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $levels = Level::all();
        $parents = User::where('role', 'parent')->get();
        $supervisors = User::where('role', 'supervisor')->get();
        return view('admin.students.edit', compact('student', 'levels', 'parents', 'supervisors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $request->validate([
            'first_name' => 'required|string|max:255|min:3',
            'last_name' => 'required|string|max:255|min:3',
            'level_id' => 'required|exists:levels,id',
            'parent_id' => 'required|exists:users,id',
            'supervisor_id' => 'required|exists:users,id',
            'gender' => 'required|in:male,female',
            'address' => 'required|string|max:255|min:3',
            'phone' => 'nullable|string|max:255|min:3',
            'image' => 'nullable|image',
            'DOB' => 'required|date',
            'bio' => 'required|string|max:500|min:10',
        ]);

        $student->update($request->all());

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $student->delete();

        return redirect()->route('admin.students.index')
                         ->with('success', 'Student deleted successfully.');
    }
}
