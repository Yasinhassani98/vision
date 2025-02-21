<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class CommentController extends Controller
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
        $query = Comment::query()->orderBy('created_at', 'desc');

        if ($student_name = request('student_name')) {
            $query->whereHas('student', function ($query) use ($student_name) {
                $query->where('first_name', 'like', '%' . $student_name . '%');
            });
            $query->whereHas('student', function ($query) use ($student_name) {
                $query->where('last_name', 'like', '%' . $student_name . '%');
            });
            
        }
        if ($teacher_name = request('teacher_name')) {
            $query->whereHas('teacher', function ($query) use ($teacher_name) {
                $query->where('name', 'like', '%' . $teacher_name . '%');
            });
        }
        if ($comment = request('comment')) {
            $query->where('comment', 'like', '%' . $comment . '%');
        }
        $comments = $query->with('student', 'teacher')->paginate();
        return view('admin.comments.index', compact('comments'));
    }

    public function create(){
        $students = Student::all();
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.comments.create', compact('students', 'teachers'));      
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
        $teacher_id = auth()->user()->id;
        $request->merge(['teacher_id' => $teacher_id]);
        $request->validate([
            'comment' => 'required|string|max:255|min:3',
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Comment::create($request->all());

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comment created successfully.');
    }
    public function profileComment(Request $request)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $teacher_id = auth()->user()->id;
        $request->merge(['teacher_id' => $teacher_id]);
        $request->validate([
            'comment' => 'required|string|max:255|min:3',
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        Comment::create($request->all());

        return redirect()->back()
                         ->with('success', 'Comment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $students = Student::all();
        return view('admin.comments.edit', compact('comment', 'students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $teacher_id = auth()->user()->id;
        $request->merge(['teacher_id' => $teacher_id]);
        $request->validate([
            'comment' => 'required|string|max:255|min:3',
            'student_id' => 'required|exists:students,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $comment->update($request->all());

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (!Gate::allows('isRole', 'admin')) {
            return abort(403, 'Unauthorized');
        }
        $comment->delete();

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comment deleted successfully.');
    }
}
