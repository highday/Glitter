<div class="screen-nav-header">
    商品管理
</div>
<div class="screen-nav-content">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link{{ Request::is('office/products', 'office/products/edit*') ? ' active' : '' }}" href="{{ route('glitter.office.product.search') }}">商品</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/products/collection*') ? ' active' : '' }}" href="{{ route('glitter.office.product.collection.search') }}">コレクション</a></li>
        <li class="nav-item"><a class="nav-link disabled{{ Request::is('office/products/transfer*') ? ' active' : '' }}" href="{{ route('glitter.office.product.transfer.search') }}">入荷</a></li>
        <li class="nav-item"><a class="nav-link disabled{{ Request::is('office/products/inventory*') ? ' active' : '' }}" href="{{ route('glitter.office.product.inventory.search') }}">在庫</a></li>
    </ul>
</div>
