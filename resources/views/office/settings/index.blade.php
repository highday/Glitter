@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('header')
<h1 class="title">
    <a href="{{ route('glitter.office.settings.index') }}"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>ストア設定</a>
</h1>
@endsection

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col-lg-3">


            <div class="p-3">
                <h5>基本設定</h5>
                <p class="text-muted">ストアの基本設定です。</p>
            </div>

        </div>
        <div class="col-lg-9">

            <form method="post" action="{{ route('glitter.office.settings.update_store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-block">
                        <div class="form-group">
                            <label for="storeName">ストア名</label>
                            <input type="text" class="form-control" id="storeName" name="name" value="{{ old('name', $store->name) }}">
                        </div>
                        <div class="form-group">
                            <label for="accountEmail">メールアドレス</label>
                            <input type="email" class="form-control" id="accountEmail" name="account_email" value="{{ old('account_email', $store->account_email) }}">
                            <small class="form-text text-muted">このメールアドレスの <a href="https://gravatar.com/" target="_blank">Gravatar</a> アイコンが表示されます。</small>
                        </div>
                        <div class="form-group">
                            <label for="customerEmail">連絡先メールアドレス</label>
                            <input type="email" class="form-control" id="customerEmail" name="customer_email" value="{{ old('customer_email', $store->customer_email) }}">
                            <small class="form-text text-muted">顧客にはこちらのメールアドレスが表示されます。</small>
                        </div>
                        <div class="form-group">
                            <label for="timezone">タイムゾーン</label>
                            <input type="text" class="form-control" id="timezone" name="timezone" value="{{ old('timezone', $store->timezone) }}">
                            <small class="form-text text-muted"><a href="http://php.net/manual/timezones.php" target="_blank">サポートされるタイムゾーンのリスト</a></small>
                        </div>
                        <button type="submit" class="btn btn-primary">基本設定を保存する</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-3">

            <div class="p-3">
                <h5>受注設定</h5>
                <p class="text-muted">なんとかかんとかでこれをそうします。</p>
            </div>

        </div>
        <div class="col-lg-9">

            <div class="card">
                <div class="card-block">
                    <div class="form-group">
                        <label for="orderNumberFormat">受注番号フォーマット</label>
                        <input type="text" class="form-control" id="orderNumberFormat" name="name" value="{{ old('name', '#0000') }}" aria-describedby="orderNumberFormatHelp">
                        <small class="form-text text-muted">
                            サンプル: <em>#0001</em>, <em>#0012</em>, <em>#0123</em>, <em>#1234</em>, <em>#12345</em>
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">受注設定を保存する</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
