@extends('glitter.admin::layouts.admin')

@section('title', '顧客リスト')

@section('header')
<h1 class="title">
    <a href="{{ route('glitter.admin.customers.index') }}"><i class="fa fa-users fa-fw" aria-hidden="true"></i>顧客リスト</a>
</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group mr-2" role="group">
            <a href="#" class="btn btn-primary">新規顧客</a>
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
                    <a class="nav-link" href="#">メルマガ購読</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">リピート客</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">見込み客</a>
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
                            <th>氏名</th>
                            <th>所在地</th>
                            <th class="text-center">受注回数</th>
                            <th class="text-center">最後の受注</th>
                            <th class="text-xs-right">総支出</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td><a href="#">根本 啓介</a></td>
                            <td>東京都</td>
                            <td class="text-center">1</td>
                            <td class="text-center"><a href="#">#1001</a></td>
                            <td class="text-xs-right">&yen; {{ number_format(1000000) }}</td>
                        </tr>
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td><a href="#">根本 啓介</a></td>
                            <td>東京都</td>
                            <td class="text-center">0</td>
                            <td class="text-center">-</td>
                            <td class="text-xs-right">&yen; {{ number_format(1000000) }}</td>
                        </tr>
                        <tr>
                            <td class="chk"><input type="checkbox"></td>
                            <td><a href="#">根本 啓介</a></td>
                            <td>東京都</td>
                            <td class="text-center">0</td>
                            <td class="text-center">-</td>
                            <td class="text-xs-right">&yen; {{ number_format(1000000) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
