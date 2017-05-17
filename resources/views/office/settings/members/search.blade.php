@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('scripts')
<script type="text/x-template" id="list-table">
<div>
    <form>
      <div class="btn-toolbar mb-3" role="toolbar">
          <div class="btn-group" role="group">
              <button type="button" class="btn btn-secondary dropdown-toggle" :disabled="count == 0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                メンバー @{{ count }}名を一括変更</template>
              </button>
              <div class="dropdown-menu">
@foreach ($store->roles as $role)
                  <a class="dropdown-item" href="#">権限を{{ $role->name }}に変更する</a>
@endforeach
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

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<div class="container-fluid">
    <list-table :page-keys="{{ json_encode($members->modelKeys()) }}"></list-table>
</div>
@endsection
