@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('scripts')
<script type="text/x-template" id="list-table">
<div>
    <form>
      <div class="btn-toolbar mb-3" role="toolbar">
          <div class="btn-group" role="group">
            <a href="{{ route('glitter.office.settings.roles.new') }}" class="btn btn-primary">新規追加</a>
          </div>
          <div class="btn-group ml-auto" role="group">
              <div class="input-group">
                  <input type="search" class="form-control" name="keyword" value="{{ $keyword or '' }}" placeholder="キーワード検索">
                  <div class="input-group-btn">
                      <button type="submit" class="btn btn-secondary"><i class="fa fa-search fa-fw"></i></button>
                  </div>
              </div>
          </div>
      </div>
    </form>
    <div class="table-responsive">
        <table class="table table-data mb-0">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>ロール</th>
                    <th class="text-center">ポリシー</th>
                    <th class="text-center">メンバー</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td class="text-center">{{ $role->getKey() }}</td>
                    <td>
                        @if ($role->built_in)
                            {{ $role->name }}<br>
                        @else
                            <a href="{{ route('glitter.office.settings.roles.edit', $role) }}">{{ $role->name }}</a><br>
                        @endif
                        <small class="text-muted">{{ $role->description }}</small>
                    </td>
                    <td class="text-center">{{ $role->policies->count() }}</td>
                    <td class="text-center">{{ $role->members->count() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</script>
@endsection

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<div class="container-fluid">
    <list-table :page-keys="{{ json_encode($roles->modelKeys()) }}"></list-table>
</div>
@endsection
