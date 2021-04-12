@extends('layouts.user')

@section('content')

<div class="fieldset">
  <div class="fieldset-header row">
    <div class="typography  col">
      <span class="bold">{{ $subject->code }}</span>
      <h4 class="bold">{{ $subject->name }}</h4>
    </div>
    <div class="action-buttons col">
      @if(Auth::user()->is_teacher)
      <a href="/teachers/subjects/{{$subject->id}}/edit" class="btn appbtn-primary mx-2" role="button">
        <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      {!! Form::open(['action' => ['App\Http\Controllers\TeacherSubjectsController@destroy', $subject->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        <button class="btn appbtn-danger" role="button" type="submit">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
      {!! Form::close() !!}
      @else
      {!! Form::open(['action' => ['App\Http\Controllers\StudentSubjectsController@drop', $subject->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
      {{ Form::hidden('_method', 'DELETE') }}
        <button class="btn appbtn-danger" type="submit">
          Leave subject
        </button>
      {!! Form::close() !!}
      @endif
    </div>
  </div>
  <div class="description">
    <p>{{ $subject->description }}</p></li>
  </div>
  <ul class="row">
    <div class="col">
      <li><p><b>Date of creation:</b> {{ $subject->created_at->format('d-m-Y') }}</p></li>
      <li><p><b>Date of last modification:</b> {{ $subject->updated_at->format('d-m-Y') }}</p></li>
      <!-- Show the time -->
      <li><p><b>Number of students enrolled:</b> {{ count($students) }}</p></li>  
    </div>
    <div class="col">
      <li><p><b>Credits:</b> {{ $subject->credits }}</p></li>
      @if (!Auth::user()->is_teacher)
        <li><p><b>Teacher's name:</b> {{ $subject->teacher_name }}</p></li>  
        <li><p><b>Teacher's email:</b> {{ $subject->teacher_email }}</p></li>  
      @endif
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
        Tasks (whether it was already submitted or not.)
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
          @if(Auth::user()->is_teacher)
          {!! Form::open(['action' =>'App\Http\Controllers\TasksController@create', 'method' => 'GET']) !!}
          <button class="btn appbtn-primary" type="submit">
            {{ Form::hidden('subject_id', $subject->id) }}
            New Task
          </button>
          {!! Form::close() !!}
          @endif
        </div>
      </div>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Points</th>
              @if(!Auth::user()->is_teacher)
              <th scope="col"></th>
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($tasks as $task)
            <tr>
              <td scope="row"><a href="/tasks/{{$task->id}}">{{ $task->name }}</a></td>  
              <td>{{ $task->points }}</td>
              @if(!Auth::user()->is_teacher)
              <td>
                <a href="/tasks/{{ $task->id }}/submit" class="btn appbtn-primary" role="button">
                  Submit solution
                </a>
              </td>
              @endif
            </tr>
            @endforeach
          </tbody>
      </table> 
    </div>
  </div>
</div>

@endsection