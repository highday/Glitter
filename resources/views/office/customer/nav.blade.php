<div class="screen-nav-header">
    顧客リスト
</div>
<div class="screen-nav-content">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link{{ Request::is('office/customers') ? ' active' : '' }}" href="{{ route('glitter.office.customer.search') }}">顧客</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/customers/group') ? ' active' : '' }}" href="{{ route('glitter.office.customer.group.search') }}">グループ</a></li>
    </ul>
</div>
