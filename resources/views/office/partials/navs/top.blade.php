<nav class="top-nav">
    <div class="top-nav-logo">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 512 512">
            <g class="alt1"><path d="M21.09 145.8c60.61 11.72 73.39 24.5 85.11 85.11.44 2.26 1.15 2.26 1.59 0 11.72-60.61 24.5-73.39 85.11-85.11 2.26-.44 2.26-1.15 0-1.59-60.61-11.72-73.39-24.5-85.11-85.11-.44-2.26-1.15-2.26-1.59 0-11.72 60.61-24.5 73.39-85.11 85.11-2.26.44-2.26 1.15 0 1.59"/></g>
            <g class="alt2"><path d="M76.09 389.8c60.61 11.72 73.39 24.5 85.11 85.11.44 2.26 1.15 2.26 1.59 0 11.72-60.61 24.5-73.39 85.11-85.11 2.26-.44 2.26-1.15 0-1.59-60.61-11.72-73.39-24.5-85.11-85.11-.44-2.26-1.15-2.26-1.59 0-11.72 60.61-24.5 73.39-85.11 85.11-2.26.44-2.26 1.15 0 1.59"/></g>
            <g class="star"><path d="M140.19 251.59C261.42 275 287 300.58 310.41 421.81c.87 4.52 2.31 4.52 3.18 0C337 300.58 362.58 275 483.81 251.59c4.52-.87 4.52-2.31 0-3.18C362.58 225 337 199.42 313.59 78.19c-.87-4.52-2.31-4.52-3.18 0C287 199.42 261.42 225 140.19 248.41c-4.52.87-4.52 2.31 0 3.18"/></g>
        </svg>
    </div>
@if(!$me->stores->isEmpty())
    <div class="top-nav-stores">
@foreach($me->stores as $mystore)
        <a class="top-nav-link" href="{{ route('glitter.office.store_switch', $mystore) }}" title="{{ $mystore->name }}へ切り替える">
            <img class="rounded" src="{{ $mystore->icon }}" width="40" height="40">
        </a>
@endforeach
    </div>
@endif
@if(!Request::is('office/account*'))
    <div class="top-nav-profile">
        <div class="top-nav-name">{{ $me->name }} ({{ $me->activeStoreRole->name }})</div>
        <div class="dropup">
            <a class="top-nav-link" href="#" data-toggle="dropdown">
                <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($me->email)) }}?s=80" width="40" height="40">
            </a>
            <div class="dropdown-menu">
                @include('glitter.office::partials.member-dropdown')
            </div>
        </div>
    </div>
@endif
</nav>{{-- /.top-nav --}}
