@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<form id="role_form" role="form" method="POST" action="{{ route('glitter.office.settings.roles.update', $role) }}">
    {{ csrf_field() }}
    <div class="container-fluid">
        <div class="h5 mb-3">ロールを編集する</div>
        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label>名称</label>
                    <input class="form-control" type="text" name="name" value="{{ old('name', $role->name) }}">
                </div>
                <div class="form-group">
                    <label>概要</label>
                    <input class="form-control" type="text" name="description" value="{{ old('description', $role->description) }}">
                </div>
                <div class="form-group">
                    <label>ポリシー</label>
                    <div class="list-group">
                        @foreach ($store->policies as $policy)
                        <label class="list-group-item">
                            <div class="custom-control custom-checkbox pl-0">
                                <input type="checkbox" name="policies[]" value="{{ $policy->getKey() }}" {{ in_array($policy->getKey(), old('policies', $role->policies->map->getKey()->toArray())) ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </div>
                            <span class="ml-2">{{ $policy->name }}</span>
                            <small class="ml-2 text-muted">{{ $policy->description }}</small>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <a href="{{ route('glitter.office.settings.roles.search') }}" class="btn btn-link mr-2">キャンセル</a>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
