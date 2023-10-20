<div class="row mt-3">

    <div class="col-sm-12">
        <div class="connect-sorting">

            <h5 class="text-center mb-2">BILLETES</h5>

            <div class="container">
                <div class="row">
                    @foreach ($denominations as $d)
                    <div class="col-sm mt-2">
                        <button wire:click.prevent="ACash({{ $d->value }})" class="btn btn-dark btn-block den">
                            {{ $d->value > 0 ? 'Q ' . number_format($d->value,2, '.', '') : 'Exacto' }}
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="connect-sorting-content mt-4">
                <div class="card simple-title-task ui-sortable-handle">
                    <div class="card-body">
                        <div class="input-group input-group-md mb-3">
                            <div class="input-group prepend">
                                <span class="input-group-text input-gp hideonsm" style="background: #3B3F5C; 
                                    color:white">Efectivo F8
                                </span>
                            </div>
                            <input type="number" id="cash" wire:model="efectivo" wire:keydown.enter.prevent="savesSale"
                                class="form-control text-center" value="{{$efectivo}}">
                        </div>
                        <div class="input-group-append">
                            <span wire:click="$set('efectivo', 0); $set('change', 0)" class="input-group-text" style="background: #3B3F5C; 
                                color:white">
                                <i class="fas fa-backspace fa-2x"></i>
                            </span>
                        </div>
                    </div>

                    @if($total > 0 && $change > 0)
                    <h4 class="text-muted">Cambio: Q {{number_format($change,2)}}</h4>
                    @else
                    <h4 class="text-muted">SIN CAMBIO</h4>
                    @endif

                    <div class="row justify-content-between mt-5">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            @if($total > 0)
                            <button onclick="Confim(0,'clearCart','¿SEGURO DE ELIMINAR EL CARRITO')"
                                class="btn btn-dark mtmobile">
                                CANCELAR F4
                            </button>
                            @endif
                        </div><br>

                        {{--<div class="col-sm-12 col-md-12 col-lg-6">
                        @if($efectivo >= $total && $total > 0)
                        <a href="{{ url('report/venta' . '/' . $cart) }}" target="_blank" class="btn btn-dark btn-md
                        mtmobile">
                        IMPRIMIR VENTA
                        </a>
                        @endif
                    </div>--}}

                    <div class="col-sm-12 col-md-12 col-lg-6">
                        @if($efectivo >= $total && $total > 0)
                        @can('Ventas_Create')
                        <button wire:click.prevent="saveSale" class="btn btn-dark btn-md btn-block">
                            GUARDAR F6
                        </button>
                        @endcan

                        {{--<a class="btn btn-dark btn-block "
                                    href="{{ url('report/venta' . '/' . $total . '/' . $itemsQuantity . '/' . $efectivo . '/' . $change . '/' . $cart) }}"
                        target="_blank">Generar VENTA</a>--}}

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
function Confirm(clearcart, text) {

    console.log('Función Confirm llamada');

    swal({
        title: "QUE DESEA REALIZAR?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "SI, ELIMINAR!",
        closeOnConfirm: false
    }).then(function(result) {
        if (result.value) {
            window.livewire.emit('clearcart');
            swal.close();
        }
    });

}
</script>