<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\User;
use App\Models\Task;

class StudentSubjectsController extends Controller
{

    public function index()
    {
        $student = User::find(Auth::user()->id);
        $subjects = $student->subjects()->get();

        return view('pages.student.index')->with('subjects', $subjects);
    }

    public function take()
    {
        $subjects = Subject::select()
            ->whereNotIn('subjects.id', DB::table('students_subjects')->select('subject_id'))
            ->get();

        return view('pages.subjects.take')->with('subjects', $subjects);
    }

    public function store(Request $request)
    {
        $subject_id = $request->input('subject_id');

        $subject = Subject::find($subject_id);
        $subject->students()->attach(Auth::user()->id);

        return redirect('/students/subjects')->with('success', 'Subject Assigned Successfully!');
    }
    
    public function show($id)
    {
        $subject = Subject::find($id);
        $students = User::join('students_subjects', 'users.id', '=', 'students_subjects.student_id')
            ->select('users.name', 'users.email')
            ->where('students_subjects.subject_id', $id)
            ->orderBy('users.name', 'asc')
            ->get();
        $tasks = Task::orderBy('name', 'asc')->where('subject_id', $id)->get();
        return view('pages.subjects.show', [
            'subject' => $subject, 'students' => $students, 'tasks' => $tasks
        ]);
    }

    public function drop($id)
    {
        $subject = Subject::find($id);
        $subject->students()->detach(Auth::user()->id);

        return redirect('/students/subjects')->with('success', 'Subject Dropped Successfully!');
    }
}
