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

<header class="main-header">
    <div class="d-flex">
        <nav class="breadcrumb m-0" style="background: transparent;">
            <a class="breadcrumb-item" href="#">ホーム</a>
            <a class="breadcrumb-item" href="#">ストア設定</a>
            <span class="breadcrumb-item active">ストア</span>
        </nav>
        <nav class="nav ml-auto">
            <a class="nav-link text-muted" href="#" @click.prevent="addNotification('我こそは踊り狂う暴風！', 'さぁ！その胸に刻むが良い！我こそは軍神！踊り狂う暴風、グリームニル！')">
                Add Notification
            </a>
            <a class="nav-link text-muted" href="#" @click.prevent="openNotification">
                <i class="fa fa-list fa-fw" aria-hidden="true"></i>
            </a>
        </nav>
    </div>
    <div class="notification" :class="{ active: drawerOpen }">
        <div class="notification-container">
            <div class="d-flex mb-3">
                Notification
                <a class="ml-auto text-muted" href="#" @click.prevent="closeNotification">
                    <i class="fa fa-window-close fa-fw" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card small mb-3" v-for="notification in listingNotifications">
                <div class="card-header p-2 d-flex align-items-center">
                    <i class="fa fa-bell mr-1" aria-hidden="true"></i>
                    @{{ notification.title }}
                    <span class="ml-auto text-muted">@{{ notification.date }}</span>
                </div>
                <div class="card-block p-2">
                    <p class="card-text">@{{ notification.message }}</p>
                </div>
            </div>
        </div>
        <transition-group name="landing" tag="div" class="notification-runway" v-cloak>
            <div class="card small landing-item p-3 d-flex flex-row align-items-center" v-for="notification in landingNotifications" :key="notification.id" @click="notification.landing = false">
                <i class="fa fa-bell fa-fw fa-3x" aria-hidden="true"></i>
                <div class="ml-2">
                    <strong>@{{ notification.title }}</strong><br>
                    <span class="text-muted">@{{ notification.message }}</span>
                </div>
            </div>
        </transition-group>
    </div>
    <transition name="fade">
        <div class="notification-backdrop" v-cloak v-show="drawerOpen" @click="closeNotification"></div>
    </transition>
</header>{{-- /.main-header --}}

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
