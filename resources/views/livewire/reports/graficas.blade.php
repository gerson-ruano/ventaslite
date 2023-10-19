@extends('layouts.theme.app')

@section('content')
<div class="container text-center text-black mt-4">
    <div class="row">
        <!-- Gráfica 1 -->
        <div class="col-12 col-md-6">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="donutChart" style="height:40vh; width:80vw"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gráfica 2 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    @if(count($stockProducts) > 0)
                    <div class="card">
                        <div class="card-body">
                            <canvas id="customChart" style="height:100vh; width:80vw"></canvas>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-success">
                        <strong>No hay productos con bajo stock.</strong> ¡Puedes modificar el stock mínimo (10) para
                        comenzar a ver datos en la gráfica!
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Gráfica 3 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    @if(count($productSales) > 0)
                    <div class="card">
                        <div class="card-body">
                            <canvas id="pieChart2" style="height:40vh; width:80vw"></canvas>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <strong>No hay datos de productos mas vendidos.</strong> ¡Puedes crear mas ventas para comenzar
                        a ver
                        datos en la gráfica!
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Gráfica 4 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    @if(count($salesData) > 0)
                    <div class="card">
                        <div class="card-body">
                            <canvas id="barChart" style="height:100vh; width:80vw"></canvas>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <strong>No hay datos de ventas recientes.</strong> ¡Puedes crear ventas para comenzar a ver
                        datos en la gráfica!
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Gráfica 5 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    @if(count($salesData) > 0)
                    <div class="card">
                        <div class="card-body">
                            <canvas id="lineChart" style="height:100vh; width:80vw"></canvas>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <strong>No hay datos de ventas anuales.</strong> ¡Puedes crear ventas para comenzar a ver datos
                        en la gráfica!
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('livewire.reports.scripts')
@endsection