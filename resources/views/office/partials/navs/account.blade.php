<nav class="account-nav">
    <div class="account-nav-header">
        <img class="rounded" src="https://www.gravatar.com/avatar/{{ md5(strtolower($me->email)) }}?s=80" width="40" height="40">
        {{ $me->name }}
    </div>
    <div class="account-nav-content">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('glitter.office.index') }}">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    <div class="nav-label">ショップへ戻る</div>
                </a>
            </li>
        </ul>
        <div class="nav-heading">
            <i class="fa fa-key" aria-hidden="true"></i>
            <div class="nav-label">アカウントメニュー</div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link{{ Request::is('office/account/profile*') ? ' active' : '' }}" href="{{ route('glitter.office.account.profile') }}">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <div class="nav-label">プロフィール</div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ Request::is('office/account/security*') ? ' active' : '' }}" href="{{ route('glitter.office.account.security') }}">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    <div class="nav-label">セキュリティ</div>
                </a>
            </li>
        </ul>
    </div>
</nav>{{-- /.account-nav --}}
