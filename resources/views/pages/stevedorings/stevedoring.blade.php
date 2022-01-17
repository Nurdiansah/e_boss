@extends('layouts.app')
@section('title')
Stevedoring
@endsection
@section('content')

<div class="content">
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-4">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="">
                    <h1 class="text-white  pb-2 fw-bold"><i class="fa fa-globe-asia"></i> <i>Monthly Stevedoring Vessel</i></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">
                                <div class="card-title">Monthly Report Stevedoring Vessel</div>
                                <a href="{{route('stevedoring.annual')}}" class="btn btn-danger btn-sm "><i class="fa fa-calendar-alt"></i> Annual</a>
                </div> --}}
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Chart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Table</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            {{-- <div class="card-sub">
                                            All
                                        </div> --}}
                            <div class="chart-container">
                                <canvas id="htmlLegendsChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <div class="table-responsive  " style="height: 357px;overflow-y:scroll;">

                                <table class="table table-sm mt--1 table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Ton/M</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Januari</td>
                                            <td>{{$januari}}</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Februari</td>
                                            <td>{{$februari}}</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Maret</td>
                                            <td>{{$maret}}</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>April</td>
                                            <td>{{$april}}</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Mei</td>
                                            <td>{{$mei}}</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Juni</td>
                                            <td>{{$juni}}</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Juli</td>
                                            <td>{{$juli}}</td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Agustus</td>
                                            <td>{{$agustus}}</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>September</td>
                                            <td>{{$september}}</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Oktober</td>
                                            <td>{{$oktober}}</td>
                                        </tr>
                                        <tr>
                                            <td>11</td>
                                            <td>November</td>
                                            <td>{{$november}}</td>
                                        </tr>
                                        <tr>
                                            <td>12</td>
                                            <td>Desember</td>
                                            <td>{{$desember}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">

                        <div class="col">
                            <button class="btn border btn-block btn-danger btn-sm "><i class="fa fa-calendar-alt"></i> Monthly</button>
                        </div>
                        <div class="col">
                            <a href="{{route('stevedoring.annual')}}" class="btn btn-block btn-muted border btn-sm "><i class="fa fa-calendar-alt"></i> Annual</a>
                        </div>
                    </div>


                </div>


                <div class="card-body">


                    <div class="card card-secondary">
                        <div class="card-body skew-shadow">
                            <h1>All Client</h1>
                            {{-- <h1>{{ request('year') }}</h1> --}}
                            <h5 class="">{{ request('year') }}</h5>
                            {{-- <div class="pull-right">
                                            <h3 class="fw-bold op-8">88%</h3>
                                        </div> --}}
                        </div>
                    </div>

                    <hr>
                    <form action="{{route('stevedoring.client')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client">Client</label>
                                    <select class="form-control form-control" id="client" name="client">
                                        <option value="all" selected>All</option>
                                        @foreach ($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <select class="form-control form-control" id="year" name="year">
                                        <option {{$year == '2022' ? 'selected' : ''}} value="2022">2022</option>
                                        <option {{$year == '2021' ? 'selected' : ''}} value="2021">2021</option>
                                        <option {{$year == '2020' ? 'selected' : ''}} value="2020">2020</option>
                                        <option {{$year == '2019' ? 'selected' : ''}} value="2019">2019</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Check</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>


                </div>
            </div>
        </div>

    </div>

</div>
</div>


@endsection

@push('chart')
<script>
    $(document).ready(function() {

        var total = "{{$total}}";
        var cargoJanuari = "{{$januari}}";
        var cargoFebruari = '{{$februari}}';
        var cargoMaret = '{{$maret}}';
        var cargoApril = '{{$april}}';
        var cargoMei = '{{$mei}}';
        var cargoJuni = '{{$juni}}';
        var cargoJuli = '{{$juli}}';
        var cargoAgustus = '{{$agustus}}';
        var cargoSeptember = '{{$september}}';
        var cargoOktober = '{{$oktober}}';
        var cargoNovember = '{{$november}}';
        var cargoDesember = '{{$desember}}';
        console.log(cargoDesember)








        htmlLegendsChart = document.getElementById('htmlLegendsChart').getContext('2d');

        var gradientStroke = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, '#177dff');
        gradientStroke.addColorStop(1, '#80b6f4');

        var gradientFill = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
        gradientFill.addColorStop(0, "rgba(23, 125, 255, 0.7)");
        gradientFill.addColorStop(1, "rgba(128, 182, 244, 0.3)");

        var gradientStroke2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
        gradientStroke2.addColorStop(0, '#f3545d');
        gradientStroke2.addColorStop(1, '#ff8990');

        var gradientFill2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
        gradientFill2.addColorStop(0, "rgba(243, 84, 93, 0.7)");
        gradientFill2.addColorStop(1, "rgba(255, 137, 144, 0.3)");

        var gradientStroke3 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
        gradientStroke3.addColorStop(0, '#fdaf4b');
        gradientStroke3.addColorStop(1, '#ffc478');

        var gradientFill3 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
        gradientFill3.addColorStop(0, "rgba(253, 175, 75, 0.7)");
        gradientFill3.addColorStop(1, "rgba(255, 196, 120, 0.3)");

        var myHtmlLegendsChart = new Chart(htmlLegendsChart, {
            type: 'line',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Stevedoring Vessel",
                    borderColor: gradientStroke,
                    pointBackgroundColor: gradientStroke,
                    pointRadius: 0,
                    backgroundColor: gradientFill,
                    legendColor: '#1572E8',
                    fill: true,
                    borderWidth: 1,
                    // data: [154, 184, 175, 203, 210, 231, 240, 278, 252, 312, 320, 374]
                    data: [cargoJanuari, cargoFebruari, cargoMaret, cargoApril, cargoMei, cargoJuni, cargoJuli, cargoAgustus, cargoSeptember, cargoOktober, cargoNovember, cargoDesember]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "500",
                            beginAtZero: false,
                            maxTicksLimit: 5,
                            padding: 20
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "500"
                        }
                    }]
                },
                legendCallback: function(chart) {
                    var text = [];
                    text.push('<ul class="' + chart.id + '-legend html-legend">');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
                        if (chart.data.datasets[i].label) {
                            text.push(chart.data.datasets[i].label);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul>');
                    return text.join('');
                }
            }
        });

        var myLegendContainer = document.getElementById("myChartLegend");

        // generate HTML legend
        myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

        // bind onClick event to all LI-tags of the legend
        var legendItems = myLegendContainer.getElementsByTagName('li');
        for (var i = 0; i < legendItems.length; i += 1) {
            legendItems[i].addEventListener("click", legendClickCallback, false);
        }
    });
</script>
@endpush