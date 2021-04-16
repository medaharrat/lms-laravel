@extends('layouts.user')

@section('content')
    <h4>Create new task! </h4>
    
    {!! Form::open(['action' =>'App\Http\Controllers\TasksController@store', 'method' => 'POST', 'class' => 'm-4']) !!}
        @csrf
        <div class="mt-3">
            {{ Form::label('name', 'Task Name') }}
            {{ Form::text('name', '', ['class' => 'form-control']) }}
            {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="mt-3">
            {{ Form::label('description', 'Task Description') }}
            {{ Form::textarea('description', '', ['class' => 'form-control']) }}
            {!!$errors->first("description", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="mt-3">
            {{ Form::label('points', 'Task Points') }}
            {{ Form::number('points', '', ['class' => 'form-control']) }}
            {!!$errors->first("points", "<span class='text-danger'>:message</span>")!!}
        </div>
        {{ Form::hidden('subject_id', $subject_id) }}
        <div class="mt-3">
            <button class="btn appbtn-primary" type="submit">
                Create
            </button>
        </div>
    {!! Form::close() !!}

@endsection 