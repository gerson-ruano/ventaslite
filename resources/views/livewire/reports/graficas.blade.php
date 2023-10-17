@extends('layouts.theme.app')

@section('content')
    <div class="container text-center text-black">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Gráfico de Barras</div>
                    <div class="card-body">
                        <canvas id="barChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Gráfico de Línea</div>
                    <div class="card-body">
                        <canvas id="lineChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Gráfico de Pastel</div>
                    <div class="card-body">
                        <canvas id="pieChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Gráfico Radar</div>
                    <div class="card-body">
                        <canvas id="radarChart" style="height:40vh; width:80vw"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.reports.scripts')
@endsection
