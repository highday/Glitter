@extends('glitter.admin::layouts.admin')

@section('title', '商品管理')

@section('scripts')
<script>
Vue.set(app.$data.screen, 'title', '{{ old('title') }}');
Vue.set(app.$data.screen, 'inventory_management', '{{ old('variants.0.inventory_management') }}');
Vue.set(app.$data.screen, 'requires_shipping', {{ old('variants.0.requires_shipping') ? 'true' : 'false' }});
Vue.set(app.$data.screen, 'use_variant', false);
Vue.set(app.$data.screen, 'variants', [['Size', '']]);
</script>
@endsection

@section('header')
<h1 class="title">
    <a href="{{ route('glitter.admin.products.products') }}"><i class="fa fa-tag fa-fw" aria-hidden="true"></i>商品管理</a>
    / <template v-if="screen.title">@{{ screen.title }}</template><template v-else>Add product</template>
</h1>
@endsection

@section('nav')
@include('glitter.admin::products.nav')
@stop

@section('content')
<form role="form" method="POST" action="{{ route('glitter.admin.products.store') }}">
    {{ csrf_field() }}
    <div class="container">
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group mr-2" role="group">
                <a href="{{ route('glitter.admin.products.products') }}" class="btn btn-secondary">Cancel</a>
            </div>
            <div class="btn-group ml-auto" role="group">
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
                        <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                            <label class="form-control-label">{{ trans('glitter::admin.product.title') }}</label>
                            <input type="text" name="title" v-model.trim="screen.title" class="form-control">

                            @if ($errors->has('title'))
                                <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                            <label class="form-control-label">{{ trans('glitter::admin.product.description') }}</label>
                            <textarea name="description" class="form-control" rows="10">{{ old('description') }}</textarea>

                            @if ($errors->has('description'))
                                <div class="form-control-feedback">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col col-auto mr-auto">
                                <h2 class="card-title">{{ trans('glitter::admin.product.images') }}</h2>
                            </div>
                            <div class="col col-auto">
                                <form-card-nav v-cloak>
                                    <a class="nav-link" href="#" @click.prevent="$emit('modal', 'add_image_url')">{{ trans('glitter::admin.product.add_image_url') }}</a>
                                    <a class="nav-link" href="#">{{ trans('glitter::admin.product.add_image_file') }}</a>
                                </form-card-nav>
                            </div>
                        </div>
                        <div class="p-5 text-center text-muted">
                        Drop files to upload
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::admin.product.pricing') }}</h2>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.price') }}</label>
                                    <input-money unit="¥" point="0" name="variants[0][price]" value="{{ old('variants.0.price') }}">

                                    @if ($errors->has('variants.0.price'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.price') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.reference_price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.reference_price') }}</label>
                                    <input-money unit="¥" point="0" nullable name="variants[0][reference_price]" value="{{ old('variants.0.reference_price') }}">

                                    @if ($errors->has('variants.0.reference_price'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.reference_price') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('variants.0.taxes_included') ? ' has-danger' : '' }}">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="variants[0][taxes_included]" value="1" {{ old('variants.0.taxes_included') ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::admin.product.taxes_included') }}</span>
                            </label>

                            @if ($errors->has('variants.0.taxes_included'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.taxes_included') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::admin.product.inventory') }}</h2>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.sku') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.sku') }}</label>
                                    <input type="text" name="variants[0][sku]" value="{{ old('variants.0.sku') }}" class="form-control">

                                    @if ($errors->has('variants.0.sku'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.sku') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.barcode') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.barcode') }}</label>
                                    <input type="text" name="variants[0][barcode]" value="{{ old('variants.0.barcode') }}" class="form-control">

                                    @if ($errors->has('variants.0.barcode'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.barcode') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('variants.0.inventory_management') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.inventory_management') }}</label>
                                    <select class="form-control" name="variants[0][inventory_management]" v-model="screen.inventory_management">
                                        <option value="none">{{ trans('glitter::admin.product.dont_track_inventory') }}</option>
                                        <option value="glitter">{{ trans('glitter::admin.product.glitter_track_inventory') }}</option>
                                    </select>

                                    @if ($errors->has('variants.0.inventory_management'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.inventory_management') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6" v-if="screen.inventory_management != 'none'">
                                <div class="form-group{{ $errors->has('variants.0.inventory_quantity') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.inventory_quantity') }}</label>
                                    <input type="number" name="variants[0][inventory_quantity]" value="{{ old('variants.0.inventory_quantity') }}" class="form-control col-xs-4">

                                    @if ($errors->has('variants.0.inventory_quantity'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.inventory_quantity') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('variants.0.out_of_stock_purchase') ? ' has-danger' : '' }}" v-if="screen.inventory_management != 'none'">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="variants[0][out_of_stock_purchase]" value="1" {{ old('variants.0.out_of_stock_purchase') ? 'checked' : '' }} class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::admin.product.out_of_stock_purchase') }}</span>
                            </label>

                            @if ($errors->has('variants.0.out_of_stock_purchase'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.out_of_stock_purchase') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">{{ trans('glitter::admin.product.shipping') }}</h2>
                        <div class="form-group{{ $errors->has('variants.0.requires_shipping') ? ' has-danger' : '' }}">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" name="variants[0][requires_shipping]" value="1" v-model="screen.requires_shipping" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">{{ trans('glitter::admin.product.requires_shipping') }}</span>
                            </label>

                            @if ($errors->has('variants.0.requires_shipping'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.requires_shipping') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-block" v-if="screen.requires_shipping">
                        <h3 class="card-title">{{ trans('glitter::admin.product.weight') }}</h3>
                        <p class="small text-muted">{{ trans('glitter::admin.product.weight_description') }}</p>
                        <div class="row flex-items-xs-between">
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.weight') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.weight') }}</label>
                                    <input type="text" name="variants[0][weight]" value="{{ old('variants.0.weight') }}" class="form-control">

                                    @if ($errors->has('variants.0.weight'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.weight') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group{{ $errors->has('variants.0.weight_unit') ? ' has-danger' : '' }}">
                                    <label class="form-control-label">{{ trans('glitter::admin.product.weight_unit') }}</label>
                                    <select name="variants[0][weight_unit]" class="form-control">
                                        <option value="kg" {{ old('variants.0.weight_unit') == 'kg' ? 'selected' : '' }}>kg</option>
                                        <option value="g" {{ old('variants.0.weight_unit') == 'g' ? 'selected' : '' }}>g</option>
                                    </select>

                                    @if ($errors->has('variants.0.weight_unit'))
                                        <div class="form-control-feedback">{{ $errors->first('variants.0.weight_unit') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <h3 class="card-title">{{ trans('glitter::admin.product.fulfillment_service') }}</h3>
                        <div class="form-group{{ $errors->has('variants.0.fulfillment_service') ? ' has-danger' : '' }}">
                            <select class="form-control" name="variants[0][fulfillment_service]" style="width: auto;">
                                <option value="manual" {{ old('variants.0.fulfillment_service') == 'manual' ? 'selected' : '' }}>{{ trans('glitter::admin.product.fulfillment_manual') }}</option>
                                <option value="ヤマト運輸" {{ old('variants.0.fulfillment_service') == 'ヤマト運輸' ? 'selected' : '' }}>ヤマト運輸</option>
                                <option value="佐川急便" {{ old('variants.0.fulfillment_service') == '佐川急便' ? 'selected' : '' }}>佐川急便</option>
                            </select>

                            @if ($errors->has('variants.0.fulfillment_service'))
                                <div class="form-control-feedback">{{ $errors->first('variants.0.fulfillment_service') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col col-auto mr-auto">
                                <h2 class="card-title">{{ trans('glitter::admin.product.variants') }}</h2>
                            </div>
                            <div class="col col-auto">
                                <form-card-nav v-cloak>
                                    <a class="nav-link" href="#" v-if="screen.use_variant" @click.prevent="screen.use_variant = false">{{ trans('glitter::admin.product.add_variant_cancel') }}</a>
                                    <a class="nav-link" href="#" v-else @click.prevent="screen.use_variant = true">{{ trans('glitter::admin.product.add_variant') }}</a>
                                </form-card-nav>
                            </div>
                        </div>
                        <p class="small mb-0">{{ trans('glitter::admin.product.variants_description') }}</p>
                    </div>
                    <div class="card-block" v-if="screen.use_variant">
                        <div class="row no-gutters">
                            <div class="col-4 pr-4">Option name</div>
                            <div class="col">Option values</div>
                        </div>
                        <div class="row no-gutters flex-nowrap" v-for="(variant, index) in screen.variants">
                            <div class="col-4 pr-4"><input type="text" name="" v-model.trim="screen.variants[index][0]" class="form-control"></div>
                            <div class="col"><input-option name="" v-model.trim="screen.variants[index][1]"></div>
                            <div class="col col-auto pl-4" v-if="screen.variants.length > 1"><button type="button" class="btn btn-secondary" @click="screen.variants.splice(index, 1)"><i class="fa fa-trash" aria-hidden="true"></i></button></div>
                        </div>
                        <div class="row" v-if="screen.variants.length < 3">
                            <div class="col-12">
                                <button type="button" class="btn btn-secondary" @click="screen.variants.push(['Color', ''])">Add another option</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                <a href="{{ route('glitter.admin.products.products') }}" class="btn btn-secondary">Cancel</a>
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
@endsection
