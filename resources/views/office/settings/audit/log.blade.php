@extends('glitter.office::layouts.console')

@section('title', 'ストア設定')

@section('nav')
@include('glitter.office::settings.nav')
@stop

@section('content')
<div class="container-fluid">

<table class="table table-sm small">
  <thead>
    <tr>
      <th>member</th>
      <th>action_at</th>
      <th>action</th>
      <th>data</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($logs as $log)
    <tr>
      <td>{{ $log->member ? $log->member->name : '' }}</td>
      <td>{{ $log->action_at->toAtomString() }}</td>
      <td>{{ $log->action }}</td>
      <td>
        <table class="table-sm table-bordered small">
          @foreach ($log->data as $key => $value)
          <tr>
            <th>{{ $key }}</th>
            <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
          </tr>
          @endforeach
        </table>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

</div>
@endsection
