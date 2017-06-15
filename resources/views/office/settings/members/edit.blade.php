@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<form id="product_form" role="form" method="POST" action="{{ route('glitter.office.settings.members.update', $member) }}">
    {{ csrf_field() }}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-block d-flex align-items-center">
                        <img class="rounded" src="https://www.gravatar.com/avatar/{{ md5(strtolower($member->email)) }}?d=mm&s=96" width="48" height="48">
                        <div class="ml-3">
                            {{ $member->name }}<br>
                            <span class="small">{{ $member->email }}</span>
                        </div>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item small">
                            <span class="text-muted mr-auto">権限</span>
                            {{ $member->activeStoreRole->name }}
                        </div>
                        <div class="list-group-item small">
                            <span class="text-muted mr-auto">最終ログイン</span>
                            {{ $member->activeStore->pivot->last_login_at->format('Y/m/d H:i') }}
                        </div>
                        <div class="list-group-item small">
                            <span class="text-muted mr-auto">パスワード変更</span>
                            {{ $member->updated_at->format('Y/m/d H:i') }}
                        </div>
                    </div>
                </div>
                <a href="#" class="btn btn-secondary btn-block mb-3">権限を変更</a>
                <a href="#" class="btn btn-secondary btn-block mb-3">パスワード再発行</a>
                <a href="#" class="btn btn-outline-danger btn-block mb-3">メンバーを停止</a>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-block">
                        タイムライン
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
