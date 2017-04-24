<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title') - {{ config('office.name', 'Glitter Admin') }}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/glitter-admin.css') }}" media="all" />
@stack('styles')
<script>
window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>
</script>
</head>
<body>

<div id="glitter-admin" class="admin-screen">

<div class="container pt-3">
    <div class="row justify-content-between">
        <div class="col-12 col-md-auto">
            <h3 class="mb-0" style="line-height: 38px;">
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::guard('member')->user()->email)) }}?s=76" class="rounded float-xs-left" style="width: 38px; margin-right: 0.5rem;">
                {{ Auth::guard('member')->user()->name }}
            </h3>
        </div>
        <div class="col-12 col-md-auto text-right">
            <a class="btn btn-link" href="{{ route('glitter.office.index') }}"><i class="fa fa-chevron-left fa-fw" aria-hidden="true"></i> ホームへ戻る</a>
        </div>
    </div>
    <hr>
@section('main')
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
            <div class="list-group mb-3">
                <a class="list-group-item list-group-item-action{{ Request::is('office/account/profile') ? ' active' : '' }}" href="{{ route('glitter.office.account.profile') }}"><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i> プロフィール</a>
                <a class="list-group-item list-group-item-action{{ Request::is('office/account/security') ? ' active' : '' }}" href="{{ route('glitter.office.account.security') }}"><i class="fa fa-lock fa-fw" aria-hidden="true"></i> セキュリティ</a>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
            @yield('content')
        </div>
    </div>
@show
</div>

</div>{{-- /.admin-screen --}}
@include('glitter.office::partials.logout-form')
{{-- Scripts --}}
<script src="{{ asset('/js/glitter-admin.js') }}"></script>
@yield('scripts')

</body>
</html>
