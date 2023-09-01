<div>
    <style></style>


    <div class="row layout-top-spacing">
        <div class="col-sm-12 col-md-8">
            {{--Detalles--}}
            @include('livewire.pos.partials.detail')
        </div>

        <div class="col-sm-12 col-md-4">
           {{--Total--}}
           @include('livewire.pos.partials.total')

           {{--Denominacion--}}
           @include('livewire.pos.partials.coins')

        </div>
    </div>
    {{--SCRIPTS--}}
    @include('livewire.pos.scripts.events')
    @include('livewire.pos.scripts.general')
    {{--@include('livewire.pos.scripts.scan')--}}
    @include('livewire.pos.scripts.shortcuts')
</div>
