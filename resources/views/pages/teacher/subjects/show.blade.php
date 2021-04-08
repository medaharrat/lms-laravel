@extends('layouts.teacher')

@section('content')
    <ul>
        <li><h6>Name: {{ $subject->name }}</h6></li>
        <li><p>Description: {{ $subject->description }}</p></li>
        <li><p>Credits: {{ $subject->credits }}</p></li>
    </ul>
    
    <a href="/subjects/{{$subject}}/edit" class="btn btn-success" role="button">Edit</a>
    
    {!! Form::open(['action' => ['App\Http\Controllers\SubjectsController@destroy', $subject->code], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}

@endsection