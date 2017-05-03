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
    <div class="main-header-container">
        <nav class="nav ml-auto text-muted">
            <a class="nav-link" href="#">
                <i class="fa fa-volume-up fa-fw" aria-hidden="true"></i>
            </a>
            <a class="nav-link" href="#" @click.prevent="addNotification('我こそは踊り狂う暴風！', 'さぁ！その胸に刻むが良い！我こそは軍神！踊り狂う暴風、グリームニル！')">
                <i class="fa fa-bell fa-fw" aria-hidden="true"></i>
            </a>
            <a class="nav-link" href="#" @click.prevent="openNotification">
                <i class="fa fa-list fa-fw" aria-hidden="true"></i>
            </a>
        </nav>
    </div>
    <div class="notification" :class="{ active: drawerOpen }">
        <div class="notification-container">
            <div class="notification-header">
                お知らせ
                <a class="ml-3 text-muted small" href="#" v-show="listingNotifications.length > 0" @click.prevent="allArchiveNotifications">
                    すべて既読にする
                </a>
                <a class="ml-auto text-muted" href="#" @click.prevent="closeNotification">
                    <i class="fa fa-window-close fa-fw" aria-hidden="true"></i>
                </a>
            </div>
            <transition-group name="fade" tag="div" class="notification-list" v-cloak>
                <div class="notification-item fade-item card small mb-3" v-for="notification in listingNotifications" :key="notification.id">
                    <div class="card-header p-2 d-flex align-items-center">
                        <i class="fa fa-bell mr-1" aria-hidden="true"></i>
                        @{{ notification.title }}
                        <span class="date ml-auto text-muted">@{{ notification.date }}</span>
                        <a class="archive ml-auto text-muted" href="#" @click.prevent="archiveNotification(notification)"><i class="fa fa-times-circle fa-fw" aria-hidden="true"></i></a>
                    </div>
                    <div class="card-block p-2">
                        <p class="card-text">@{{ notification.message }}</p>
                    </div>
                </div>
            </transition-group>
        </div>
        <transition-group name="landing" tag="div" class="notification-runway" v-cloak>
            <div class="card small landing-item p-3 d-flex flex-row align-items-center" v-for="notification in landingNotifications" :key="notification.id" @click="hideNotification(notification)">
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

<div class="main-content">

@if(!$flash_message->isEmpty())
<div class="container-fluid">{!! join($flash_message->all()) !!}</div>
@endif

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
