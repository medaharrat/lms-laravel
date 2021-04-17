<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Solution;
use Carbon\Carbon;

class TasksController extends Controller
{
    public function create(Request $request)
    {
        $subject_id = $request->input('subject_id');;
        return view('pages.tasks.create')->with('subject_id', $subject_id);
    }

    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'name'    => 'required|min:5',
            'description'    => 'required',
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

    public function show($id)
    {
        $task = Task::find($id);

        $solutionsOfStudents = Auth::user()->is_teacher ? 
            Solution::join('users', 'solutions.student_id', '=', 'users.id')
                ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
                ->orderBy('solutions.created_at')
                ->where('solutions.task_id', $id)
                ->get()
            :
            Solution::join('users', 'solutions.student_id', '=', 'users.id')
                ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
                ->orderBy('solutions.created_at')
                ->where(['solutions.task_id' => $id, 'users.id' => Auth::user()->id])
                ->get();

        $evaluatedSolutions = Auth::user()->is_teacher ? 
            Solution::join('users', 'solutions.student_id', '=', 'users.id')
                ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
                ->orderBy('solutions.created_at')
                ->where([['task_id', '=', $id], ['evaluatedOn', '<>', '', 'and']])
                ->get()
            :
            Solution::join('users', 'solutions.student_id', '=', 'users.id')
                ->select('solutions.id as id', 'users.name', 'users.email', 'solutions.created_at', 'solutions.evaluatedOn', 'solutions.points')
                ->orderBy('solutions.created_at')
                ->where([['task_id', '=', $id], ['evaluatedOn', '<>', '', 'and'], ['users.id', Auth::user()->include_once]])
                ->get();

        return view('pages.tasks.show', [
            'task' => $task, 
            'solutionsOfStudents' => $solutionsOfStudents,
            'evaluatedSolutions' => $evaluatedSolutions
        ]);
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('pages.tasks.edit')->with('task', $task);
    }

    public function update(Request $request, $id)
    {
        // Form validation
        $this->validate($request, [
            'name'    => 'required|min:5',
            'description'    => 'required',
        ]);

        // Update
        $task = Task::find($id);
        $task->name = $request->name;
        $task->description = $request->description;
        $task->points = $request->points;
        $task->save();
        
        return redirect('/tasks/'.$task->id)->with('success', 'Task Updated Successfully!');
    }

    public function evaluation($solution_id)
    {   
        $solution = Solution::join('tasks', 'tasks.id', '=', 'solutions.task_id')
        ->join('subjects', 'subjects.id', '=', 'tasks.subject_id')
            ->select(
                'solutions.id', 'tasks.name as task_name' ,'tasks.description', 'solutions.solution', 'tasks.points as task_points', 'subjects.name as subject_name'
            )
            ->where('solutions.id', $solution_id)->first();

        return view('pages.tasks.evaluate')->with('solution', $solution);
    }

    public function evaluate(Request $request, $id)
    {   
        $solution = Solution::find($id);
        $task = Task::find($solution->task_id);

        // Form validation
        $this->validate($request, [
            'evaluation'    => 'required|numeric|min:0|max:'.$task->points,
        ]);

        // Evaluation
        $solution->evaluatedOn = Carbon::now()->toDateTimeString();
        $solution->points = $request->input('evaluation');
        $solution->save();

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

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/teachers/subjects/'.$task->subject_id)->with('success', 'Task Deleted Successfully!');
    }

    public function submission($id)
    {
        $task = Task::join('subjects', 'tasks.subject_id', '=', 'subjects.id')
            ->join('users', 'subjects.teacher_id', '=', 'users.id')
            ->select('subjects.code', 'subjects.name as subject_name', 'users.name as teacher_name','tasks.id', 'tasks.name', 'tasks.points', 'tasks.description')
            ->where('tasks.id', $id)
            ->first(); 
            
        return view('pages.tasks.submit')->with('task', $task);
    }
    public function submit(Request $request, $id)
    {
        $task = Task::find($id);

        // Form validation
        $this->validate($request, [
            'solution'    => 'required',
        ]);

        // Add solution
        $solution = new Solution;
        $solution->student_id = Auth::user()->id;
        $solution->task_id = $task->id;
        $solution->solution = $request->input('solution');
        $solution->save();

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
