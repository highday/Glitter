<div class="screen-nav-header">
    商品管理
</div>
<div class="screen-nav-content">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link{{ Request::is('office/products', 'office/products/edit*') ? ' active' : '' }}" href="{{ route('glitter.office.products.products') }}">商品</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/products/new') ? ' active' : '' }}" href="{{ route('glitter.office.products.new') }}">新しい商品の登録</a></li>
        {{-- <li class="nav-item"><a class="nav-link disabled{{ Request::is('office/products/transfers*') ? ' active' : '' }}" href="{{ route('glitter.office.products.transfers') }}">入荷</a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link{{ Request::is('office/products/inventory*') ? ' active' : '' }}" href="{{ route('glitter.office.products.inventory') }}">在庫</a></li> --}}
        <li class="nav-item"><a class="nav-link{{ Request::is('office/products/collections*') ? ' active' : '' }}" href="{{ route('glitter.office.products.collections') }}">コレクション</a></li>
    </ul>
</div>
