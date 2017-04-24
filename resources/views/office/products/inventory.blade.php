@extends('glitter.office::layouts.office')

@section('title', '在庫')

@section('header')
<h1 class="title">
    <a href="{{ route('glitter.office.products.products') }}"><i class="fa fa-tag fa-fw" aria-hidden="true"></i>商品管理</a>
    / 在庫
</h1>
@endsection

@section('nav')
@include('glitter.office::products.nav')
@stop

@section('content')
<nav class="action-nav">
    <div class="btn-toolbar float-xs-right" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
            <button type="button" class="btn btn-secondary">インポート</button>
            <button type="button" class="btn btn-secondary">エクスポート</button>
        </div>
        <div class="btn-group" role="group" aria-label="Third group">
            <button type="button" class="btn btn-primary">新規商品</button>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="list-card card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs float-xs-left">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('glitter.office.products.products') }}">すべて</a>
                </li>
            </ul>
        </div>
        <div class="card-block">
            <form method="get">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                絞り込み
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div>
                        <input type="search" class="form-control" name="q" value="{{ $keyword }}" placeholder="キーワード検索">
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-data mb-0">
                    <thead>
                        <tr>
                            <th class="chk"><input type="checkbox"></th>
                            <th class="media"></th>
                            <th>名称</th>
                            <th>在庫</th>
                            <th>タイプ</th>
                            <th>ベンダ</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach($products as $product)
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td class="media"><img src="{{ $product->thumbnail->url }}" width="50" height="50" class="rounded"></td>
                            <td class="name"><a href="{{ route('glitter.office.products.edit', $product->id) }}">{{ $product->name }}</a></td>
                            <td>{{ $product->inventory->summary }}</td>
                            <td>{{ $product->type->name }}</td>
                            <td>{{ $product->vendor->name }}</td>
                        </tr>
@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
