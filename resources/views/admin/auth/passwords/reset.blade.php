@extends('glitter.admin::layouts.admin-guest')

@section('title', 'Reset Password')

@push('styles')
<link href="https://fonts.googleapis.com/css?family=Martel+Sans:700" rel="stylesheet">
@endpush

@section('content')
<div class="guest-content py-5 bg-glitter">
    <h1><span style="font-family: 'Martel Sans', cursive;">{{ config('admin.name', 'Glitter') }}</span></h1>
    <p class="small">Commerce management system for Laravel. ✨</p>
    <nav class="nav mt-4">
        <a class="nav-link" href="#" target="_blank">Documentation</a>
        <a class="nav-link" href="https://github.com/highday/glitter" target="_blank">Github</a>
    </nav>
</div>
<div class="guest-content py-5">
    <h2 class="text-center mb-4">Reset Password</h2>

    <div class="card">
        <div class="card-block">
            <form role="form" method="POST" action="{{ url('/admin/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <div class="form-control-feedback">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
