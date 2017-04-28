<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title') - {{ config('office.name', 'Glitter Admin') }}</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/glitter-office.css') }}" media="all" />
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
<header class="nav-section nav-section-has-screen" :class="{ unfold: !storeFold }" @mouseleave="foldStoreNav">
@include('glitter.office::partials.navs.top')
@include('glitter.office::partials.navs.store')
<nav class="screen-nav">
@yield('nav')
</nav>{{-- /.screen-nav --}}
@include('glitter.office::partials.logout-form')
</header>
@else
<header class="nav-section">
@include('glitter.office::partials.navs.top')
@include('glitter.office::partials.navs.store')
@include('glitter.office::partials.logout-form')
</header>
@endif

@section('main')
<main class="main-section" role="main">

<div class="content-wrapper">

@if(!$flash_message->isEmpty())
<div class="container-fluid">{!! join($flash_message->all()) !!}</div>
@endif

@yield('content')

</div>{{-- /.content-wrapper --}}

<div class="footer-container container-fluid">
    <div class="row mt-5 justify-content-center">
        <div class="col col-auto text-muted small">
            Thanks for testing <a href="https://github.com/highday/glitter" target="_blank">Glitter</a> ✨️
        </div>
    </div>
</div>

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
<script src="{{ asset('/js/glitter-admin.js') }}"></script>
@yield('scripts')

</body>
</html>
