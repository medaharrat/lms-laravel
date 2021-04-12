@extends('layouts.user')
@section('content')
    <h1>Students space</h1>
    @if(count($subjects) > 0)
      <h6 class="mt-4">Subjects taken by me:</h6>
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
              <td>
                <a href="/students/subjects/{{ $subject->id }}">
                  {{ $subject->name }}
                </a>
              </td>
              <td>{{ $subject->description }}</td>
              <td>{{ $subject->credits }}</td>
              <td>{{ $subject->teacher_name }}</td>
              <td>
                {!! Form::open(['action' => ['App\Http\Controllers\StudentSubjectsController@drop', $subject->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                {{ Form::hidden('_method', 'DELETE') }}
                  <button class="btn appbtn-danger" type="submit">
                    Leave subject
                  </button>
                {!! Form::close() !!}
              </td>
            </tr>
            @endforeach
          </tbody>
      </table> 
    @else 
    <p class="m-3">
      You have not taken any subjects yet!
    </p>
    @endif   


@endsection