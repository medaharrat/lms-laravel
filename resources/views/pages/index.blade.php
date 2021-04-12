@extends(Auth::user() && Auth::user() ? 'layouts.user' : 'layouts.app')

@section('content')
    <div class="appcard appcard-light max-w-7">
        <div class="appcard-body">
            <p class="font-weight-light">{{$description}}</p>
            <a href="/contact">
                <button class="btn btn-outline-success" type="button">Contact</button>
            </a>  
        </div>
    </div>
@endsection