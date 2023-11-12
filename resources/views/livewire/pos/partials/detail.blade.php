<div class="connect-sorting">

    <div class="connect-sortint-contect">
        <div class="card simple-title-task">
            <div class="class-card-body">
                @if($total > 0)
                <div class="table-responsive-tblscroll" style="max-height: 650px
            overflow: hidden">
                    <table class=" table table-bordered table-striped mt-1 mb-0">
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
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td class="text-center table-th">
                                    @if(count($item->attributes) > 0)
                                    <span>
                                        @php
                                        $imagenPath = public_path('storage/products/' . $item->attributes[0]);
                                        @endphp

                                        @if (is_file($imagenPath))
                                        <img src="{{ asset('storage/products/' . $item->attributes[0]) }}"
                                            alt="imagen de producto" height="50" width="50" class="rounded">
                                        @else
                                        <img src="{{ asset('storage/products/noimg.jpg') }}" alt="imagen de ejemplo"
                                            height="70" width="80" class="rounded">
                                        @endif
                                    </span>
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
                                            class="btn btn-dark mbmobile">
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
                    <p>Agrega productos para continuar.</p>
                </div>
                @endif

                <div wire:loading.inline wire:target="saveSale">
                    <h3 class="text-danger text-center">Guardando Venta...</h3>
                </div>

            </div>
        </div>
    </div>
</div>