<div class="screen-nav-header">
    顧客リスト
</div>
<div class="screen-nav-content">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link{{
            (
                Request::routeIs('glitter.office.customer.search') ||
                Request::routeIs('glitter.office.customer.edit')
            ) ? ' active' : ''
            }}" href="{{ route('glitter.office.customer.search') }}">顧客</a></li>
        <li class="nav-item">
            <a class="nav-link{{
            (
                Request::routeIs('glitter.office.customer.circle.search')
            )? ' active' : ''
            }}" href="{{ route('glitter.office.customer.circle.search') }}">サークル</a>
        </li>
    </ul>
</div>
