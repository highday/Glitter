@extends('glitter.admin::layouts.admin-guest')

@section('title', 'Login')

@push('styles')
<link href="https://fonts.googleapis.com/css?family=Martel+Sans:700" rel="stylesheet">
@endpush

@section('content')
<div class="guest-content py-5 bg-glitter">
    @include('glitter.admin::partials.icon')
    <h1><span style="font-family: 'Martel Sans', sans-serif;">{{ config('admin.name', 'Glitter') }}</span></h1>
    <p class="small">Commerce management system for Laravel. </p>
    <nav class="nav mt-4">
        <a class="nav-link" href="#" target="_blank">Documentation</a>
        <a class="nav-link" href="https://github.com/highday/glitter" target="_blank">Github</a>
    </nav>
</div>
<div class="guest-content py-5">
    <h2 class="text-center mb-4">Login</h2>

    <div class="card">
        <div class="card-block">
            <form role="form" method="POST" action="{{ url('/admin/login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email">Email Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>

                    @if ($errors->has('email'))
                        <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input">
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Remember Me</span>
                    </label>
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                        Login
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>
    <div class="mt-3">
        <a class="btn btn-link btn-block" href="{{ url('/admin/password/reset') }}">
            Forgot Your Password?
        </a>
    </div>
</div>
@endsection
