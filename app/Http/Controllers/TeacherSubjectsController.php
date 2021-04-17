<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\User;
use App\Models\Task;

class TeacherSubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name', 'asc')->where('teacher_id', Auth::user()->id)->get();
        return view('pages.teacher.index')->with('subjects', $subjects);
    }

    public function create()
    {
        return view('pages.subjects.create');
    }

    public function store(Request $request)
    {
        // Form Validation
        $this->validate($request, [
            'name'    => 'required|min:3',
            'code'    => 'required|min:9|max:9|regex:(^IK-(([A-Z]+)\d{3}(\d+)?$))',
            'credits' => 'required|numeric',
        ],[
            'code.regex' => 'Please respect the following form IK-SSSNNN',
        ]);

        // Add subject
        $subject = new Subject;
        $subject->code = $request->input('code');
        $subject->name = $request->input('name');
        $subject->description = $request->input('description');
        $subject->credits = $request->input('credits');
        $subject->teacher_id = Auth::user()->id;
        $subject->save();

        return redirect('/teachers/subjects')->with('success', 'Subject Created Successfully!');
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

    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('pages.subjects.edit')->with('subject', $subject);
    }

    public function update(Request $request, $id)
    {
        // Form Validation
        $this->validate($request, [
            'name'    => 'required|min:3',
            'code'    => 'required|min:9|max:9',
            'credits' => 'required|numeric',
        ]);

        // Update
        $subject = Subject::find($id);
        $subject->code = $request->code;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->credits = $request->credits;
        $subject->save();

        return redirect('/teachers/subjects/'.$subject->id)->with('success', 'Subject Updated Successfully!');
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete(); // Delete from tables with foreign key
        return redirect('/teachers/subjects')->with('success', 'Subject Deleted Successfully!');
    }
}
