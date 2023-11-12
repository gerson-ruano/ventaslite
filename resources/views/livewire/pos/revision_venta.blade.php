<div class="row mt-2">
    <div class="col-sm-12 justify-content-center d-flex">
        <div class="">
            <div class="connect-sorting">
                <h5 class="text-center">Resumen de venta #</h5>
                <div class="connect-sorting-content">
    <div class="car simple-ttle-task ui-sortable-handle">
        <div class="card-body d-flex justify-content-between">
            <div class="task-header">
                @if($vendedorSeleccionado != 0)
                    <h6>Nombre: {{$vendedorSeleccionado}}</h6>
                @else
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Nombre:</h6>
                        <h6 class="text-primary mb-0" style="margin-left: 10px;">C/F</h6>
                    </div>
                @endif
                @if($tipoPago != 0)
                    <h6>Pago: {{$tipoPago}}</h6>
                @else
                    <div class="d-flex align-items-center">
                        <h6 class="text-center mb-0">Pago:</h6>
                        <h6 class="text-danger mb-0" style="margin-left: 10px;">INGRESAR!!</h6>
                    </div>
                @endif
            </div>
            <div class="text-right">
                <h6>Efectivo: Q {{number_format($efectivo, 2)}}</h6>
                @if($total > 0)
                    <h6 class="">Total: Q {{ number_format($total, 2) }}</h6>
                    <input type="hidden" id="hiddenTotal" value="{{$total}}">
                    @if($change > 0)
                        <h6 class="">Cambio: Q {{ number_format($change, 2) }}</h6>
                    @elseif($change == 0)
                        <h6 class="text-muted">SIN CAMBIO</h6>
                    @else
                        <h6 class="text-danger">Falta Q {{ number_format(-$change, 2) }}</h6>
                    @endif
                    <h6 class="">Artículos: {{ $itemsQuantity }}</h6>
                @else
                    <h6 class="text-muted">No hay productos en la venta</h6>
                @endif
            </div>
        </div>
    </div>
</div>

                <table class="table table-striped table-bordered">
                    <thead class="table-secondary">
                        <tr>
                            <th class="text-left">No.</th>
                            <th class="text-left">DESCRIPCION</th>
                            <th class="text-center">PRECIO</th>
                            <th class="text-center">CANTIDAD</th>
                            <th class="text-center">IMPORTE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td class="text-center">
                                <p>{{ $loop->index + 1 }}</p>
                            </td>
                            <td>
                                <p>{{ $item->name }}</p>
                            </td>
                            <td class="text-center">
                                <p>Q{{ number_format($item->price, 2) }}</p>
                            </td>
                            <td class="text-center">
                                <p>{{ $item->quantity }}</p>
                            </td>
                            <td class="text-center">
                                <p>Q{{ number_format($item->price * $item->quantity, 2) }}</p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-info">
                        <tr>
                            <td colspan="2"><b>TOTALES:</b></td>
                            <td class="text-center"><strong>Q{{ number_format($cart->sum('price'), 2) }}</strong></td>
                            <td class="text-center"><strong>{{ $cart->sum('quantity') }}</strong></td>
                            <td class="text-center"><strong>Q{{ number_format($total, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <button wire:click="saveSale" class="btn btn-dark">Finalizar Venta</button>
                <button onclick="window.print();" class="btn btn-dark">Imprimir</button>
                <a href="{{ url('pos') }}" class="btn btn-dark">Retornar</a>
            </div>
        </div>

    </div>
</div>


<!DOCTYPE html>
<html>

<head>
    <style>
    @media print {
        /* Define estilos de impresión */
        /* Por ejemplo, ocultar elementos de navegación, ajustar márgenes, etc. */
    }
    </style>
</head>

<body>
    <!-- Contenido de revisión de venta -->
    <h2>Venta #</h2>
    <!-- Mostrar detalles de la venta, productos, cantidades, precios, etc. -->
    <p>Total: Q. {{ $total }}</p>
    <p>Articulos: {{ $itemsQuantity }}
    <p>


</body>

</html>
{{--@include('livewire.pos.component')--}}