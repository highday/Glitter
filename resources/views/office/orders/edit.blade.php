@extends('glitter.office::layouts.console')

@section('title', '受注管理')

@section('scripts')
@stop

@section('nav')
@include('glitter.office::orders.nav')
@stop

@section('content')
@include('glitter.office::partials.errors')
<form id="order_form" role="form" method="POST" action="{{ route('glitter.office.order.update', $order->id) }}">
    {{ csrf_field() }}
    <div class="container-fluid">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-secondary"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
            <div class="btn-group mr-2" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-secondary">Duplicate</button>
            </div>
            <div class="btn-group ml-auto" role="group" aria-label="Basic example">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="form-card card">
            <div class="card-block d-flex justify-content-between align-items-center">
                <span>受注番号: #0001</span>
                <span>受注日: 2017年5月10日</span>
                <span>ステータス: inbox</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-card card">
                    <div class="card-block d-flex">
                        <h2 class="card-title mb-0">オーダートレイ</h2>
                        <div class="ml-auto small">
                            <a href="#">トレイを追加する</a>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-0">
                                <a href="#tray1" data-toggle="collapse" style="color: inherit;"><i class="fa fa-archive fa-fw" aria-hidden="true"></i>#1</a>
                            </h3>
                            <span class="ml-auto status status-unfulfilled">
                                未発送
                            </span>
                        </div>
                        <div id="tray1" class="collapse show">
                            <table class="table table-order_content mt-2">
                                <colgroup>
                                    <col style="width: calc(40px + 0.5rem);">
                                    <col>
                                    <col style="width: 4rem;">
                                    <col style="width: 4rem;">
                                    <col style="width: 4rem;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th colspan="2">内容</th>
                                        <th class="text-center">サイズ</th>
                                        <th class="text-center">重量</th>
                                        <th class="text-center">数量</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img class="rounded" src="http://placehold.jp/80x80.png" width="40" height="40"></td>
                                        <td>
                                            Highday T-shirt
                                            <div class="small text-muted">Size: M, Color: Black</div>
                                        </td>
                                        <td class="text-center">60</td>
                                        <td class="text-center">1kg</td>
                                        <td class="text-center">1</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right text-muted">計</td>
                                        <td class="text-center">1kg</td>
                                        <td class="text-center">1</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="p-3 bg-faded">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-title text-muted small mb-2">発送先</div>
                                        <address class="mb-0">〒110-0001<br>東京都台東区谷中2丁目<br>7-6-102<br>根本啓介<br>08033107564</address>
                                    </div>
                                    <div class="col">
                                        <div class="card-title text-muted small mb-2">運送業者</div>
                                        <div class="mb-3">ヤマト運輸</div>
                                        <div class="card-title text-muted small mb-2">送料</div>
                                        <div class="mb-3"><price value="500"></price></div>
                                        <div class="card-title text-muted small mb-2">追跡番号</div>
                                        <div class="mb-0">0123456789</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title mb-0">
                                <a href="#tray2" data-toggle="collapse" style="color: inherit;"><i class="fa fa-archive fa-fw" aria-hidden="true"></i>#2</a>
                            </h3>
                            <span class="ml-auto status status-unfulfilled">
                                未発送
                            </span>
                        </div>
                        <div id="tray2" class="collapse show">
                            <table class="table table-order_content mt-2">
                                <colgroup>
                                    <col style="width: calc(40px + 0.5rem);">
                                    <col>
                                    <col style="width: 4rem;">
                                    <col style="width: 4rem;">
                                    <col style="width: 4rem;">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th colspan="2">内容</th>
                                        <th class="text-center">サイズ</th>
                                        <th class="text-center">重量</th>
                                        <th class="text-center">数量</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img class="rounded" src="http://placehold.jp/80x80.png" width="40" height="40"></td>
                                        <td>
                                            Highday T-shirt
                                            <div class="small text-muted">Size: M, Color: Black</div>
                                        </td>
                                        <td class="text-center">60</td>
                                        <td class="text-center">1kg</td>
                                        <td class="text-center">1</td>
                                    </tr>
                                    <tr>
                                        <td><img class="rounded" src="http://placehold.jp/80x80.png" width="40" height="40"></td>
                                        <td>
                                            Highday T-shirt
                                            <div class="small text-muted">Size: M, Color: Black</div>
                                        </td>
                                        <td class="text-center">60</td>
                                        <td class="text-center">1kg</td>
                                        <td class="text-center">1</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right text-muted">計</td>
                                        <td class="text-center">2kg</td>
                                        <td class="text-center">2</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="p-3 bg-faded">
                                <div class="row">
                                    <div class="col">
                                        <div class="card-title text-muted small mb-2">発送先</div>
                                        <address class="mb-0">〒110-0001<br>東京都台東区谷中2丁目<br>7-6-102<br>根本啓介<br>08033107564</address>
                                    </div>
                                    <div class="col">
                                        <div class="card-title text-muted small mb-2">運送業者</div>
                                        <div class="mb-3">ヤマト運輸</div>
                                        <div class="card-title text-muted small mb-2">送料</div>
                                        <div class="mb-3"><price value="500"></price></div>
                                        <div class="card-title text-muted small mb-2">追跡番号</div>
                                        <div class="mb-0">0123456789</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">タイムライン</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title mb-3">顧客</h2>
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="https://www.gravatar.com/avatar/{{ md5('nemooon@gmail.com') }}?s=100&d=identicon" width="50" height="50">
                            <div class="ml-2">
                                根本 啓介<br>
                                <small class="text-muted">nemooon@gmail.com</small>
                            </div>
                            <div class="ml-auto">
                                <a href="#" class="small">変更</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">注文明細</h2>
                        <table class="table table-order_content mb-0">
                            <colgroup>
                                <col style="width: calc(40px + 0.5rem)">
                                <col>
                                <col style="width: 3rem;">
                                <col style="width: 7rem;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan="2">内容</th>
                                    <th class="text-center">数量</th>
                                    <th class="text-right">価格</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img class="rounded" src="http://placehold.jp/80x80.png" width="40" height="40"></td>
                                    <td>
                                        Highday T-shirt
                                        <div class="small text-muted">Size: M, Color: Black</div>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right"><price value="6000"></price></td>
                                </tr>
                                <tr>
                                    <td><img class="rounded" src="http://placehold.jp/80x80.png" width="40" height="40"></td>
                                    <td>
                                        Highday T-shirt
                                        <div class="small text-muted">Size: M, Color: Black</div>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right"><price value="6000"></price></td>
                                </tr>
                                <tr>
                                    <td><img class="rounded" src="http://placehold.jp/80x80.png" width="40" height="40"></td>
                                    <td>
                                        Highday T-shirt
                                        <div class="small text-muted">Size: M, Color: Black</div>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right"><price value="6000"></price></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">値引き<br><span class="text-muted small">クーポン <code>GLITTER</code></span></th>
                                    <td class="text-right"><price value="-1000"></price></td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">送料<br><span class="text-muted small">計 2便</span></th>
                                    <td class="text-right"><price value="1000"></price></td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">消費税<br><span class="text-muted small">8%</span></th>
                                    <td class="text-right"><price value="500"></price></td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-right">合計</th>
                                    <td class="text-right"><strong><price value="17500"></price></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">請求</h2>
                        <div class="form-group{{ $errors->has('payment_method') ? ' has-danger' : '' }}">
                            <label class="form-control-label">支払方法</label>
                            <select name="payment_method" class="form-control">
                                <option value="credit" {{ old('payment_method') == 'credit' ? 'selected' : '' }}>クレジットカード</option>
                            </select>

                            @if ($errors->has('payment_method'))
                                <div class="form-control-feedback">{{ $errors->first('payment_method') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-block">
                        <h3 class="card-title">請求先</h3>
                        <address class="mb-0">〒110-0001<br>東京都台東区谷中2丁目<br>7-6-102<br>根本啓介<br>08033107564</address>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="d-flex justify-content-start">
            <div class="">
                <input type="button" name="delete" value="Delete" class="btn btn-outline-danger">
            </div>
            <div class="ml-auto">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
@endsection
