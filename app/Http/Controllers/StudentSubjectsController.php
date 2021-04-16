<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\User;
use App\Models\Task;
use App\Models\Solution;

class StudentSubjectsController extends Controller
{
    public function index()
    {
        $student = User::find(Auth::user()->id);
        $subjects = Subject::join('users', 'subjects.teacher_id', '=', 'users.id')
            ->join('students_subjects', 'subjects.id', '=', 'students_subjects.subject_id')
            ->select('subjects.code', 'subjects.id', 'subjects.name', 'subjects.description', 'subjects.credits', 'users.name as teacher_name', 'users.email as teacher_email', 'subjects.created_at', 'subjects.updated_at')
            ->where('students_subjects.student_id', Auth::user()->id)
            ->orderBy('subjects.name', 'asc')
            ->get(); 

        return view('pages.student.index')->with('subjects', $subjects);
    }

    public function take()
    {
        $subjects = Subject::select('subjects.code', 'subjects.id', 'subjects.name', 'subjects.description', 'subjects.credits', 'users.name as teacher_name')
            ->join('users', 'subjects.teacher_id', '=', 'users.id')
            ->whereNotIn('subjects.id', 
                DB::table('students_subjects')
                ->select('subject_id')
                ->where('student_id', Auth::user()->id))
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
        $subject = Subject::join('users', 'subjects.teacher_id', '=', 'users.id')
            ->select('subjects.code', 'subjects.id', 'subjects.name', 'subjects.description', 'subjects.credits', 'users.name as teacher_name', 'users.email as teacher_email', 'subjects.created_at', 'subjects.updated_at')
            ->where('subjects.id', $id)
            ->orderBy('subjects.name', 'asc')
            ->first();
        $students = User::join('students_subjects', 'users.id', '=', 'students_subjects.student_id')
            ->select('users.name', 'users.email')
            ->where('students_subjects.subject_id', $id)
            ->orderBy('users.name', 'asc')
            ->get();
        $tasks = Task::orderBy('name', 'asc')->where('subject_id', $id)->get();
        
        $solutions = Solution::join('tasks', 'solutions.task_id', '=', 'tasks.id')
            ->select('*')
            ->where('tasks.subject_id', '=', $id)
            ->where('solutions.student_id', Auth::user()->id)
            ->orderBy('name', 'asc')
            ->get();
        echo $solutions;
        return view('pages.subjects.show', [
            'subject' => $subject, 'students' => $students, 'tasks' => $tasks, 'solutions' => $solutions
        ]);
    }

    public function drop($id)
    {
        $subject = Subject::find($id);
        $subject->students()->detach(Auth::user()->id);

        return redirect('/students/subjects')->with('success', 'Subject Dropped Successfully!');
    }
}
