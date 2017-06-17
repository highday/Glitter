@extends('glitter.office::layouts.console')

@section('title', '顧客リスト')

@section('scripts')
    {{--<script>--}}
        {{--window.contentData = {--}}
            {{--inventory_management: '{{ old('variants.0.inventory_management', $customer->variants->first()->inventory_management) }}',--}}
            {{--requires_shipping: {{ old('variants.0.requires_shipping', $customer->variants->first()->requires_shipping) ? 'true' : 'false' }},--}}
            {{--use_variant: {{ $customer->variants->count() > 1 ? 'true' : 'false' }},--}}
            {{--variants: [['Size', '']],--}}
        {{--}--}}
    {{--</script>--}}
@endsection

@section('nav')
    @include('glitter.office::customer.nav')
@endsection

@section('content')
    @include('glitter.office::partials.errors')
    <form id="product_form" role="form" method="POST" action="{{ route('glitter.office.customer.update', $customer->id) }}">
        {{ csrf_field() }}
        <div class="container-fluid">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group ml-auto" role="group" aria-label="Basic example">
                    <input type="submit" value="{{ trans('glitter::office.buttons.save') }}" class="btn btn-primary">
                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">

                    <div class="form-group{{ $errors->has('first_name') || $errors->has('last_name') ? ' has-danger' : '' }}">
                        <div class="mb-3 input-group input-group-lg">
                            @if (App::isLocale('ja'))
                                <input type="text" name="last_name" value="{{ old('last_name', $customer->last_name) }}" placeholder="{{ trans('glitter::office.customer.last_name') }}" class="form-control">
                                <input type="text" name="first_name" value="{{ old('first_name', $customer->first_name) }}" placeholder="{{ trans('glitter::office.customer.first_name') }}" class="form-control">
                            @else
                                <input type="text" name="first_name" value="{{ old('first_name', $customer->first_name) }}" placeholder="{{ trans('glitter::office.customer.first_name') }}" class="form-control">
                                <input type="text" name="last_name" value="{{ old('lst_name', $customer->last_name) }}" placeholder="{{ trans('glitter::office.customer.last_name') }}" class="form-control">
                            @endif
                        </div>

                        @if ($errors->has('first_name') || $errors->has('last_name'))
                            <div class="form-control-feedback">{{ $errors->first('first_name') }}</div>
                            <div class="form-control-feedback">{{ $errors->first('last_name') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <div class="mb-3 input-group input-group-lg">
                            <input type="text" name="email" value="{{ old('email', $customer->email) }}" placeholder="{{ trans('glitter::office.customer.email') }}" class="form-control">
                        </div>

                        @if ($errors->has('email'))
                            <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="d-flex justify-content-start">
                <div class="">
                    <input type="button" name="delete" value="{{ trans('glitter::office.customer.delete_customer') }}" class="btn btn-outline-danger">
                </div>
                <div class="ml-auto">
                    <input type="submit" value="{{ trans('glitter::office.buttons.save') }}" class="btn btn-primary">
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
