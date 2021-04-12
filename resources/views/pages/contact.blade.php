@extends('layouts.app')

@section('content')
<h1>Contact</h1>
<div class="description row">
    <div class="col col-lg-3">
        Avatar
    </div>
    <div class="col col-lg-9">
        <ul>
            <li>{{ $name }}</li>
            <li>{{ $neptun_code }}</li>
            <li>{{ $email }}</li>
        </ul>
    </div>
</div>
@endsection
