<div class="row sales layout-top-spacing">
    <div class="col-sm-12">

        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                <!--ul class="tabs tab pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                            data-target="#themodal">Agregar</a>
                    </li>
                </ul>
                <ul class="tabs tab-pills">
                    <li>
                        <button class="tabmenu bg-dark btn" data-toggle="modal" data-target="#theModal">Agregar</button>
                    </li>
                </ul-->
                @can('Role_Create')
                @include('partials.agregar', ['textButton' => 'Agregar'])
                @endcan
            </div>
            @can('Role_Search')
            @include('common.searchbox')
            @endcan

            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">ID</th>
                                <th class="table-th text-white text-center">DESCRIPCION</th>
                                <th class="table-th text-white text-center">ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                        @include('partials.result', ['result' => $roles, 'name' => $componentName])
                            @foreach($roles AS $role)
                            <tr>
                                <td>
                                    <h6>{{$role->id}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$role->name}}</h6>
                                </td>
                                
                                <td class="text-center">
                                    @can('Role_Update')
                                    <a href="javascript:void(0)" wire:click="Edit({{$role->id}})"
                                        class="btn btn-dark mtmobile" title="Editar Registro">
                                        <i class="fas fa-edit"></i>
                                        @endcan
                                    </a>
                                    
                                    @can('Role_Destroy')
                                    <a href="javascript:void(0)" onclick="Confirm('{{$role->id}}')"
                                        class="btn btn-dark " title="Eliminar Registro">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$roles->links()}}
                </div>

            </div>
        </div>

    </div>
    @include('livewire.roles.form')
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.livewire.on('role-added', Msg => {
        $('#theModal').modal('hide')
        noty(Msg)
    })

    window.livewire.on('role-updated', Msg => {
        $('#theModal').modal('hide')
        noty(Msg)
    })

    window.livewire.on('role-deleted', Msg => {
        noty(Msg)
    })

    window.livewire.on('role-exists', Msg => {
        noty(Msg)
    })

    window.livewire.on('role-error', Msg => {
        noty(Msg)
    })

    window.livewire.on('hide-modal', Msg => {
        $('#theModal').modal('hide')
        noty(Msg)
    })

    window.livewire.on('show-modal', Msg => {
        $('#theModal').modal('show')
    })

    /*window.livewire.on('hidden.bs.modal', Msg => {
        $('.er').css('display', 'none')
    })*/
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