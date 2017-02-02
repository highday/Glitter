@extends('glitter.admin::layouts.admin')

@section('title', '商品管理')

@section('scripts')
<script defer>
Vue.set(app.$data.screen, 'title', '{{ old('title', $product->name) }}');
</script>
@endsection

@section('header')
<h1 class="title">
    <a href="{{ route('glitter.admin.products.products') }}"><i class="fa fa-tag fa-fw" aria-hidden="true"></i>商品管理</a>
    / <template v-if="screen.title">@{{ screen.title }}</template><template v-else>{{ $product->name }}</template>
</h1>
@endsection

@section('nav')
@include('glitter.admin::products.nav')
@stop

@section('content')
@include('glitter.admin::partials.errors')
<form role="form" method="POST" action="{{ route('glitter.admin.products.update', $product->id) }}">
    {{ csrf_field() }}
    <div class="container">
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
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-card card">
                    <div class="card-block">
                        <div class="form-group">
                            <label>{{ trans('glitter::admin.product.title') }}</label>
                            <input type="text" name="title" v-model.trim="screen.title" placeholder="{{ $product->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('glitter::admin.product.description') }}</label>
                            <textarea name="description" class="form-control" rows="10">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <div class="row justify-content-between">
                            <div class="col col-auto">
                                <h2 class="card-title">{{ trans('glitter::admin.product.images') }}</h2>
                            </div>
                            <div class="col col-auto">
                                <nav class="nav nav-inline text-sm-right small">
                                    <a class="nav-link pt-0" href="#" @click.prevent="$emit('modal', 'add_image_url')">{{ trans('glitter::admin.product.add_image_url') }}</a>
                                    <a class="nav-link pt-0" href="#">{{ trans('glitter::admin.product.add_image_file') }}</a>
                                </nav>
                            </div>
                        </div>
                        <div class="p-5 text-center text-muted">
                        Drop files to upload
                        </div>
                    </div>
                </div>
                @if($product->variants->count() == 1)
                @foreach($product->variants as $variant)
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::admin.product.pricing') }}</h2>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>{{ trans('glitter::admin.product.price') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">¥</span>
                                        <input type="text" name="variant[0][price]" value="{{ old('variant.0.price', $variant->price->getSelling()) }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>{{ trans('glitter::admin.product.reference_price') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">¥</span>
                                        <input type="text" name="variant[0][reference_price]" value="{{ old('variant.0.reference_price', $variant->price->getReference()) }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="variant[0][taxes_included]" value="1" {{ old('variant.0.taxes_included') ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::admin.product.taxes_included') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::admin.product.inventory') }}</h2>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>{{ trans('glitter::admin.product.sku') }}</label>
                                    <input type="text" name="variant[0][sku]" value="{{ old('variant.0.sku') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>{{ trans('glitter::admin.product.barcode') }}</label>
                                    <input type="text" name="variant[0][barcode]" value="{{ old('variant.0.barcode') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>{{ trans('glitter::admin.product.inventory_policy') }}</label>
                                    <select class="form-control" name="variant[0][inventory_policy]">
                                        <option value="deny" {{ old('variant.0.inventory_policy') == 'deny' ? 'selected' : '' }}>{{ trans('glitter::admin.product.dont_track_inventory') }}</option>
                                        <option value="glitter" {{ old('variant.0.inventory_policy') == 'glitter' ? 'selected' : '' }}>{{ trans('glitter::admin.product.glitter_track_inventory') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label>{{ trans('glitter::admin.product.quantity') }}</label>
                                    <input type="number" name="variant[0][quantity]" value="{{ old('variant.0.quantity') }}" class="form-control col-xs-4">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="variant[0][out_of_stock_purchase]" value="1" {{ old('variant.0.out_of_stock_purchase') ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::admin.product.out_of_stock_purchase') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::admin.product.shipping') }}</h2>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="variant[0][requires_shipping]" value="1" {{ old('variant.0.requires_shipping') ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::admin.product.requires_shipping') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="card-block">
                        <h3 class="card-title">{{ trans('glitter::admin.product.weight') }}</h3>
                        <p class="small text-muted">{{ trans('glitter::admin.product.weight_description') }}</p>
                        <div class="form-group">
                            <label>{{ trans('glitter::admin.product.weight') }}</label>
                            <input type="text" name="variant[0][weight]" value="{{ old('variant.0.weight') }}" class="form-control col-xs-4">
                        </div>
                    </div>
                    <div class="card-block">
                        <h3 class="card-title">{{ trans('glitter::admin.product.fulfillment_service') }}</h3>
                        <select class="form-control" name="variant[0][fulfillment_service]" style="width: auto;">
                            <option value="" {{ old('variant.0.weight') == '' ? 'selected' : '' }}>{{ trans('glitter::admin.product.fulfillment_manual') }}</option>
                            <option value="ヤマト運輸" {{ old('variant.0.weight') == 'ヤマト運輸' ? 'selected' : '' }}>ヤマト運輸</option>
                            <option value="佐川急便" {{ old('variant.0.weight') == '佐川急便' ? 'selected' : '' }}>佐川急便</option>
                        </select>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <div class="row justify-content-between">
                            <div class="col col-auto">
                                <h2 class="card-title">{{ trans('glitter::admin.product.variants') }}</h2>
                            </div>
                            <div class="col col-auto">
                                <nav class="nav nav-inline text-sm-right small">
                                    <a class="nav-link pt-0" href="#">{{ trans('glitter::admin.product.add_variant') }}</a>
                                </nav>
                            </div>
                        </div>
                        <p class="small mb-0">{{ trans('glitter::admin.product.variants_description') }}</p>
                    </div>
                </div>
                @endforeach
                @else
                <div class="form-card card">
                    <div class="card-block">
                        <div class="row justify-content-between">
                            <div class="col col-auto">
                                <h2 class="card-title">{{ trans('glitter::admin.product.variants') }}</h2>
                            </div>
                            <div class="col col-auto">
                                <nav class="nav nav-inline text-sm-right small">
                                    <a class="nav-link pt-0" href="#">{{ trans('glitter::admin.product.reorder_variants') }}</a>
                                    <a class="nav-link pt-0" href="#">{{ trans('glitter::admin.product.edit_options') }}</a>
                                    <a class="nav-link pt-0" href="#">{{ trans('glitter::admin.product.add_variant') }}</a>
                                </nav>
                            </div>
                        </div>
                        <div>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach($product->options as $option)
                                        <th>{{ $option }}</th>
                                        @endforeach
                                        <th>Inventory</th>
                                        <th>Incoming</th>
                                        <th>Price</th>
                                        <th>SKU</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->variants as $variant)
                                    <tr>
                                        <td>IMG</td>
                                        @foreach($variant->options as $option)
                                        <td>{{ $option->getValue() }}</td>
                                        @endforeach
                                        <td></td>
                                        <td></td>
                                        <td>{{ $variant->price->getSelling() }}</td>
                                        <td>{{ $variant->sku }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">Visibility</h2>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">Organization</h2>
                    </div>
                    <div class="card-block">
                    </div>
                    <div class="card-block">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
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
    <h5 slot="header" class="modal-title">{{ trans('glitter::admin.product.add_image_url') }}</h5>
    <template slot="body">
        <div class="form-group">
            <label>Paste image URL</label>
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
