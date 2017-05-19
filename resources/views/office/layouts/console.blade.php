<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title') - {{ config('office.name', 'Glitter Admin') }}</title>
<script src="{{ asset('/glitter-assets/js/office.js') }}" defer></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/glitter-assets/css/office.css') }}" media="all" />
@stack('styles')
<script>
window.Laravel = <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>
</script>
</head>
<body>

<div class="office-app">

@hasSection('nav')
<header class="nav-section nav-section-has-screen" :class="{ fold: storeFold }" @mouseleave="foldStoreNav">
@include('glitter.office::partials.navs.top')
@include('glitter.office::partials.navs.store')
<nav class="screen-nav">
@yield('nav')
</nav>{{-- /.screen-nav --}}
@include('glitter.office::partials.logout-form')
</header>
@else
<header class="nav-section" :class="{ fold: storeFold }" @mouseleave="foldStoreNav">
@include('glitter.office::partials.navs.top')
@include('glitter.office::partials.navs.store')
@include('glitter.office::partials.logout-form')
</header>
@endif

@section('main')
<main class="main-section" role="main">

<header class="main-header">
    <div class="main-header-container">
        <nav class="nav ml-auto text-muted">
            <a class="nav-link" href="#" @click.prevent="testNotification">TEST</a>
            <a class="nav-link" href="#" @click.prevent="openNotification">
                <i class="fa fa-list fa-fw" aria-hidden="true"></i>
            </a>
        </nav>
    </div>
    <notification-list :open="drawerOpen" @close="closeNotification">
@foreach ($flash_message->messages() as $messages) @foreach ($messages as $message)
        <notification-item :id="{{ rand(9999, 99999) }}" message="{{ $message }}"></notification-item>
@endforeach @endforeach
    </notification-list>
</header>{{-- /.main-header --}}

<div class="main-content">

{{-- @if(!$flash_message->isEmpty())
<div class="container-fluid">{!! join($flash_message->all()) !!}</div>
@endif --}}

@yield('content')

</div>{{-- /.main-content --}}

<div class="main-footer container-fluid">
    <div class="row mt-5 justify-content-center">
        <div class="col col-auto text-muted small">
            Thanks for testing <a href="https://github.com/highday/glitter" target="_blank">Glitter</a> ✨️
        </div>
    </div>
</div>{{-- /.main-footer --}}

</main>{{-- /.main-section --}}
@show

<transition name="modal-backdrop">
    <div v-if="drawerOpen" v-cloak @click="toggleDrawer" class="drawer-nav-backdrop"></div>
</transition>

@hasSection('modal')
<div v-cloak>
@yield('modal')
</div>
@endif
</div>{{-- /.office-app --}}

{{-- Scripts --}}
@yield('scripts')

</body>
</html>
