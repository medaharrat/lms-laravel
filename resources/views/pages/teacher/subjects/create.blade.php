@extends('layouts.teacher')

@section('content')
    <h6>Create new subject! </h6>
    
    {!! Form::open(['action' =>'App\Http\Controllers\SubjectsController@store', 'method' => 'POST']) !!}
        @csrf
        {{ Form::label('code', 'Subject Code') }}
        {{ Form::text('code', '', ['class' => 'form-control']) }}

        {{ Form::label('name', 'Subject Name') }}
        {{ Form::text('name', '', ['class' => 'form-control']) }}

        {{ Form::label('description', 'Subject Description') }}
        {{ Form::textarea('description', '', ['class' => 'form-control']) }}

        {{ Form::label('credits', 'Subject credit value') }}
        {{ Form::number('credits', '', ['class' => 'form-control']) }}

        {{ Form::submit('Create', ['class', 'btn btn-primary']) }}
    {!! Form::close() !!}

@endsection 