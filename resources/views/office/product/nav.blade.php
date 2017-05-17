<div class="screen-nav-header">
    商品管理
</div>
<div class="screen-nav-content">
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link{{ Request::is('office/products', 'office/products/edit*') ? ' active' : '' }}" href="{{ route('glitter.office.product.search') }}">商品</a></li>
        <li class="nav-item"><a class="nav-link{{ Request::is('office/products/new') ? ' active' : '' }}" href="{{ route('glitter.office.product.new') }}">新しい商品の登録</a></li>
        {{-- <li class="nav-item"><a class="nav-link{{ Request::is('office/products/transfer*') ? ' active' : '' }}" href="{{ route('glitter.office.product.transfer') }}">入荷</a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link{{ Request::is('office/products/inventory*') ? ' active' : '' }}" href="{{ route('glitter.office.product.inventory') }}">在庫</a></li> --}}
        {{-- <li class="nav-item"><a class="nav-link{{ Request::is('office/products/collection*') ? ' active' : '' }}" href="{{ route('glitter.office.product.collection') }}">コレクション</a></li> --}}
    </ul>
</div>
