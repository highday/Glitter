<ul class="nav">
    <li class="nav-item"><a class="nav-link{{ Request::is('admin/products', 'admin/products/edit*') ? ' active' : '' }}" href="{{ route('glitter.admin.products.products') }}">商品</a></li>
    <li class="nav-item"><a class="nav-link disabled{{ Request::is('admin/products/transfers*') ? ' active' : '' }}" href="{{ route('glitter.admin.products.transfers') }}">入荷</a></li>
    <li class="nav-item"><a class="nav-link{{ Request::is('admin/products/inventory*') ? ' active' : '' }}" href="{{ route('glitter.admin.products.inventory') }}">在庫</a></li>
    <li class="nav-item"><a class="nav-link disabled{{ Request::is('admin/products/collections*') ? ' active' : '' }}" href="{{ route('glitter.admin.products.collections') }}">コレクション</a></li>
</ul>
