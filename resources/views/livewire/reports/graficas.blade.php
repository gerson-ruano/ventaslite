@extends('layouts.theme.app')

@section('content')
<div class="text-center">
    <h1>REPORTES GRAFICOS</h1>
</div>
<div class="container text-center text-black mt-4">
    <div class="row">
        <!-- Gráfica 1 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartUltimosDias" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($salesData) == 0)
            <div class="alert alert-warning mt-3">
                <strong>No hay reportes de ventas recientes.</strong> ¡Puedes crear ventas para comenzar a ver datos en la
                gráfica!
            </div>
            @endif
        </div>

        <!-- Gráfica 2 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel align-items-center">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartStock" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($stockProducts) == 0)
            <div class="alert alert-secondary mt-3">
                <strong>No hay productos con bajo stock.</strong> ¡Puedes modificar el stock mínimo (10) para comenzar a
                ver datos en la gráfica!
            </div>
            @endif
        </div>

        <!-- Gráfica 3 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartProductTop" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($productSales) == 0)
            <div class="alert alert-warning mt-3">
                <strong>No existen productos más vendidos.</strong> ¡Puedes crear más ventas para comenzar a ver
                datos en la gráfica!
            </div>
            @endif
        </div>

        <!-- Gráfica 4 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartReport" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if($totalStock == null)
            <div class="alert alert-warning mt-3">
                <strong>No hay productos en el stock.</strong> ¡Puedes agregar productos para comenzar a ver datos en la
                gráfica!
            </div>
            @endif
        </div>

        <!-- Gráfica 5 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartTopUsers" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($TopUserData) == 0)
            <div class="alert alert-warning mt-3">
                <strong>No hay reportes de ventas de usuarios.</strong> ¡Puedes crear ventas para comenzar a ver datos en la
                gráfica!
            </div>
            @endif
        </div>

        <!-- Gráfica 6 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartIngresos" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if($totalMoney == null)
            <div class="alert alert-warning mt-3">
                <strong>No hay Ingresos.</strong> ¡Puedes agregar ventas para comenzar a ver datos en la
                gráfica!
            </div>
            @endif
        </div>
        <!-- Gráfica 7 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartTendenciaAnual" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($salesMonths) == null)
            <div class="alert alert-warning mt-3">
                <strong>No hay datos de ventas anuales.</strong> ¡Puedes crear ventas para comenzar a ver datos en la
                gráfica!
            </div>
            @endif
        </div>
        <!-- Gráfica 8 -->
        <div class="col-12 col-md-6 mt-1">
            <div class="owl-carousel">
                <div class="item">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="chartTipoPago" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($ventasTipoPago) == 0)
            <div class="alert alert-warning mt-3">
                <strong>No hay reportes de ventas Tipo Pago recientes.</strong> ¡Puedes crear ventas para comenzar a ver datos en la
                gráfica!
            </div>
            @endif
        </div>
    </div>
</div>
@include('livewire.reports.scripts')
@endsection
