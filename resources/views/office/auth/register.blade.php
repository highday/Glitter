@extends('glitter.office::layouts.guest')

@section('title', 'Register')

@push('styles')
<link href="https://fonts.googleapis.com/css?family=Martel+Sans:700" rel="stylesheet">
@endpush

@section('content')
<div class="guest-content py-5 bg-glitter">
    @include('glitter.office::partials.icon')
    <h1><span style="font-family: 'Martel Sans', sans-serif;">{{ config('office.name', 'Glitter') }}</span></h1>
    <p class="small">Commerce management system for Laravel. </p>
    <nav class="nav mt-4">
        <a class="nav-link" href="#" target="_blank">Documentation</a>
        <a class="nav-link" href="https://github.com/highday/glitter" target="_blank">Github</a>
    </nav>
</div>
<div class="guest-content py-5">
    <h2 class="text-center mb-4">Register</h2>

    <div class="card">
        <div class="card-block">
            <form role="form" method="POST" action="{{ url('/office/register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <div class="form-control-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="mt-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-3">
        <a class="btn btn-link btn-block" href="{{ url('/office/login') }}">
            Cancel
        </a>
    </div>
</div>
@endsection
