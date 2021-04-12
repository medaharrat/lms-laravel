@extends('layouts.user')

@section('content')
    <h4>Edit a subject</h4>
    
    {!! Form::open(['action' => ['App\Http\Controllers\TeacherSubjectsController@update', $subject->id], 'method' => 'PUT', 'class' => 'm-4']) !!}
        @csrf
        <div class="row">
            <div class="col col-lg-2">
                {{ Form::label('code', 'Subject Code') }}
                {{ Form::text('code', $subject->code, ['class' => 'form-control']) }}
            </div>
            <div class="col col-lg-10">
                {{ Form::label('name', 'Subject Name') }}
                {{ Form::text('name', $subject->name, ['class' => 'form-control']) }}
            </div>
        </div>
        <div class="mt-3">
            {{ Form::label('credits', 'Subject credit value') }}
            {{ Form::number('credits', $subject->credits, ['class' => 'form-control']) }}
        </div>
        <div class="mt-3">
            {{ Form::label('description', 'Subject Description') }}
            {{ Form::textarea('description', $subject->description, ['class' => 'form-control']) }}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        <div class="mt-3">
            <button class="btn appbtn-primary" type="submit">
                Update
            </button>
        </div>
    {!! Form::close() !!}

@endsection 