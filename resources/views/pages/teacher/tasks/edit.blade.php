@extends('layouts.teacher')

@section('content')
    <h4>Edit a task</h4>
    
    {!! Form::open(['action' => ['App\Http\Controllers\TasksController@update', $task->id], 'method' => 'PUT', 'class' => 'm-4']) !!}
        @csrf
        <div class="mt-3">
            {{ Form::label('name', 'Task Name') }}
            {{ Form::text('name', $task->name, ['class' => 'form-control']) }}
        </div>
        <div class="mt-3">
            {{ Form::label('description', 'Task Description') }}
            {{ Form::textarea('description', $task->description, ['class' => 'form-control']) }}
        </div>
        <div class="mt-3">
            {{ Form::label('points', 'Task points') }}
            {{ Form::number('points', $task->points, ['class' => 'form-control']) }}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        <div class="mt-3">
            <button class="btn appbtn-primary" type="submit">
                Update
            </button>
        </div>    
        {!! Form::close() !!}

@endsection 