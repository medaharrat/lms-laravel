@extends('layouts.user')

@section('content')
{!! Form::open(['action' => ['App\Http\Controllers\TasksController@submit', $task->id], 'method' => 'POST']) !!}
@csrf  
<div>  
    <div class="col-lg-12 row">
        <div class="col">subject name</div>
        <div class="col">Teacher name</div>
        <div class="col">Points</div>
    </div>
    <hr>
    <div class="row">
        <div class="col col-lg-9">
            <h5 class="bold">Task description</h6>
            <div class="description">
                <p>{{ $task->description }}</p></li>
            </div>
            <h5 class="bold">Your solution <span class="note">(type your solution below)</span></h6>
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