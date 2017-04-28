@extends('glitter.office::layouts.console')

@section('title', '商品管理')

@section('scripts')
<script>
var vm = new Vue({
    el: '#products',
    data: {
        mode: 'pick',
        select: [],
        pageKeys: {{ json_encode($products->modelKeys()) }},
    },
    computed: {
        count: function () {
            return this.select.length
        },
        pageSelected: function () {
            if (this.mode == 'all') {
                return true
            }
            return this.select.length == this.pageKeys.length
        },
    },
    methods: {
        selectClear: function () {
            this.mode = 'pick'
            this.select = []
        },
        selectAllItem: function () {
            this.mode = 'all'
            this.select = [].concat(this.pageKeys)
        },
        selectPageItem: function () {
            this.mode = 'pick'
            this.select = [].concat(this.pageKeys)
        },
        selectRowItem: function (key, e) {
            if (e.target.tagName == 'A') return
            this.mode = 'pick'
            var index = this.select.indexOf(key)
            if (index > -1) {
                this.select.splice(index, 1)
            } else {
                this.select.push(key)
            }
        },
        isSelected: function (key) {
            if (this.mode == 'all') {
                return true
            }
            return this.select.indexOf(key) > -1
        },
    },
})
</script>
@endsection

@section('header')
<h1 class="title">
    <i class="fa fa-tag fa-fw" aria-hidden="true"></i>商品管理
</h1>
@endsection

@section('nav')
@include('glitter.office::products.nav')
@stop

@section('content')
<div id="products" class="container-fluid d-flex flex-column">
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('glitter.office.products.products') }}">すべて</a>
        </li>
    </ul>

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
                    <th>商品</th>
                    <th class="text-center">価格</th>
                    <th class="text-center">バリエーション</th>
                    <th class="text-center">在庫</th>
                </tr>
            </thead>
            <tbody>
@foreach($products as $product)
                <tr @click="selectRowItem({{ $product->getKey() }}, $event)">
                    <td class="thumb">
                        <img class="rounded" src="https://placehold.jp/80x80.png" width="40" height="40">
                        <template v-cloak v-if="isSelected({{ $product->getKey() }})">
                            <div class="thumb-check">
                                <i class="fa fa-check" :class="{ 'bg-danger': mode == 'all' }" aria-hidden="true"></i>
                            </div>
                        </template>
                    </td>
                    <td><a href="{{ route('glitter.office.products.edit', $product) }}">{{ $product->name }}</a></td>
                    <td class="text-center">{{ join(' - ', $product->price_range) }}<br><span class="text-muted small">{{ join(' - ', $product->reference_price_range) }}</span></td>
                    <td class="text-center">{{ $product->variants->count() > 1 ? $product->variants->count() : '-' }}</td>
                    <td class="stock text-center">-</td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
{{ $products->appends(compact('keyword'))->links('glitter.office::partials.pagination') }}
</div>
@endsection
