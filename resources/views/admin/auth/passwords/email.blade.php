@extends('glitter.admin::layouts.admin-guest')

@section('title', 'Reset Password')

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
    <h2 class="text-center mb-4">Reset Password</h2>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-block">
            <form role="form" method="POST" action="{{ url('/admin/password/email') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary btn-block">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-3">
        <a class="btn btn-link btn-block" href="{{ url('/admin/login') }}">
            Cancel
        </a>
    </div>
</div>
@endsection
