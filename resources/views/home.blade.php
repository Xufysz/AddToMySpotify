@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (!Auth::user()->spotify_access_token)
                    <a href="{{ route('spotify.login') }}" class="btn btn-primary">Spotify Login</a>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
