@extends('glitter.office::layouts.console')

@section('title', '受注管理')

@section('nav')
@include('glitter.office::order.nav')
@stop

@section('content')
<div class="container-fluid d-flex flex-column">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('glitter.office.order.search') }}">すべて</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('glitter.office.order.search') }}">オープン</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('glitter.office.order.search') }}">未発送</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('glitter.office.order.search') }}">未払い</a>
        </li>
    </ul>
    <list-table :page-keys="{{ json_encode($orders->modelKeys()) }}"></list-table>
{{ $orders->appends(compact('keyword'))->links('glitter.office::partials.pagination') }}
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
                    <th>受注</th>
                    <th>日付</th>
                    <th>顧客</th>
                    <th>支払状況</th>
                    <th>発送状況</th>
                    <th class="text-xs-right">代金</th>
                </tr>
            </thead>
            <tbody>
@foreach($orders as $order)
                <tr @click="selectRowItem({{ $order->getKey() }}, $event)">
                    <td class="text-center align-middle">
                        <i v-cloak v-if="isSelected({{ $order->getKey() }})" class="fa fa-check-square fa-lg fa-fw text-primary" :class="{ 'text-danger': mode == 'all' }" aria-hidden="true"></i>
                        <i v-cloak v-else class="fa fa-square-o fa-lg fa-fw text-muted" aria-hidden="true"></i>
                    </td>
                    <td><a href="{{ route('glitter.office.order.view', $order) }}">{{ $order->number }}</a></td>
                    <td><timestamp value="{{ $order->order_at }}"></timestamp></td>
                    <td><a href="#">根本 啓介</a></td>
                    <td><span class="status status-unpaid">未払い</span></td>
                    <td><span class="status status-unfulfilled">未発送</span></td>
                    <td><price unit="¥" point="0" value="123456"></price></td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
</script>
@endsection
