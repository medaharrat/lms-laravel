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
      <li><p><b>Date of creation:</b> {{ $task->created_at }}</p></li>
    </div>
    <div class="col">
      <li><p><b>Number of submitted solutions:</b> 20 (static)</p></li>
      <li><p><b>Number of evaluated solutions:</b> 5 (static)</p></li>  
    </div>
  </ul>
</div>
<div class="">
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
          <tr>
            <td scope="row">Mohamed Aharrat</td>
            <td>5th September 2021</td>
            <td>med@gmail.com</td>
            <td>
                <a href="/submissions/{{ $task->id }}/evaluate" class="appbadge appbadge-secondary" role="button">
                  Evaluate
                </a>
            </td>
          </tr>
          <tr>
            <td scope="row">Karim Aharrat</td>
            <td>6th September 2021</td>
            <td>karim@gmail.com</td>
            <td class="row">
              <span class="col">
                <b>0</b>pts
              </span>
              <span class="col">
                <i class="fa fa-info-circle" aria-hidden="true" title="Evaluated on 15th September 2021"></i>
              </span>
            </td>
          </tr>
        </tbody>
    </table>  
</div>
@endsection