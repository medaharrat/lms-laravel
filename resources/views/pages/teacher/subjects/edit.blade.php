@extends('layouts.teacher')

@section('content')
    <h6>Edit a subject! </h6>
    
    {!! Form::open(['action' =>'App\Http\Controllers\SubjectsController@update', 'method' => 'PUT']) !!}
        @csrf
        {{ Form::label('subjectCode', 'Subject Code') }}
        {{ Form::text('subjectCode', '', ['class' => 'form-control']) }}

        {{ Form::label('subjectName', 'Subject Name') }}
        {{ Form::text('subjectName', '', ['class' => 'form-control']) }}

        {{ Form::label('subjectDescription', 'Subject Description') }}
        {{ Form::textarea('subjectDescription', '', ['class' => 'form-control']) }}

        {{ Form::label('subjectCredits', 'Subject credit value') }}
        {{ Form::number('subjectCredits', '', ['class' => 'form-control']) }}

        {{ Form::submit('Create', ['class', 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection 