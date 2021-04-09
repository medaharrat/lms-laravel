@extends('layouts.teacher')

@section('content')
    <h6>Edit a subject! </h6>
    
    {!! Form::open(['action' => ['App\Http\Controllers\SubjectsController@update', $subject->id], 'method' => 'PUT']) !!}
        @csrf
        {{ Form::label('code', 'Subject Code') }}
        {{ Form::text('code', $subject->id, ['class' => 'form-control']) }}

        {{ Form::label('name', 'Subject Name') }}
        {{ Form::text('name', $subject->name, ['class' => 'form-control']) }}

        {{ Form::label('description', 'Subject Description') }}
        {{ Form::textarea('description', $subject->description, ['class' => 'form-control']) }}

        {{ Form::label('credits', 'Subject credit value') }}
        {{ Form::number('credits', $subject->credits, ['class' => 'form-control']) }}

        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Update', ['class', 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection 