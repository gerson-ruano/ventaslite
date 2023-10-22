{{--<div class="col-md-3 mb-3 mb-md-2">
    <h6 class="text-center">Filtrar Perfil</h6>
    <div class="form-group">
        <select wire:model="perfilSeleccionado" class="form-control">
            <option value="0">Seleccionar</option>
            <option value="Admin">ADMINISTRADOR</option>
            <option value="Employee">EMPLEADO</option>
            <option value="Vendedor">VENDEDOR</option>
            <option value="Soporte">SOPORTE</option>
            <option value="Invitado">INVITADO</option>
        </select>
    </div>
</div>--}}

<div class="col-md-3 mb-3 mb-md-2">
    <h6 class="text-center">{{$title}}</h6>
    <div class="form-group">
        <select wire:model="perfilSeleccionado" class="form-control">
            <option value="0">Seleccionar</option>
            @foreach ($valores as $valor)
                <option value="{{ $valor }}">{{ $valor }}</option>
            @endforeach
        </select>
    </div>
</div>