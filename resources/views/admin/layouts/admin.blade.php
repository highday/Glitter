<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title') - {{ config('admin.name', 'Glitter Admin') }}</title>
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

<nav class="header-nav navbar navbar-fixed-top navbar-dark hidden-md-up">
    <a @click.prevent="toggleDrawer" href="#" class="navbar-brand">
        <i class="fa fa-bars fa-fw" aria-hidden="true"></i>
        {{ $store->name }}
    </a>
    <ul class="nav navbar-nav float-xs-right">
        <li class="nav-item">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ $me->name }}</a>
            <div class="dropdown-menu dropdown-menu-right">
                @include('glitter.admin::partials.member-dropdown')
            </div>
        </li>
    </ul>
</nav>{{-- /.header-nav --}}

<nav class="drawer-nav" :class="{ in: drawerOpen }">
    <div class="drawer-nav-store dropdown hidden-sm-down">
        <a href="#" class="store-menu" data-toggle="dropdown">
            <span class="store-name">{{ $store->name }}</span>
            <i class="fa fa-caret-down fa-fw" aria-hidden="true"></i><br>
            <small><i class="fa fa-user-circle-o fa-fw" aria-hidden="true"></i>{{ $me->name }}</small>
        </a>
        <div class="dropdown-menu">
            @include('glitter.admin::partials.member-dropdown')
        </div>
    </div>
    <div class="drawer-nav-content">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link{{ Request::is('admin') ? ' active' : '' }}" href="{{ route('glitter.admin.index') }}"><i class="fa fa-home fa-fw" aria-hidden="true"></i>ホーム<span class="notify"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('admin/orders*') ? ' active' : '' }}" href="{{ route('glitter.admin.orders.index') }}"><i class="fa fa-inbox fa-fw" aria-hidden="true"></i>受注管理<span class="badge">9,999</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('admin/products*') ? ' active' : '' }}" href="{{ route('glitter.admin.products.products') }}"><i class="fa fa-tag fa-fw" aria-hidden="true"></i>商品管理</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('admin/customers*') ? ' active' : '' }}" href="{{ route('glitter.admin.customers.index') }}"><i class="fa fa-users fa-fw" aria-hidden="true"></i>顧客リスト</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><i class="fa fa-bar-chart fa-fw" aria-hidden="true"></i>レポート</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><i class="fa fa-scissors fa-fw" aria-hidden="true"></i>クーポン</a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><i class="fa fa-globe fa-fw" aria-hidden="true"></i>オンラインストア</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i>Syn Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#"><i class="fa fa-wordpress fa-fw" aria-hidden="true"></i>WordPress</a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link{{ Request::is('admin/settings*') ? ' active' : '' }}" href="{{ route('glitter.admin.settings.index') }}"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>ストア設定<span class="badge">NEW</span></a>
            </li>
        </ul>
    </div>
</nav>{{-- /.drawer-nav --}}

@hasSection('header')
<header class="header-section">
@yield('header')
</header>{{-- /.header-section --}}
@endif

<div class="fixed-top p-1">
    <div class="d-flex justify-content-end">
        <button class="btn btn-link text-muted" type="button"><i class="fa fa-bell" aria-hidden="true"></i></button>
    </div>
</div>

@section('main')
<main class="main-section">

@hasSection('nav')
<div class="nav-wrapper">
@yield('nav')
</div>{{-- /.nav-wrapper --}}
@endif

<div class="content-wrapper">

@if(!$flash_message->isEmpty())
<div class="container">{!! join($flash_message->all()) !!}</div>
@endif

@yield('content')

</div>{{-- /.content-wrapper --}}

<div class="container">
    <div class="row mt-5 py-3 justify-content-center">
        <div class="col col-auto text-muted small">
            Thanks for testing <a href="https://github.com/highday/glitter" target="_blank">Glitter</a> ✨️
        </div>
    </div>
</div>

</main>{{-- /.main-section --}}
@show

@include('glitter.admin::partials.logout-form')
@yield('modal')
</div>{{-- /.admin-screen --}}

{{-- Scripts --}}
<script src="{{ asset('/js/glitter-admin.js') }}"></script>
@yield('scripts')

</body>
</html>
