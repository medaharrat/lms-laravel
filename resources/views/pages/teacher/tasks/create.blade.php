@extends('layouts.teacher')

@section('content')
    <h4>Create new task! </h4>
    
    {!! Form::open(['action' =>'App\Http\Controllers\TasksController@store', 'method' => 'POST', 'class' => 'm-4']) !!}
        @csrf
        <div class="mt-3">
            {{ Form::label('taskName', 'Task Name') }}
            {{ Form::text('taskName', '', ['class' => 'form-control']) }}
        </div>
        <div class="mt-3">
            {{ Form::label('taskDescription', 'Task Description') }}
            {{ Form::textarea('taskDescription', '', ['class' => 'form-control']) }}
        </div>
        <div class="mt-3">
            {{ Form::label('taskPoints', 'Task Points') }}
            {{ Form::number('taskPoints', '', ['class' => 'form-control']) }}
        </div>
        {{ Form::hidden('subjectId', $subject_id) }}
        <div class="mt-3">
            <button class="btn appbtn-primary" type="submit">
                Create
            </button>
        </div>
    {!! Form::close() !!}

@endsection 