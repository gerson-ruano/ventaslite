<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-heading">
                <h4 class="card-title text-center"><b>{{$componentName}}</b></h4>
            </div>
            <div class="widget-content">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <h6>Elige el usuario</h6>
                                <div class="form-group">
                                    <select wire:model="userId" class="form-control">
                                        <option value="0">Todos</option>
                                        {{--dd($users)--}}
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h6>Elige el tipo de reporte</h6>
                                <div class="form-group">
                                    <select wire:model="reportType" class="form-control">
                                        <option value="0">Ventas del día</option>
                                        <option value="1">Ventas por fechas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha desde</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateFrom" class="form-control flatpickr"
                                        placeholder="Click para elegir" @if ($reportType==0) disabled @endif>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <h6>Fecha hasta</h6>
                                <div class="form-group">
                                    <input type="text" wire:model="dateTo" class="form-control flatpickr"
                                        placeholder="Click para elegir" @if ($reportType==0) disabled @endif>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button wire:click="$refresh" class="btn btn-dark btn-block">
                                    Consultar
                                </button>

                                <a class="btn btn-dark btn-block {{count($data) <1 ? 'disabled' : '' }}"
                                    href="{{ url('report/pdf' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                                    target="_blank">Generar PDF</a>

                                <a class="btn btn-dark btn-block {{count($data) <1 ? 'disabled' : '' }} mb-3"
                                    href="{{ url('report/excel' . '/' . $userId . '/' . $reportType . '/' . $dateFrom . '/' . $dateTo) }}"
                                    target="_blank">Exportar a EXCEL</a>
                                @include('partials.select_filtro', ['tam' => '12 mb-md-0', 'title' => 'Estado de Pago',
                                'model' => 'selectTipoEstado', 'valores' => $valores])
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <!---TABLA-->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mt-1">
                                <thead class="text-white" style="background: #3B3F5C">
                                    <tr>
                                        <th class="table-th text-white text-center">VENTA</th>
                                        <th class="table-th text-white text-center">TOTAL</th>
                                        <th class="table-th text-white text-center">CANTIDAD</th>
                                        <th class="table-th text-white text-center">ESTADO</th>
                                        <th class="table-th text-white text-center">USUARIO</th>
                                        <th class="table-th text-white text-center">VENDEDOR</th>
                                        <th class="table-th text-white text-center">FECHA Y HORA</th>
                                        <th class="table-th text-white text-center">DETALLES</th>
                                        @can('Ventas_Update')
                                        <th class="table-th text-white text-center">EDITAR</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('partials.result', ['result' => $data, 'name' => $componentName])
                                    {{--dd($datos)--}}
                                    @foreach($data as $d)
                                    <tr>
                                        <td class="text-center">
                                            <h6>{{ $d->id }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6>Q. {{number_format($d->total,2)}}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ $d->items }}</h6>
                                        </td>

                                        <td class="text-center">
                                            <span
                                                class="badge badge-{{ $d->status === 'PAID' ? 'success' : ($d->status === 'CANCELLED' ? 'danger' : ($d->status === 'PENDING' ? 'primary' : 'secondary')) }} custom-badge text-uppercase">
                                                {{ $d->status }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ $d->user }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ $d->vendedor }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6>{{ \Carbon\Carbon::parse($d->created_at)->format('d-m-Y H:i:s') }}</h6>
                                        </td>
                                        <td class="text-center" width="6%">
                                            <button wire:click.prevent="getDetails({{ $d->id }})"
                                                class="btn btn-dark btn-sm" title="Detalles">
                                                <i class="fas fa-list"></i>
                                            </button>
                                        </td>
                                        @can('Ventas_Update')
                                        <td class="text-center" width="6%">
                                            <a href="javascript:void(0)" wire:click="Edit({{ $d->id }})"
                                                class="btn btn-dark btn-sm" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        @endcan
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(isset($data) && $data instanceof \Illuminate\Pagination\LengthAwarePaginator &&
                            $data->total() > 0)
                            {{ $data->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.reports.sales-detail')
    @include('livewire.reports.form')
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr(document.getElementsByClassName('flatpickr'), {
        enableTime: false,
        dateFormat: 'Y-m-d',
        locale: {
            firstDayofWeek: 1,
            weekdays: {
                shorthand: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"],
                longhand: [
                    "Domingo",
                    "Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado",
                ],
            },
            months: {
                shorthand: [
                    "Ene",
                    "Feb",
                    "Mar",
                    "Abr",
                    "May",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dic",
                ],
                longhand: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                ],
            },
        }
    })

    //Eventos 
    window.livewire.on('show-modal', Msg => {
        $('#modalDetails').modal('show')
    })
    window.livewire.on('venta-updated', msg => {
        $('#theModal').modal('hide');
    });
    window.livewire.on('show', msg => {
        $('#theModal').modal('show');
    });
    window.livewire.on('modal-hide', msg => {
        $('#theModal').modal('hide');
    });
    window.livewire.on('sale-error', Msg => {
            noty(Msg)
    })
})


document.addEventListener('livewire:load', function() {
    Livewire.on('venta-updated', message => {
        // Muestra la alerta utilizando SweetAlert (o tu biblioteca preferida)
        swal({
            position: "top-end",
            type: "success",
            title: message,
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            // Realiza alguna acción adicional si es necesario
            // Por ejemplo, redireccionar a otra página
            Livewire.emit('redirectPos');
        });
    });
});

</script>
