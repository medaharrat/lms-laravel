@extends('layouts.teacher')

@section('content')

<div class="fieldset">
  <div class="fieldset-header row">
    <div class="typography  col">
      <h4 class="bold">{{ $subject->name }}</h4>
    </div>
    <div class="action-buttons col">
      <a href="/subjects/{{$subject->id}}/edit" class="btn appbtn-primary mx-2" role="button">
        <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      {!! Form::open(['action' => ['App\Http\Controllers\SubjectsController@destroy', $subject->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        <a href="#" class="btn appbtn-danger" role="button" type="submit">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
      {!! Form::close() !!}
    </div>
  </div>
  <div class="description">
    <p>{{ $subject->description }}</p></li>
  </div>
  <ul class="row">
    <div class="col">
      <li><p><b>Credits:</b> {{ $subject->credits }}</p></li>
      <li><p><b>Date of creation:</b> {{ $subject->created_at }}</p></li>
    </div>
    <div class="col">
      <li><p><b>Date of last modification:</b> {{ $subject->updated_at }}</p></li>
      <li><p><b>Number of students enrolled:</b> 20 (static)</p></li>  
    </div>
  </ul>
</div>

<div class="mt-4">
  <ul class="nav nav-tabs" id="teacher-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" data-bs-toggle="tab" type="button" data-bs-target="#students"  role="tab" aria-selected="true">
        Students
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" type="button" data-bs-target="#tasks"  role="tab" aria-selected="false">
        Tasks
      </button>
    </li>
  </ul>
  <div class="tab-content" id="teacher-tab">
    <div class="tab-pane fade show active" id="students" role="tabpanel">
      <h6 class="p-2 mt-3">Students enrolled in the subject:</h6>
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
              <td>{{ $student->name }}</td>
              <td>{{ $student->email }}</td>
            </tr>
            @endforeach
          </tbody>
      </table>  
    </div>
    <div class="tab-pane fade" id="tasks" role="tabpanel">
      <div class="row">
        <div class="col">
          <h6 class="p-2 mt-3">Tasks of the subject:</h6>
        </div>
        <div class="action-buttons col">
          <a href="/tasks/create" role="button" class="btn appbtn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
        </div>
      </div>
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
              <td scope="row"><a href="/tasks/{{$task->id}}">{{ $task->name }}</a></td>  
              <td>{{ $task->points }}</td>
            </tr>
            @endforeach
          </tbody>
      </table> 
    </div>
  </div>
</div>

@endsection