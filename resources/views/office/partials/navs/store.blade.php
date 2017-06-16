<nav class="store-nav" @mouseenter="unfoldStoreNav">
    <div class="store-nav-header">
        <img class="rounded" src="{{ $store->icon }}" width="40" height="40">
        <div class="nav-label">{{ $store->name }}</div>
    </div>
    <div class="store-nav-content">
        <ul class="nav flex-column">
            {{-- <li class="nav-item">
                <a class="nav-link{{ Request::is('office') ? ' active' : '' }}" href="{{ route('glitter.office.index') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <div class="nav-label">ホーム</div>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link{{ Request::is('office/orders*') ? ' active' : '' }}" href="{{ route('glitter.office.order.search') }}">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                    <div class="nav-label">受注管理</div>
                    {{-- <span class="ml-auto badge">9,999</span> --}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('office/products*') ? ' active' : '' }}" href="{{ route('glitter.office.product.search') }}">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                    <div class="nav-label">商品管理</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('office/customers*') ? ' active' : '' }}" href="{{ route('glitter.office.customer.search') }}">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <div class="nav-label">顧客リスト</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    <i class="fa fa-scissors" aria-hidden="true"></i>
                    <div class="nav-label">値引き</div>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    <div class="nav-label">レポート</div>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link{{ Request::is('office/settings*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <div class="nav-label">ストア設定</div>
                    {{-- <span class="ml-auto badge">NEW</span> --}}
                </a>
            </li>
        </ul>
        <div class="nav-heading">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <div class="nav-label">販売チャネル</div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    <i class="fa fa-music" aria-hidden="true"></i>
                    <div class="nav-label">プレイリスト連携</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    <div class="nav-label">オンラインストア</div>
                </a>
            </li>
        </ul>
    </div>
</nav>{{-- /.store-nav --}}
