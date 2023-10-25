<div class="col-md-3 mb-3 mb-md-2">
    <h6 class="text-center">Filtro {{$title}}</h6>
    <div class="form-group">
        <select wire:model="{{$model}}" class="form-control">
            <option value="0">Seleccionar</option>
            @foreach ($valores as $valor)
                <option value="{{ $valor }}">{{ $valor }}</option>
            @endforeach
        </select>
    </div>
</div>
