<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                @can('Denominaciones_Create')
                @include('livewire.Agregar', ['textButton' => 'Agregar'])
                @endcan
            </div>
            @can('Denominaciones_Search')
            @include('common.searchbox')
            @endcan

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">TIPO</th>
                                <th class="table-th text-white text-center">VALOR</th>
                                <th class="table-th text-white text-center">IMAGEN</th>
                                <th class="table-th text-white text-center">ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $coin)
                                <tr>
                                    <td>
                                        <h6>{{ $coin->type }}</h6>
                                    </td>
                                    <td>
                                        <h6 class="text-center">Q {{ number_format($coin->value, 2) }}</h6>
                                    </td>
                                    <td class="text-center">
                                        <span>
                                            {{--<img src="{{ asset('storage/' . $coin->imagen) }}" alt="imagen de ejemplo"
                                                height="70" width="80" class="rounded">--}}
                                                <img src="{{ $coin->imagen }}" alt="imagen de ejemplo" height="70" width="80" class="rounded">
                                        </span>
                                    </td>
                                    <td class="text-center">
                                    @can('Denominaciones_Update')
                                        <a href="javascript:void(0)" wire:click="Edit({{ $coin->id }})"
                                            class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                            @endcan
                                        </a>

                                        @can('Denominaciones_Destroy')
                                        <a href="javascript:void(0)" onclick="Confirm('{{ $coin->id }}')"
                                            class="btn btn-dark " title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        @endcan
                                        {{-- $category->imagen --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>

            </div>
        </div>

    </div>
    @include('livewire.denominations.form')
</div>

<script>
    function Confirm(id) {
            swal({
                title: "QUE DESEA REALIZAR?",
                //text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI, ELIMINAR!",
                closeOnConfirm: false
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteRow', id)
                    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    swal.close()
                }
            });

        }
    document.addEventListener('DOMContentLoaded', function() {

        window.livewire.on('item-added', msg => {
            $('#theModal').modal('hide');
        });
        window.livewire.on('item-updated', msg => {
            $('#theModal').modal('hide');
        });
        window.livewire.on('item-deleted', msg => {
            //notificacion
        });
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show');
        });
        window.livewire.on('modal-hide', msg => {
            $('#theModal').modal('hide');
        });

        $('#theModal').on('hidden.bs.modal', function() {
            $('.er').css('display', 'none')
        });


        /*window.livewire.on('hidden.bs.modal', msg => {
            $('.er').css('display', 'none')
        });*/
    });
</script>
