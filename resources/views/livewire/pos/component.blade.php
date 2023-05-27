<div>
    <style></style>


    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            {{--Detalles--}}
            @include('livewire.pos.partial.detail')
        </div>

        <div class="col-sm-12 col-md-4">
           {{--Total--}}
           @include('livewire.pos.partial.total')

           {{--Denominacion--}}
           @include('livewire.pos.partial.coins')

        </div>
    </div>
</div>
