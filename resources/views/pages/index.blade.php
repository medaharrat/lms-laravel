@extends(Auth::user() && Auth::user() ? 'layouts.user' : 'layouts.app')

@section('content')
    <div class="appcard appcard-light max-w-7">
        <div class="appcard-body">
            <p class="font-weight-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a href="/contact">
                <button class="btn btn-outline-success" type="button">Contact</button>
            </a>  
        </div>
    </div>
@endsection