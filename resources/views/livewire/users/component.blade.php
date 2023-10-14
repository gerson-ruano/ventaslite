<div class="row sales layout-top-spacing">
    <div class="col-sm-12">

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                @can('User_Create')
                @include('partials.agregar', ['textButton' => 'Agregar'])
                @endcan
            </div>
            @can('User_Search')
            @include('common.searchbox')
            @endcan
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">USUARIO</th>
                                <th class="table-th text-white text-center">TELEFONO</th>
                                <th class="table-th text-white text-center">EMAIL</th>
                                <th class="table-th text-white text-center">ESTATUS</th>
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
                                    <h6>{{ $r->phone }}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{ $r->email }}</h6>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="badge {{ $r->status == 'Active' ? 'badge-success' : 'badge-danger'}} text-uppercase">{{ $r->status }}</span>
                                </td>
                                <td class="text-center text-uppercase">
                                    <h6>{{ $r->profile }}</h6>
                                </td>
                                <td class="text-center">
                                    @if($r->image != null)
                                    <img src="{{ asset('storage/users/' . $r->image ) }}" alt="imagen"
                                        class="card-img-top img-fluid">
                                    @endif
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
