<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\User;
use App\Models\Task;

class TeacherSubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('name', 'asc')->where('teacher_id', Auth::user()->id)->get();
        return view('pages.teacher.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form Validation
        $this->validate($request, [
            'name'    => 'required',
            'credits' => 'required',
        ]);

        // Add subject
        $subject = new Subject;
        $subject->id = $request->input('id');
        $subject->name = $request->input('name');
        $subject->description = $request->input('description');
        $subject->credits = $request->input('credits');
        $subject->teacher_id = $request->input('teacher_id');
        $subject->save();

        return redirect('/teachers/subjects')->with('success', 'Subject Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('pages.subjects.edit')->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->credits = $request->credits;
        $subject->save();

        return redirect('/teachers/subjects/'.$subject->id)->with('success', 'Subject Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete(); // Delete from tables with foreign key
        return redirect('/subjects')->with('success', 'Subject Deleted Successfully!');
    }
}
