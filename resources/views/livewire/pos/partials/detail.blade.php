<div class="connect-sorting">
    <div class="connect-sortint-contect">
        <div class="card simple-title-task">
            <div class="class-card-body">
                @if($total > 0)
                <div class="table-responsive-tblscroll" id="tbscroll" style="max-height: 650px
            overflow: hidden">
                    <table class=" table table-bordered table-striped mt-1 mb-2">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th width="10%"></th>
                                <th class="table-th text-left text-white">DESCRIPCION</th>
                                <th class="table-th text-left text-white">PRECIO</th>
                                <th width="13%" class="table text-center text-white">CANTIDAD</th>
                                <th class="table-th text-center text-white" width="20%">IMPORTE</th>
                                <th class="table-th text-center text-white">ACCION</th>
                            </tr>
                        </thead>
                        @php
                        $totalProduct = count($cart);
                        @endphp
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td class="text-center table-th">
                                    @if(isset($item->attributes[0]))
                                    @php
                                    $imagenPath = public_path('storage/products/' . $item->attributes[0]);
                                    @endphp

                                    @if (is_file($imagenPath))
                                    <img src="{{ asset('storage/products/' . $item->attributes[0]) }}"
                                        alt="imagen de producto" height="50" width="50" class="rounded">
                                    @else
                                    <img src="{{ asset('assets/img/noimg.jpg') }}" alt="imagen por defecto" height="50"
                                        width="50" class="rounded">
                                    @endif
                                    @else
                                    <img src="{{ asset('assets/img/noimg.jpg') }}" alt="imagen por defecto" height="50"
                                        width="50" class="rounded">
                                    @endif
                                </td>

                                <td>
                                    </h6>{{$item->name}}</h6>
                                </td>
                                <td class="text-center">{{number_format($item->price,2)}}</td>
                                <td>
                                    <input type="number" id="r{{$item->id}}"
                                        wire:change="updateQty({{$item->id}}, $('#r' + {{$item->id}}).val() )"
                                        style="font-size: 1rem!important" class="form-control text-center"
                                        value="{{$item->quantity}}">
                                </td>

                                <td class="text-center">
                                    <h6>
                                        Q.{{number_format($item->price * $item->quantity,2)}}
                                    </h6>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex flex-column flex-sm-row justify-content-center">
                                        <button
                                            onclick="Confirm('{{$item->id}}', 'removeItem', '¿Confirmas eliminar el registro?')"
                                            class="btn btn-dark mbmobile mr-1">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button wire:click.prevent="increaseQty({{$item->id}})"
                                            class="btn btn-dark mbmobile mr-1">
                                            <i class="fas fa-plus-square"></i>
                                        </button>
                                        <button wire:click.prevent="decreaseQty({{$item->id}})"
                                            class="btn btn-dark mbmobile mr-1">
                                            <i class="fas fa-minus-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-warning text-center mb-0">
                    <h5><i class="fas fa-info-circle"></i> No hay productos en la venta</h5>
                    <p>Agrega productos, ingresando el CODIGO respectivo ejem. #205</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@if($itemsQuantity > 0)
<div class="col-12 mt-4 mb-3">
    <div class="connect-sorting">
        <h5 class="text-center">Resumen de venta #</h5>
        <div class="connect-sorting-content">
            <div class="car simple-ttle-task ui-sortable-handle">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="task-header">
                                @if($vendedorSeleccionado != 0)
                                <h6>Nombre: {{$vendedorSeleccionado}}</h6>
                                @else
                                <div class="d-flex align-items-center mb-1">
                                    <h6 class="mb-0">Nombre:</h6>
                                    <h6 class="text-primary mb-0" style="margin-left: 10px;"> C/F</h6>
                                </div>
                                @endif
                                @if($tipoPago != 0)
                                <h6>Pago: {{$tipoPago}}</h6>
                                @else
                                <div class="d-flex align-items-center">
                                    <h6 class="text-center mb-0">Pago:</h6>
                                    <h6 class="text-danger mb-0" style="margin-left: 10px;">INGRESAR PAGO!!</h6>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                @if($efectivo == 0 || is_null($efectivo))
                                <h6 class="text-danger">INGRESAR! EFECTIVO</h6>
                                @else
                                <h6>Efectivo: Q {{number_format($efectivo, 2)}}</h6>
                                @endif
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
                                <h6 class="">Productos: {{ $totalProduct }}</h6>
                                <h6 class="">Artículos: {{ $itemsQuantity }}</h6>
                                @else
                                <h6 class="text-muted">No hay productos en la venta</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        @can('Ventas_Create')
                        <button wire:click="saveSale" class="btn btn-dark d-print-none">Finalizar Venta</button>
                        @endcan
                        <button wire:click="revisarVenta" class="btn btn-dark d-print-none" @if ($tipoPago==0 ||
                            $efectivo < $total) disabled @endif>Detalles Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

