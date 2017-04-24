<ul class="nav">
    <li class="nav-item"><a class="nav-link{{ Request::is('office/products', 'office/products/edit*') ? ' active' : '' }}" href="{{ route('glitter.office.products.products') }}">商品</a></li>
    <li class="nav-item"><a class="nav-link disabled{{ Request::is('office/products/transfers*') ? ' active' : '' }}" href="{{ route('glitter.office.products.transfers') }}">入荷</a></li>
    <li class="nav-item"><a class="nav-link{{ Request::is('office/products/inventory*') ? ' active' : '' }}" href="{{ route('glitter.office.products.inventory') }}">在庫</a></li>
    <li class="nav-item"><a class="nav-link disabled{{ Request::is('office/products/collections*') ? ' active' : '' }}" href="{{ route('glitter.office.products.collections') }}">コレクション</a></li>
</ul>
