@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<form id="role_form" role="form" method="POST" action="{{ route('glitter.office.settings.roles.update', $role) }}">
    {{ csrf_field() }}
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-block d-flex align-items-center">
                        {{ $role->name }}
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-block">
                        タイムライン
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
