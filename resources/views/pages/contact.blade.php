@extends('layouts.app')

@section('content')
<h1>Contact</h1>
<div class="description ">
    <div class="col-lg-12">
        <ul>
            <li>{{ $name }}</li>
            <li>{{ $neptun_code }}</li>
            <li>{{ $email }}</li>
        </ul>
    </div>
</div>
@endsection
