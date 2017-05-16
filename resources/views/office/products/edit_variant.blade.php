@extends('glitter.office::layouts.console')

@section('title', '商品管理')

@section('scripts')
<script>
window.contentData = {
    inventory_management: '{{ old('variants.0.inventory_management', $variant->inventory_management) }}',
    requires_shipping: {{ old('variants.0.requires_shipping', $variant->requires_shipping) ? 'true' : 'false' }},
}
</script>
@endsection

@section('nav')
@include('glitter.office::products.nav')
@stop

@section('content')
@include('glitter.office::partials.errors')
<form role="form" method="POST" action="{{ route('glitter.office.products.variant.update', $variant) }}">
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
        <div class="row">
            <div class="col-lg-4">
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <a href="{{ route('glitter.office.products.edit', $product) }}">← 商品編集に戻る</a>
                    </div>
                    <div class="list-group list-group-flush">
                    @foreach($product->variants as $_variant)
                        <a class="list-group-item list-group-item-action{{ $variant->getKey() == $_variant->getKey() ? ' active' : '' }}" href="{{ route('glitter.office.products.variant.edit', $_variant) }}">
                            <img class="mr-2 rounded" src="https://placehold.jp/50x50.png" width="50" height="50">
                            <div class="col p-0">
                                <strong>{{ $_variant->name }}</strong>
                                <div class="d-flex justify-content-between">
                                    <span class="small">{{ $_variant->sku }}</span>
                                    <span class="ml-auto small text-right"><price unit="¥" point="0" value="{{ $_variant->price }}" /></span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <input type="hidden" name="id" value="{{ $variant->getKey() }}">
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::office.product.pricing') }}</h2>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::office.product.price') }}</label>
                                    <input-money name="price" value="{{ old('variants.0.price', $variant->price) }}" unit="¥" point="0">

                                    @if ($errors->has('variants.0.price'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.reference_price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::office.product.reference_price') }}</label>
                                    <input-money name="reference_price" value="{{ old('variants.0.reference_price', $variant->reference_price) }}" unit="¥" point="0" nullable>

                                    @if ($errors->has('variants.0.reference_price'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.reference_price') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('variants.0.taxes_included') ? ' has-danger' : '' }}">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="taxes_included" value="1" {{ old('variants.0.taxes_included', $variant->price) ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::office.product.taxes_included') }}</span>
                            </label>

                            @if ($errors->has('variants.0.taxes_included'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.taxes_included') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::office.product.inventory') }}</h2>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.sku') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::office.product.sku') }}</label>
                                    <input type="text" name="sku" value="{{ old('variants.0.sku', $variant->sku) }}" class="form-control">

                                    @if ($errors->has('variants.0.sku'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.sku') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.barcode') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::office.product.barcode') }}</label>
                                    <input type="text" name="barcode" value="{{ old('variants.0.barcode', $variant->barcode) }}" class="form-control">

                                    @if ($errors->has('variants.0.barcode'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.barcode') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label">{{ trans('glitter::office.product.inventory_management') }}</label>
                                    <select class="form-control" name="inventory_management" v-model="inventory_management">
                                        <option value="none">{{ trans('glitter::office.product.dont_track_inventory') }}</option>
                                        <option value="glitter">{{ trans('glitter::office.product.glitter_track_inventory') }}</option>
                                    </select>

                                    @if ($errors->has('variants.0.inventory_management'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.inventory_management') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6" v-if="inventory_management != 'none'">
                                <div class="form-group{{ $errors->has('variants.0.inventory_quantity') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::office.product.inventory_quantity') }}</label>
                                    <input type="number" name="inventory_quantity" value="{{ old('variants.0.inventory_quantity', $variant->inventory_quantity) }}" class="form-control col-xs-4">

                                    @if ($errors->has('variants.0.inventory_quantity'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.inventory_quantity') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('variants.0.out_of_stock_purchase') ? ' has-danger' : '' }}" v-if="inventory_management != 'none'">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="out_of_stock_purchase" value="1" {{ old('variants.0.out_of_stock_purchase', $variant->out_of_stock_purchase) ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::office.product.out_of_stock_purchase') }}</span>
                            </label>

                            @if ($errors->has('variants.0.out_of_stock_purchase'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.out_of_stock_purchase') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::office.product.shipping') }}</h2>
                        <div class="form-group{{ $errors->has('variants.0.requires_shipping') ? ' has-danger' : '' }}">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="requires_shipping" value="1" v-model="requires_shipping" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::office.product.requires_shipping') }}</span>
                            </label>

                            @if ($errors->has('variants.0.requires_shipping'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.requires_shipping') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-block" v-if="requires_shipping">
                        <h3 class="card-title">{{ trans('glitter::office.product.weight') }}</h3>
                        <p class="small text-muted">{{ trans('glitter::office.product.weight_description') }}</p>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.weight') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::office.product.weight') }}</label>
                                    <input type="text" name="weight" value="{{ old('variants.0.weight', $variant->weight) }}" class="form-control col-xs-4">

                                    @if ($errors->has('variants.0.weight'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.weight') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.weight_unit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::office.product.weight_unit') }}</label>
                                    <select name="weight_unit" class="form-control">
                                        <option value="kg" {{ old('variants.0.weight_unit', $variant->weight_unit) == 'kg' ? 'selected' : '' }}>kg</option>
                                        <option value="g" {{ old('variants.0.weight_unit', $variant->weight_unit) == 'g' ? 'selected' : '' }}>g</option>
                                    </select>

                                    @if ($errors->has('variants.0.weight_unit'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.weight_unit') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <h3 class="card-title">{{ trans('glitter::office.product.fulfillment_service') }}</h3>
                        <div class="form-group{{ $errors->has('variants.0.fulfillment_manual') ? ' has-danger' : '' }}">
                            <select class="form-control" name="fulfillment_service" style="width: auto;">
                                <option value="manual" {{ old('variants.0.fulfillment_service', $variant->fulfillment_service) == 'manual' ? 'selected' : '' }}>{{ trans('glitter::office.product.fulfillment_manual') }}</option>
                                <option value="ヤマト運輸" {{ old('variants.0.fulfillment_service', $variant->fulfillment_service) == 'ヤマト運輸' ? 'selected' : '' }}>ヤマト運輸</option>
                                <option value="佐川急便" {{ old('variants.0.fulfillment_service', $variant->fulfillment_service) == '佐川急便' ? 'selected' : '' }}>佐川急便</option>
                            </select>

                            @if ($errors->has('variants.0.fulfillment_manual'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.fulfillment_manual') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <div class="d-flex justify-content-start">
            <div class="">
                <input type="button" name="delete" value="Delete product" class="btn btn-outline-danger">
            </div>
            <div class="ml-auto">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
@endsection

@section('modal')
<modal name="add_image_url">
    <h5 slot="header" class="modal-title">{{ trans('glitter::office.product.add_image_url') }}</h5>
    <template slot="body">
        <div class="form-group">
            <label class="form-control-label">Paste image URL</label>
            <input type="url" name="url" placeholder="http://" class="form-control">
        </div>
    </template>
    <template slot="footer">
        <button type="button" class="btn btn-secondary" @click.prevent="$emit('modal-close')">Cancel</button>
        <button type="button" class="btn btn-primary">Add image</button>
    </template>
</modal>
<modal name="aoaoao">
    <template slot="body">
        aoaoao
    </template>
</modal>
@endsection
