@extends('layouts.user')

@section('content')
{!! Form::open(['action' => ['App\Http\Controllers\TasksController@submit', $task->id], 'method' => 'POST']) !!}
@csrf  
<div>  
    <h4 class="bold">{{ $task->name }}</h4>
    <hr>
    <div class="col-lg-12 row">
        <div class="col"><span class="bold">Subject:</span> {{ $task->subject_name }}</div>
        <div class="col"><span class="bold">Teacher:</span> {{ $task->teacher_name }}</div>
        <div class="col"><span class="bold">Points:</span> {{ $task->points }}</div>
    </div>
    <hr>
    <div class="row">
        <div class="col col-lg-9">
            <h5 class="bold">Task description</h6>
            <div class="description">
                <p>{{ $task->description }}</p></li>
            </div>
            <h5 class="bold">Your solution <span class="note">(type your solution below)</span></h6>
            {!!$errors->first("solution", "<span class='text-danger'>:message</span>")!!}
            {{ Form::textarea('solution', '', ['class' => 'editor col-lg-7', 'autofocus', 'spellcheck' => 'false']) }}
        </div>
        <div class="col col-lg-3" style="text-align: right;">
            <div class="mt-3">
                <button class="btn appbtn-primary" type="submit">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection