@extends('layouts.user')

@section('content')
<div>
    <h4 class="bold">{{ $solution->task_name }}</h4>
    <hr>
    <div class="col-lg-12 row">
        <div class="col"><span class="bold">Subject:</span> {{ $solution->subject_name }}</div>
        <div class="col"><span class="bold">Points:</span> {{ $solution->task_points }}</div>
    </div>
    <hr>
    <div class="row">
        <div class="col col-lg-9">
            <h5 class="bold">Task description</h6>
            <div class="description">
                <p>{{ $solution->description }}</p></li>
            </div>
            <h5 class="bold">Solution</h6>
            <div class="editor">
                {{ $solution->solution }}
            </div>
        </div>
        <div class="col col-lg-3">
        {!! Form::open(['action' => ['App\Http\Controllers\TasksController@evaluate', $solution->id], 'method' => 'PUT', 'class' => 'm-4']) !!}
            @csrf
            <div class="col col-lg-10">
                <div class="row">
                    {{ Form::label('evaluation', 'Score') }}
                    <div class="col col-lg-10">
                        {{ Form::number('evaluation', '', ['class' => 'form-control', 'min' => 0, 'max' => $solution->taskPoints]) }} 
                        {!!$errors->first("evaluation", "<span class='text-danger'>:message</span>")!!}
                    </div>
                    <div class="col col-lg-2">
                        <span>/{{ $solution->task_points }}</span>
                    </div>
                </div>
            </div>     
            <div class="mt-3">
                <button class="btn appbtn-primary" type="submit">
                    Evaluate
                </button>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection