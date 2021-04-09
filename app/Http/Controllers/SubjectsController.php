<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject; 
use App\Models\User; 
use App\Models\Task; 

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('name', 'asc')->get();
        return view('pages.teacher.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.teacher.subjects.create');
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
        $subject->id = $request->input('code');
        $subject->name = $request->input('name');
        $subject->description = $request->input('description');
        $subject->credits = $request->input('credits');
        $subject->save();

        return redirect('/subjects')->with('success', 'Subject Created Successfully!');
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
        $students = User::all();
        $tasks = Task::all();
        return view('pages.teacher.subjects.show', [
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
        return view('pages.teacher.subjects.edit')->with('subject', $subject);
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

        return redirect('/subjects/'.$subject->id)->with('success', 'Subject Updated Successfully!');
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
        $subject->delete();
        return redirect('/subjects')->with('success', 'Subject Deleted Successfully!');
    }
}
