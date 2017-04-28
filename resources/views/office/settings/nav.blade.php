<div class="screen-nav-header">
    ストア設定
</div>
<div class="screen-nav-content">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">ストア</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/members*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.members') }}">メンバー</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/authorization*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">権限</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/channels*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">チャネル</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/mails*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">メール</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/payments*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">支払</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/delivery*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">配送</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/tax*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">税率</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/tradelaw*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">特定商取引法</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/settings/audit-log*') ? ' active' : '' }}" href="{{ route('glitter.office.settings.index') }}">監査ログ</a></li>
    </ul>
</div>
