@extends('glitter.office::layouts.console')

@section('title', '顧客リスト')

@section('nav')
@include('glitter.office::customer.nav')
@stop

@section('content')
<div class="container-fluid d-flex flex-column">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link {{ !$current_finder ? 'active' : '' }}" href="{{ route('glitter.office.customer.search') }}">すべて</a>
        </li>
        @foreach ($finders as $finder_name => $finder)
        <li class="nav-item">
            <a class="nav-link {{ ($current_finder == $finder_name) ? 'active' : '' }}" href="{{ route('glitter.office.customer.search') }}?{{ $finder_name }}">{{ $finder['label'] }}</a>
        </li>
        @endforeach
    </ul>
    <list-table :page-keys="{{ json_encode($customers->modelKeys()) }}"></list-table>
{{ $customers->appends(compact('keyword'))->links('glitter.office::partials.pagination') }}
</div>
@endsection

@section('scripts')
<script type="text/x-template" id="list-table">
<div>
    <form>
      <div class="btn-toolbar mb-3" role="toolbar">
          <div class="btn-group" role="group">
              <button type="button" class="btn btn-secondary dropdown-toggle" :disabled="count == 0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <template v-if="mode == 'all'">全ページの商品を一括変更</template>
                  <template v-else>選択中の @{{ count }} 商品を一括変更</template>
              </button>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="#" v-if="mode == 'all'" @click.prevent="selectPageItem">このページの商品だけを選択</a>
                  <a class="dropdown-item" href="#" v-else @click.prevent="selectAllItem">全ページの商品を選択</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">一括で公開状態にする</a>
                  <a class="dropdown-item" href="#">一括で非公開状態にする</a>
                  <a class="dropdown-item" href="#">アーカイブする</a>
              </div>
          </div>
          <div class="btn-group ml-auto" role="group">
              <div class="input-group">
                  <div class="input-group-btn">
                      <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          絞り込み
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">条件１</a>
                          <a class="dropdown-item" href="#">条件２</a>
                      </div>
                  </div>
                  <input type="search" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="キーワード検索">
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
                    <th>氏名</th>
                    <th class="text-center">所在地</th>
                    <th class="text-center">受注回数</th>
                    <th class="text-center">最後の受注</th>
                    <th class="text-right">総支出</th>
                </tr>
            </thead>
            <tbody>
@foreach($customers as $customer)
                <tr @click="selectRowItem({{ $customer->getKey() }}, $event)">
                    <td class="thumb">
                        <img class="rounded-circle" src="https://www.gravatar.com/avatar/{{ md5(strtolower($customer->email)) }}?d=mm&s=80" width="40" height="40">
                        <template v-cloak v-if="isSelected({{ $customer->getKey() }})">
                            <div class="thumb-check">
                                <i class="fa fa-check" :class="{ 'bg-danger': mode == 'all' }" aria-hidden="true"></i>
                            </div>
                        </template>
                    </td>
                    <td><a href="{{ route('glitter.office.customer.edit', $customer) }}">{{ $customer->name }}</a></td>
                    <td class="text-center">{{ $customer->location or 'N/A' }}</td>
                    <td class="text-center">{{ $customer->orders()->count() }}</td>
                    <td class="text-center">
                        @if ($order = $customer->orders()->first())
                            <a href="{{ route('glitter.office.order.view', $order) }}">{{ $order->number }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="text-right"><price unit="¥" point="0" value="{{ $customer->orders->sum('total_price') }}"></price></td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
</script>
@endsection
