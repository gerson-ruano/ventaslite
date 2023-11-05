<div class="row">
    <div class="col-sm-12">
        <div>
            <div class="connect-sorting">

                {{--<h5 class="text-center mb-3">Resumen de venta</h5>

                <div class="connect-sorting-content">
                    <div class="car simple-ttle-task ui-sortable-handle">
                        <div class="card-body">
                            <div class="task-header">
                                <h2>TOTAL: Q {{number_format($total,2) }}</h2>
                                <input type="hidden" id="hiddenTotal" value="{{$total}}">
                            </div>
                            <div>
                                <h4 class="mt-3">Articulos: {{ $itemsQuantity }}</h4>
                            </div>
                        </div>
                    </div>
                </div>--}}

                @include('partials.select_filtro', ['tam' => '12','title' => 'Tipo Pago', 'model' => 'tipoPago', 'valores' => $valores])

                @include('partials.select_filtro', ['tam' => '12','title' => 'Tipo de Cliente', 'model' => 'vendedorSeleccionado', 'valores' => $vendedores])
                {{--<div class="col-sm-12">
                    <h6 class="text-center">Elige Vendedor o Cliente</h6>
                    <div class="form-group">
                        <select wire:model="vendedorSeleccionado" class="form-control">
                            <option value="0">Seleccionar</option>
                            <option value="Cliente">==Cliente Final==</option>
                            @foreach($vendedores as $vendedor)
                            <option value="{{$vendedor->name}}">{{$vendedor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
