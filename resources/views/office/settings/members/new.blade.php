@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<form id="product_form" role="form" method="POST" action="{{ route('glitter.office.settings.members.store') }}">
    {{ csrf_field() }}
    <div class="container-fluid">
        <div class="h5 mb-3">メンバーを追加する</div>
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>メールアドレス</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                    <small class="form-text text-muted">こちらのメールアドレスに登録案内のメールを送信します。</small>
                </div>
                <div class="form-group">
                    <label>ロール</label>
                    <select class="form-control" name="">
@foreach ($store->roles as $role)
                        <option value="{{ $role->getKey() }}">{{ $role->name }}</option>
@endforeach
                    </select>
                    <small class="form-text text-muted">追加するメンバーのロールを選択してください。</small>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('glitter.office.settings.members.search') }}" class="btn btn-link mr-2">キャンセル</a>
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
