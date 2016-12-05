@extends('glitter.admin::layouts.admin')

@section('title', '商品管理')

@section('header')
<h1 class="title">
    <a href="{{ route('glitter.admin.products.products') }}"><i class="fa fa-tag fa-fw" aria-hidden="true"></i>商品管理</a>
    / {{ $product->name }}
</h1>
@endsection

@section('nav')
@include('glitter.admin::products.nav')
@stop

@section('content')
<form role="form" method="POST" action="{{ route('glitter.admin.products.update', $product->id) }}">
    {{ csrf_field() }}
    <div class="container ml-0">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-card card">
                    <div class="card-block">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="10">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <div class="row flex-items-xs-between">
                            <div class="col-xs">
                                <h2 class="card-title mb-0">Images</h2>
                            </div>
                            <div class="col-xs">
                                <nav class="nav nav-inline text-xs-right small">
                                    <a class="nav-link" href="#">画像をURLから追加</a>
                                    <a class="nav-link" href="#">画像を追加</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-card card">
                    <div class="card-block">
                        <h2 class="card-title">Pricing</h2>
                    </div>
                    <div class="card-block">
                        <h2 class="card-title">Shipping</h2>
                    </div>
                    <div class="card-block">
                        <h2 class="card-title">Variants</h2>
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
    <div class="container ml-0">
        <div class="row">
            <div class="col-xs-6 text-xs-left">
                <input type="button" name="delete" value="Delete product" class="btn btn-secondary">
            </div>
            <div class="col-xs-6 text-xs-right">
                <input type="submit" value="Save" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
@endsection
