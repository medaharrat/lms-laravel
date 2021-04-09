@extends('layouts.teacher')

@section('content')
    <div class="">
        <ul>
            <li><h6>Name: {{ $subject->name }}</h6></li>
            <li><p>Description: {{ $subject->description }}</p></li>
            <li><p>Credits: {{ $subject->credits }}</p></li>
        </ul>
    </div>
    <div class="">
        <a href="/subjects/{{$subject->id}}/edit" class="btn btn-success" role="button">Edit</a>
        {!! Form::open(['action' => ['App\Http\Controllers\SubjectsController@destroy', $subject->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}
    </div>
    <div class="">
        <h6>Students enrolled in the subject:</h6>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email adress</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr>
                <th scope="row">{{ $student->name }}</th>
                <td>{{ $student->email }}</td>
              </tr>
              @endforeach
            </tbody>
        </table>  
    </div>
    <div class="">
        <h6>Tasks of the subject:</h6>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Points</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tasks as $task)
              <tr>
                <th scope="row">{{ $task->name }}</th>
                <td>{{ $task->points }}</td>
              </tr>
              @endforeach
            </tbody>
        </table> 
    </div>
@endsection