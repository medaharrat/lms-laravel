@extends('layouts.user')

@section('content')
<div class="fieldset">
  <div class="fieldset-header row">
    <div class="typography  col">
      <h4 class="bold">{{ $task->name }}</h4>
    </div>
    @if(Auth::user()->is_teacher)
    <div class="action-buttons col">
      <a href="/tasks/{{$task->id}}/edit" class="btn appbtn-primary mx-2" role="button">
        <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      {!! Form::open(['action' => ['App\Http\Controllers\TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        <button class="btn appbtn-danger" type="submit">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
      {!! Form::close() !!}
    </div>
    @endif
  </div>
  <div class="description">
    <p>{{ $task->description }}</p></li>
  </div>
  <ul class="row">
    <div class="col">
      <li><p><b>Points:</b> {{ $task->points }}</p></li>
      <li><p><b>Date of creation:</b> {{ $task->created_at->format('d-m-Y') }}</p></li>
    </div>
    <div class="col">
      <li><p><b>Number of submitted solutions:</b> {{ count($solutionsOfStudents) }}</p></li>
      <li><p><b>Number of evaluated solutions:</b> {{ count($evaluatedSolutions) }}</p></li>  
    </div>
  </ul>
</div>
<div class="">
  @if(count($solutionsOfStudents) > 0)
    <h6 class="p-2 mt-3">{{ Auth::user()->is_teacher ? "Submitted solutions" : "My submissions" }}:</h6>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Student name</th>
            <th scope="col">Date of submission</th>
            <th scope="col">Student email</th>
            <th scope="col">Grade</th>
            @if (!Auth::user()->is_teacher)
            <th scope="col">Submissions</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($solutionsOfStudents as $solution)
          <tr>
            <td scope="row">{{ $solution->name }}</td>
            <td>{{ $solution->created_at->format('d-m-Y') }}</td>
            <td>{{ $solution->email }}</td>
            <td>
              @if (Auth::user()->is_teacher && !strtotime($solution->evaluatedOn) > 0)
              <a href="/tasks/{{ $solution->id }}/evaluate" class="appbadge appbadge-secondary" role="button">
                Evaluate
              </a>
              @else
              <div class="row">
                @if (!is_null($solution->points))
                <span class="col">
                  <b>{{ is_null($solution->points) ? '-' : $solution->points.'pts' }}</b>
                </span>
                <span class="col">
                  <i class="fa fa-info-circle" aria-hidden="true" title="Evaluted on {{ $solution->evaluatedOn }}"></i>
                </span>
                @else 
                <span class="text-center">-</span>
                @endif
              </div>
              @endif
            </td>
            @if (!Auth::user()->is_teacher)
            <td>
              <ol>
                <li><a href="#">View Submission 1</a></li>
                <li><a href="#">View Submission 2</a></li>
              </ol>
            </td>
            @endif
          </tr>   
          @endforeach
        </tbody>
    </table>  
    @else
      <p class="m-3">There are no submitted solutions for this task yet! </p>
    @endif
</div>
@endsection