<div class="screen-nav-header">
    受注管理
</div>
<div class="screen-nav-content">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link{{ Request::is('office/orders', 'office/orders/view*', 'office/orders/edit*') ? ' active' : '' }}" href="{{ route('glitter.office.order.search') }}">受注</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/orders/drafts') ? ' active' : '' }}" href="{{ route('glitter.office.order.search') }}">下書き</a></li>
        <li class="nav-item"><a class="nav-link disabled{{ Request::is('office/orders/checkouts') ? ' active' : '' }}" href="{{ route('glitter.office.order.search') }}">中断された注文</a></li>
    </ul>
</div>
