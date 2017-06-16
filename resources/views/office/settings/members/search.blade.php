@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">すべて</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">停止中</a>
        </li>
    </ul>
    <list-table :page-keys="{{ json_encode($members->modelKeys()) }}"></list-table>
</div>
@endsection

@section('scripts')
<script type="text/x-template" id="list-table">
<div>
    <form>
      <div class="btn-toolbar mb-3" role="toolbar">
          <div class="btn-group" role="group">
            <a href="{{ route('glitter.office.settings.members.new') }}" class="btn btn-primary">新規追加</a>
          </div>
          <div class="btn-group ml-3" role="group">
              <button type="button" class="btn btn-secondary dropdown-toggle" :disabled="count == 0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                メンバー @{{ count }}名を一括変更</template>
              </button>
              <div class="dropdown-menu">
@foreach ($store->roles as $role)
                  <a class="dropdown-item" href="#">権限を <strong>{{ $role->name }}</strong> に変更する</a>
@endforeach
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" href="#">停止する</a>
              </div>
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
                    <th class="text-center align-middle">
                        <a href="#" v-cloak v-if="pageSelected" @click.prevent="selectClear"><i class="fa fa-check-square fa-lg fa-fw text-primary" :class="{ 'text-danger': mode == 'all' }" aria-hidden="true"></i></a>
                        <a href="#" v-cloak v-else @click.prevent="selectPageItem"><i class="fa fa-square-o fa-lg fa-fw text-muted" aria-hidden="true"></i></a>
                    </th>
                    <th>メンバー</th>
                    <th class="text-center">権限</th>
                </tr>
            </thead>
            <tbody>
@foreach ($members as $member)
                <tr @click="selectRowItem({{ $member->getKey() }}, $event)">
                    <td class="thumb">
                        <img class="rounded" src="https://www.gravatar.com/avatar/{{ md5(strtolower($member->email)) }}?d=mm&s=80" width="40" height="40">
                        <template v-cloak v-if="isSelected({{ $member->getKey() }})">
                            <div class="thumb-check">
                                <i class="fa fa-check" :class="{ 'bg-danger': mode == 'all' }" aria-hidden="true"></i>
                            </div>
                        </template>
                    </td>
                    <td>
                        <a href="{{ route('glitter.office.settings.members.edit', $member) }}">{{ $member->name }}</a><br>
                        {{ $member->email }}
                    </td>
                    <td class="text-center">{{ $member->activeStoreRole->name }}</td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
</script>
@endsection
