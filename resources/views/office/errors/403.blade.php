@extends('glitter.office::layouts.guest')

@section('title', 'アクセスが禁止されています')

@section('content')
<div class="error-screen">
    <div class="notfound">
        <h1 class="display-4"><i class="fa fa-ban fa-2x text-muted mb-4" aria-hidden="true"></i><br>403</h1>
        <hr class="my-2">
        <div class="lead px-1">アクセスが禁止されています</div>
    </div>
</div>
@endsection
