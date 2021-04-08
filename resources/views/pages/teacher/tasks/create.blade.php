@extends('layouts.teacher')

@section('content')
    <h6>Create new task! </h6>
    
    {!! Form::open(['action' =>'App\Http\Controllers\TasksController@store', 'method' => 'POST']) !!}
        @csrf
        {{ Form::label('taskName', 'Task Name') }}
        {{ Form::text('taskName', '', ['class' => 'form-control']) }}

        {{ Form::label('taskDescription', 'Task Description') }}
        {{ Form::textarea('taskDescription', '', ['class' => 'form-control']) }}

        {{ Form::label('taskPoints', 'Task Points') }}
        {{ Form::number('taskPoints', '', ['class' => 'form-control']) }}

        {{ Form::submit('Create', ['class', 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection 