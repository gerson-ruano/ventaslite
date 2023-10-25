<div class="row sales layout-top-spacing">
    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <h4 class="card-title mb-4 mb-md-0">
                <b>{{ $componentName }} | {{ $pageTitle }}</b>
            </h4>
            <div class="widget-heading mb-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div class="col-md-6 mb-md-4" style="width: 1200px;">
                        @can('User_Search')
                        @include('common.searchbox')
                        @endcan
                    </div>

                    @include('partials.select_filtro', ['title' => 'de Perfil', 'model' => 'perfilSeleccionado', 'valores' => $valores])

                    @can('User_Create')
                    <div class="mb-3 mb-md-0">
                        @include('partials.agregar', ['textButton' => 'Agregar'])
                    </div>
                    @endcan
                </div>
            </div>
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">USUARIO</th>
                                <th class="table-th text-white text-center">TELEFONO</th>
                                <th class="table-th text-white text-center">EMAIL</th>
                                <th class="table-th text-white text-center">ESTADO</th>
                                <th class="table-th text-white text-center">PERFIL</th>
                                <th class="table-th text-white text-center">IMAGEN</th>
                                <th class="table-th text-white text-center">ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('partials.result', ['result' => $data, 'name' => $componentName])
                            @foreach($data as $r)
                            <tr>
                                <td>
                                    <h6>{{ $r->name }}</h6>
                                </td>
                                <td class="text-center">
                                    @if($r->phone > 0)
                                    <h6>{{ $r->phone }}</h6>
                                    @else
                                    <h6>Sin numero</h6>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <h6>{{ $r->email }}</h6>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $r->status == 'Active' ? 'badge-success' : 'badge-danger'}} text-uppercase">{{ $r->status }}</span>
                                </td>
                                <td class="text-center text-uppercase">
                                    <h6><B>{{ $r->profile }}<B></h6>
                                </td>
                                <td class="text-center">
                                    {{--@if($r->imagen != null)
                                    <img src="{{ asset('storage/users/' . $r->imagen ) }}" alt="imagen"
                                    class="card-img-top img-fluid">
                                    @endif--}}
                                    <img src="{{ $r->imagen }}" alt="imagen de ejemplo" height="70" width="80"
                                        class="rounded">
                                </td>

                                <td class="text-center">
                                    @can('User_Update')
                                    <a href="javascript:void(0)" wire:click="edit({{$r->id}})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                        @endcan
                                    </a>

                                    @can('User_Destroy')
                                    <a href="javascript:void(0)" onclick="Confirm('{{$r->id}}')" class="btn btn-dark "
                                        title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endcan
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
    @include('livewire.users.form')
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.livewire.on('user-added', Msg => {
        $('#theModal').modal('hide')
        noty(Msg)
    })
    window.livewire.on('user-updated', Msg => {
        $('#theModal').modal('hide')
        noty(Msg)
    })
    window.livewire.on('user-deleted', Msg => {
        $('#theModal').modal('hide')
        noty(Msg)
    })
    window.livewire.on('hide-modal', Msg => {
        $('#theModal').modal('hide')
    })
    window.livewire.on('show-modal', Msg => {
        $('#theModal').modal('show')
    })
    window.livewire.on('user-withsales', Msg => {
        noty(Msg)
    })

});

function Confirm(id) {

    swal({
        title: "QUE DESEA REALIZAR?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "SI, ELIMINAR!",
        closeOnConfirm: false
    }).then(function(result) {
        if (result.value) {
            window.livewire.emit('destroy', id)
            swal.close()
        }
    });

}
</script>
