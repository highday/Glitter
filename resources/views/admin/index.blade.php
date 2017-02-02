@extends('glitter.admin::layouts.admin')

@section('title', 'ホーム')

@section('content')
<div class="container-fluid">
    <div class="area mb-4">Chart</div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">Timeline</div>
                <div class="card-block">
                    {{ date('Y年n月j日') }}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="area mb-4">Widgets</div>
            <div class="area mb-4">Widgets</div>
            <div class="area mb-4">Widgets</div>
        </div>
    </div>
</div>
@endsection
