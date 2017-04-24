<h4 class="dropdown-header">
    <div class="user-banner d-flex">
        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower($me->email)) }}?s=64" class="rounded" style="width: 32px; height: 32px;">
        <div class="ml-2">
            <div class="user-name">{{ $me->name }}</div>
            <div class="user-role">{{ $me->activeStoreRole->name }}</div>
        </div>
    </div>
</h4>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="{{ route('glitter.office.account.profile') }}">プロフィール</a>
<a class="dropdown-item" href="{{ route('glitter.office.account.security') }}">セキュリティ</a>
<div class="dropdown-divider"></div>
@if(!$me->switchable_stores->isEmpty())
<h6 class="dropdown-header">ストアの切り替え</h6>
@foreach($me->switchable_stores as $store)
<a class="dropdown-item" href="{{ route('glitter.office.store_switch', $store) }}">{{ $store->name }} へ切り替える</a>
@endforeach
<div class="dropdown-divider"></div>
@endif
<a class="dropdown-item" href="#" @click.prevent="logout">ログアウト</a>
