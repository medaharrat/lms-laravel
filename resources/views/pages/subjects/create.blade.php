@extends('layouts.user')

@section('content')
    <h4>Create new subject </h4>
    
    {!! Form::open(['action' =>'App\Http\Controllers\TeacherSubjectsController@store', 'method' => 'POST', 'class' => 'm-4']) !!}
        @csrf
        <div class="row">
            <div class="col col-lg-2">
                {{ Form::label('code', 'Subject Code') }}
                {{ Form::text('code', '',['class' => 'form-control', 'placeholder' => 'IK-SUB001']) }}
                {!!$errors->first("code", "<span class='text-danger'>:message</span>")!!}
            </div>
            <div class="col col-lg-10">
                {{ Form::label('name', 'Subject Name') }}
                {{ Form::text('name', '', ['class' => 'form-control']) }}
                {!!$errors->first("name", "<span class='text-danger'>:message</span>")!!}
            </div>
        </div>
        <div class="mt-3">
            {{ Form::label('credits', 'Subject credit value') }}
            {{ Form::number('credits', '', ['class' => 'form-control']) }}
            {!!$errors->first("credits", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="mt-3">
            {{ Form::label('description', 'Subject Description') }}
            {{ Form::textarea('description', '', ['class' => 'form-control']) }}
            {!!$errors->first("description", "<span class='text-danger'>:message</span>")!!}
        </div>
        <div class="mt-3">
            <button class="btn appbtn-primary" type="submit">
                Create
            </button>
        </div>

    {!! Form::close() !!}

@endsection 