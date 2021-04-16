@extends('layouts.user')

@section('content')
    <div class="row">
        <div class="col col-lg-9">
            <h5 class="bold">Task description</h6>
            <div class="description">
                <p>{{ $solution->description }}</p></li>
            </div>
            <h5 class="bold">Solution</h6>
            <div class="source-code">
                <pre>
                <code>
                {{ $solution->solution }}
                </code>
                </pre>
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
                        <span>/{{ $solution->taskPoints }}</span>
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
@endsection