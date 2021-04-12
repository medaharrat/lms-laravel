@extends('layouts.user')
@section('content')
    <h1>Teachers space</h1>
    @if (count($subjects) > 0)
    <div class="mt-5">
      <div class="row">
        <div class="col col-lg-10">
          <h6>My current subjects:</h6>
        </div>
        <div class="col col-lg-2">
          <a href='/teachers/subjects/create' class="btn appbtn-primary  col-lg-10" role="button">
            Create New subject
          </a>
        </div>
      </div>
      <table class="table table-hover mt-3">
          <thead>
            <tr>
              <th scope="col">Code</th>
              <th scope="col">Name</th>
              <th scope="col">Description</th>
              <th scope="col">Credits</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($subjects as $subject)
            <tr>
              <th scope="row">{{ $subject->code }}</th>
              <td>
                <a href="/teachers/subjects/{{ $subject->id }}">
                  {{ $subject->name }}
                </a>
              </td>
              <td>{{ $subject->description }}</td>
              <td>{{ $subject->credits }}</td>
            </tr>
            @endforeach
          </tbody>
      </table>  
    </div>
    @else
      <p class="m-3">No subjects found!</p>
    @endif

@endsection