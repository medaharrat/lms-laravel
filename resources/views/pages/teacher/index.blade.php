@extends('layouts.teacher')
@section('content')
    <h1>Teachers space</h1>
    @if (count($subjects) > 0)
      <h6>Available subjects:</h6>
      <table class="table">
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
              <th scope="row">{{ $subject->id }}</th>
              <td>
                <a href="/subjects/{{ $subject->id }}">
                  {{ $subject->name }}
                </a>
              </td>
              <td>{{ $subject->description }}</td>
              <td>{{ $subject->credits }}</td>
            </tr>
            @endforeach
          </tbody>
      </table>  
    @else
      <p>No subjects found!</p>
    @endif

@endsection