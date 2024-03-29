<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{ $componentName }} | {{ $pageTitle }}</b>
                </h4>
                @can('Category_Create')
                @include('partials.agregar', ['textButton' => 'Agregar'])
                @endcan
            </div>
            @can('Category_Search')
            @include('common.searchbox')
            @endcan
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">DESCRIPCION</th>
                                <th class="table-th text-white text-center">IMAGEN</th>
                                <th class="table-th text-white text-center">ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include('partials.result', ['result' => $categories, 'name' => $componentName])

                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    <h6>{{ $category->name }}</h6>
                                </td>
                                <td class="text-center">
                                    <span>
                                        {{--<img src="{{ asset('storage/categories/' . $category->imagen) }}"
                                        alt="imagen de ejemplo" height="70" width="80" class="rounded">--}}
                                        <img src="{{ $category->imagen }}" alt="imagen de ejemplo" height="70"
                                            width="80" class="rounded">
                                    </span>
                                </td>

                                <td class="text-center">
                                    @can('Category_Update')
                                    <a href="javascript:void(0)" wire:click="Edit({{ $category->id }})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                        @endcan
                                    </a>

                                    @can('Category_Destroy')
                                    <a href="javascript:void(0)"
                                        onclick="Confirm('{{ $category->id }}','{{ $category->products->count() }}')"
                                        class="btn btn-dark " title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endcan
                                    {{--$category->imagen--}}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>

            </div>
        </div>

    </div>
    @include('livewire.category.form')
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    window.livewire.on('show-modal', msg => {
        $('#theModal').modal('show');
    });
    window.livewire.on('category-added', msg => {
        $('#theModal').modal('hide');
    });
    window.livewire.on('category-updated', msg => {
        $('#theModal').modal('hide');
    });
});

function Confirm(id, products) {

    if (products > 0) {
        swal.fire({
            title: 'No se puede eliminar la categoría',
            text: 'Tiene productos existentes',
            type: 'warning'
        });
        return;
    }
    swal({
        title: "DESEA ELIMINAR LA CATEGORIA?",
        //text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ELIMINAR!",
        cancelButtonColor: "#A9A9A9",
        cancelButtonText: 'CANCELAR',
        closeOnConfirm: false
    }).then(function(result) {
        if (result.value) {
            window.livewire.emit('deleteRow', id)
            //swal("Deleted!", "Your imaginary file has been deleted.", "success");
            swal.close()
        }
    });

}
</script>