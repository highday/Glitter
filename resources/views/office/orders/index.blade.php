@extends('glitter.office::layouts.office')

@section('title', '受注管理')

@section('header')
<h1 class="title">
    <a href="{{ route('glitter.office.orders.index') }}"><i class="fa fa-inbox fa-fw" aria-hidden="true"></i>受注管理</a>
</h1>
@endsection

@section('nav')
<ul class="nav">
    <li class="nav-item"><a class="nav-link{{ Request::is('office/orders') ? ' active' : '' }}" href="{{ route('glitter.office.orders.index') }}">受注</a></li>
    <li class="nav-item"><a class="nav-link{{ Request::is('office/orders/drafts') ? ' active' : '' }}" href="{{ route('glitter.office.orders.index') }}">下書き</a></li>
    <li class="nav-item"><a class="nav-link disabled{{ Request::is('office/orders/checkouts') ? ' active' : '' }}" href="{{ route('glitter.office.orders.index') }}">中断された注文</a></li>
</ul>
@endsection

@section('content')
<div class="container-fluid">
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group mr-2" role="group">
            <a href="#" class="btn btn-primary">新規受注</a>
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
                    <a class="nav-link active" href="#">すべて</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">オープン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">未発送</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">未払い</a>
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
                        <input type="search" class="form-control" name="q" value="" placeholder="キーワード検索">
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-data mb-0">
                    <thead>
                        <tr>
                            <th class="chk"><input type="checkbox"></th>
                            <th>受注</th>
                            <th>日付</th>
                            <th>顧客</th>
                            <th>支払状況</th>
                            <th>発送状況</th>
                            <th class="text-xs-right">代金</th>
                        </tr>
                    </thead>
                    <tbody>
@for($i = 0; $i < 100; $i++)
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td><a href="#">#1001</a></td>
                            <td>2分前</td>
                            <td><a href="#">根本 啓介</a></td>
                            <td><span class="status status-unpaid">未払い</span></td>
                            <td><span class="status status-unfulfilled">未発送</span></td>
                            <td class="text-xs-right">&yen; 3,624</td>
                        </tr>
@endfor
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td><a href="#">#1001</a></td>
                            <td>2分前</td>
                            <td><a href="#">根本 啓介</a></td>
                            <td><span class="status status-paid">支払い済み</span></td>
                            <td><span class="status status-fulfilled">発送済み</span></td>
                            <td class="text-xs-right">&yen; 3,624</td>
                        </tr>
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td><a href="#">#1001</a></td>
                            <td>2分前</td>
                            <td><a href="#">根本 啓介</a></td>
                            <td><span class="status status-paid">支払い済み</span></td>
                            <td><span class="status status-fulfilled">発送済み</span></td>
                            <td class="text-xs-right">&yen; 3,624</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
