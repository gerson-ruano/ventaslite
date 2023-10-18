@extends('layouts.theme.app')

@section('content')
    <div class="container text-center text-black mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">INGRESOS, VENTAS, STOCK</div>
                    <div class="card-body">
                        <canvas id="pieChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-1">
                <div class="card">
                    <div class="card-header">PRODUCTOS MAS VENDIDOS</div>
                    <div class="card-body">
                        <canvas id="radarChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-1">
                <div class="card">
                    <div class="card-header">ULTIMOS DIAS</div>
                    <div class="card-body">
                        <canvas id="barChart2" style="height:80vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-1">
                <div class="card">
                    <div class="card-header">ULTIMOS DIAS</div>
                    <div class="card-body">
                        <canvas id="barChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-1">
                <div class="card">
                    <div class="card-header">TENDENCIA DE VENTAS</div>
                    <div class="card-body">
                        <canvas id="lineChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('livewire.reports.scripts')
@endsection
