@extends('layouts.teacher')

@section('content')
    <h6>Edit a task! </h6>
    
    {!! Form::open(['action' => ['App\Http\Controllers\TasksController@update', $task->id], 'method' => 'PUT']) !!}
        @csrf
        {{ Form::label('name', 'Task Name') }}
        {{ Form::text('name', $task->name, ['class' => 'form-control']) }}

        {{ Form::label('description', 'Task Description') }}
        {{ Form::textarea('description', $task->description, ['class' => 'form-control']) }}

        {{ Form::label('points', 'Task points') }}
        {{ Form::number('points', $task->points, ['class' => 'form-control']) }}

        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Update', ['class', 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection 