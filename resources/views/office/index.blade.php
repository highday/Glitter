@extends('glitter.office::layouts.office')

@section('title', 'ホーム')

@section('scripts')
<script defer>
var data = {
    labels: [],
    datasets: [{
        label: 'Sales',
        data: [],
        borderWidth: 0,
        backgroundColor: 'rgba(61,69,79,0.8)',
    }]
}
for (var i = 0; i < 24; i++) {
    data.labels.push(moment({hour: i}));
    data.datasets[0].data.push(Math.floor(Math.random() * 10000) + 0);
}
var options = {
    layout: {
        padding: 0,
    },
    legend: {
        display: false,
    },
    tooltips: {
        backgroundColor: '#fff',
        titleFontColor: '#000',
        bodyFontColor: '#333',
        footerFontColor: '#000',
        cornerRadius: 0,
        displayColors: false,
    },
    scales: {
        xAxes: [{
            // categoryPercentage: 0.2,
            gridLines: {
                display: false,
            },
            ticks: {
                padding: 0,
                callback: function (value, index, values) {
                    return value.hour() % 4 == 0 || index + 1 == values.length ? value.format('H') : '';
                },
            },
        }],
        yAxes: [{
            // type: 'category',
            ticks: {
                beginAtZero: true,
                callback: function (value, index, values) {
                    return index % 4 == 0 ? '¥'+value : '';
                },
            }
        }]
    }
}
var myChart = new Chart(document.getElementById("myChart"), {type: 'bar', data: data, options: options});
console.log(myChart)
</script>
@endsection

@section('header')
<h1 class="title">
    <i class="fa fa-home fa-fw" aria-hidden="true"></i>ホーム
</h1>
@endsection

@section('content')
<div class="container-fluid">
    <div class="area p-2 mb-4">
        <canvas id="myChart" width="400" height="100"></canvas>
    </div>
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
