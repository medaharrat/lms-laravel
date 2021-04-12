<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Solution;
use Carbon\Carbon;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subject_id = $request->input('subject_id');;
        return view('pages.tasks.create')->with('subject_id', $subject_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'description'    => 'required',
            'points'    => 'required',
        ]);

        // Add the task to the database
        $task = new Task;
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->points = $request->input('points');
        $task->subject_id = $request->input('subject_id');
        $task->save();

        return redirect('/teachers/subjects/'.$request->input('subject_id'))
            ->with('success', 'Task Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        $solutionsOfStudents = Solution::join('users', 'solutions.student_id', '=', 'users.id')
            ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
            ->orderBy('solutions.created_at')
            ->where('solutions.task_id', $id)->get();

        $evaluatedSolutions = Solution::join('users', 'solutions.student_id', '=', 'users.id')
            ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
            ->orderBy('solutions.created_at')
            ->where([['task_id', '=', $id], ['evaluatedOn', '<>', '', 'and']])
            ->get();

        return view('pages.tasks.show', [
            'task' => $task, 
            'solutionsOfStudents' => $solutionsOfStudents,
            'evaluatedSolutions' => $evaluatedSolutions
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
        $task = Task::find($id);
        return view('pages.tasks.edit')->with('task', $task);
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
        $task = Task::find($id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->points = $request->points;
        $task->save();
        
        return redirect('/tasks/'.$task->id)->with('success', 'Task Updated Successfully!');
    }

    /**
     * Show the form for evaluating the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function evaluation($solution_id)
    {   
        $solution = Solution::join('tasks', 'tasks.id', '=', 'solutions.task_id')
            ->select(
                'solutions.id', 'tasks.description', 'solutions.solution', 'tasks.points as taskPoints'
            )
            ->where('solutions.id', $solution_id)->first();

        return view('pages.tasks.evaluate')->with('solution', $solution);
    }

    /**
     * evaluated the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function evaluate(Request $request, $id)
    {   
        $solution = Solution::find($id);
        $task = Task::find($solution->task_id);

        $solution->evaluatedOn = Carbon::now()->toDateTimeString();
        $solution->points = $request->evaluation;
        $solution->save();

        // find a better way not to repeat this
        $solutionsOfStudents = Solution::join('users', 'solutions.student_id', '=', 'users.id')
            ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
            ->orderBy('solutions.created_at')
            ->where('solutions.task_id', $task->id)->get();

        $evaluatedSolutions = Solution::join('users', 'solutions.student_id', '=', 'users.id')
            ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
            ->orderBy('solutions.created_at')
            ->where([['task_id', '=', $task->id], ['evaluatedOn', '<>', '', 'and']])
            ->get();

        return redirect('/tasks/'.$task->id)->with([
            'task' => $task, 
            'solutionsOfStudents' => $solutionsOfStudents,
            'evaluatedSolutions' => $evaluatedSolutions
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/teachers/subjects/'.$task->subject_id)->with('success', 'Task Deleted Successfully!');
    }

    public function submission($id)
    {
        $task = Task::find($id);
        return view('pages.tasks.submit')->with('task', $task);
    }
    public function submit(Request $request, $id)
    {
        $task = Task::find($id);
        // Add solution
        $solution = new Solution;
        $solution->student_id = Auth::user()->id;
        $solution->task_id = $task->id;
        $solution->solution = $request->input('solution');
        $solution->save;

        $solutionsOfStudents = Solution::join('users', 'solutions.student_id', '=', 'users.id')
            ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
            ->orderBy('solutions.created_at')
            ->where('solutions.task_id', $task->id)->get();

        $evaluatedSolutions = Solution::join('users', 'solutions.student_id', '=', 'users.id')
            ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
            ->orderBy('solutions.created_at')
            ->where([['task_id', '=', $task->id], ['evaluatedOn', '<>', '', 'and']])
            ->get();

        return view('pages.tasks.show', [
            'task' => $task, 
            'solutionsOfStudents' => $solutionsOfStudents,
            'evaluatedSolutions' => $evaluatedSolutions
        ]);
        return redirect('/students/subjects/'.$task->subject_id)->with('success', 'Solution Submitted Successfully!');
    }
}
