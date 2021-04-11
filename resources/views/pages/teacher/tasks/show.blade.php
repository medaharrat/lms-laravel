@extends('layouts.teacher')

@section('content')
<div class="fieldset">
  <div class="fieldset-header row">
    <div class="typography  col">
      <h4 class="bold">{{ $task->name }}</h4>
    </div>
    <div class="action-buttons col">
      <a href="/tasks/{{$task->id}}/edit" class="btn appbtn-primary mx-2" role="button">
        <i class="fa fa-pencil" aria-hidden="true"></i>
      </a>
      {!! Form::open(['action' => ['App\Http\Controllers\TasksController@destroy', $task->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
        {{ Form::hidden('_method', 'DELETE') }}
        <a href="#" class="btn appbtn-danger" role="button" type="submit">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
      {!! Form::close() !!}
    </div>
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
    <h6 class="p-2 mt-3">Submitted solutions:</h6>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Student name</th>
            <th scope="col">Date of submission</th>
            <th scope="col">Student email</th>
            <th scope="col">Evaluation</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($solutionsOfStudents as $solution)
          <tr>
            <td scope="row">{{ $solution->name }}</td>
            <td>{{ $solution->created_at->format('d-m-Y') }}</td>
            <td>{{ $solution->email }}</td>
            <td>
              @if (!strtotime($solution->evaluatedOn) > 0)
              <a href="/tasks/{{ $solution->id }}/evaluate" class="appbadge appbadge-secondary" role="button">
                Evaluate
              </a>
              @else
              <div class="row">
                <span class="col">
                  <b>{{ $solution->points }}</b>pts
                </span>
                <span class="col">
                  <i class="fa fa-info-circle" aria-hidden="true" title="Evaluted on {{ $solution->evaluatedOn }}"></i>
                </span>
              </div>
              @endif
            </td>
          </tr>      
          @endforeach
        </tbody>
    </table>  
    @else
      <p class="m-3">There are no solutions for this task! </p>
    @endif
</div>
@endsection