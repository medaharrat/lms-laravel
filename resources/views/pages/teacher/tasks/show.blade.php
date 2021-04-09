@extends('layouts.teacher')

@section('content')
<div class="">
    <ul>
        <li><h6>Name: {{ $task->name }}</h6></li>
        <li><p>Description: {{ $task->description }}</p></li>
        <li><p>Credits: {{ $task->points }}</p></li>
        <li><p>Number of submitted solutions: 5(static)</p></li>
        <li><p>Number of evaluated solutions: 2(static)</p></li>
    </ul>
</div>
<div class="">
    <a href="/tasks/{{$task->id}}/edit" class="btn btn-success" role="button">Edit</a>
    {!! Form::open(['action' => ['App\Http\Controllers\TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
</div>
<div class="">
    <h6>Submitted solutions:</h6>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Date of submission</th>
            <th scope="col">Student name</th>
            <th scope="col">Student email</th>
            <th scope="col">Evaluation</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row">zfzefzf</td>
            <td>fefaeff</td>
            <td>zefze@efz@efzef</td>
            <td>Not evaluated
                <a href="/task/ID/evaluate" class="btn btn-success" role="button">
                    Evaluate
                </a>
            </td>
          </tr>
          <tr>
            <td scope="row">zfzefzf</td>
            <td>fefaeff</td>
            <td>zefze@efz@efzef</td>
            <td>0pts, on 15/01/2021</td>
          </tr>
        </tbody>
    </table>  
</div>
@endsection