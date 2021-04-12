@extends('layouts.user')
@section('content')
  <h1>Take a new subject</h1>
  @if(count($subjects) > 0)
    <h6 class="mt-3">Available subjects:</h6>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Code</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Credits</th>
            <th scope="col">Teacher</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($subjects as $subject)
          <tr>
            <th scope="row">{{ $subject->code }}</th>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->description }}</td>
            <td>{{ $subject->credits }}</td>
            <td>{{ $subject->teacher_name }}</td>
            <td>
              {!! Form::open(['action' => ['App\Http\Controllers\StudentSubjectsController@store'], 'method' => 'POST', 'class' => 'pull-right']) !!}
              {{ Form::hidden('subject_id', $subject->id) }}
                <button class="btn appbtn-primary" type="submit">
                  Take subject
                </button>
              {!! Form::close() !!}
            </td>
          </tr>    
          @endforeach
        </tbody>
    </table>  
  @else
    <p class="m-3">
      No subjects are available for the moment!
    </p>
  @endif
@endsection