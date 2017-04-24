@extends('glitter.office::layouts.office')

@section('title', '商品管理')

@section('header')
<h1 class="title">
    <i class="fa fa-tag fa-fw" aria-hidden="true"></i>商品管理
</h1>
@endsection

@section('nav')
@include('glitter.office::products.nav')
@stop

@section('content')
<div class="container-fluid">
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group mr-2" role="group">
            <a href="{{ route('glitter.office.products.new') }}" class="btn btn-primary">新規商品</a>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary">インポート</button>
            <button type="button" class="btn btn-secondary">エクスポート</button>
        </div>
        <div class="btn-group ml-auto" role="group">
            <button type="button" class="btn btn-outline-secondary"><i class="fa fa-question" aria-hidden="true"></i></button>
        </div>
    </div>
</div>

<hr>

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
                        <input type="search" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="キーワード検索">
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-data mb-0">
                    <thead>
                        <tr>
                            <th class="chk"><input type="checkbox"></th>
                            {{-- <th class="media"></th> --}}
                            <th>名称</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach($products as $product)
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td class="title"><a href="{{ route('glitter.office.products.edit', $product) }}">{{ $product->title }}</a></td>
                        </tr>
@endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
{{ $products->appends(compact('keyword'))->links('glitter.office::partials.pagination') }}
        </div>
    </div>
</div>
@endsection