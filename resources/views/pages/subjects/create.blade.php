@extends('layouts.user')

@section('content')
    <h4>Create new subject </h4>
    
    {!! Form::open(['action' =>'App\Http\Controllers\TeacherSubjectsController@store', 'method' => 'POST', 'class' => 'm-4']) !!}
        @csrf
        {{ Form::hidden('teacher_id', Auth::user()->id, ['class' => 'form-control']) }}
        <div class="row">
            <div class="col col-lg-2">
                {{ Form::label('id', 'Subject Code') }}
                {{ Form::text('id', 'INF-XXXXXX', ['class' => 'form-control'/*, 'disabled'*/]) }}
            </div>
            <div class="col col-lg-10">
                {{ Form::label('name', 'Subject Name') }}
                {{ Form::text('name', '', ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="mt-3">
            {{ Form::label('credits', 'Subject credit value') }}
            {{ Form::number('credits', '', ['class' => 'form-control']) }}
        </div>
        <div class="mt-3">
            {{ Form::label('description', 'Subject Description') }}
            {{ Form::textarea('description', '', ['class' => 'form-control']) }}
        </div>
        <div class="mt-3">
            <button class="btn appbtn-primary" type="submit">
                Create
            </button>
        </div>

    {!! Form::close() !!}

@endsection 