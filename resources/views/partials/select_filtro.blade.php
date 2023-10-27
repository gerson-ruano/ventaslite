<div class="col-sm-{{$tam}}">
    <h6 class="text-center">Filtro {{$title}}</h6>
    <div class="form-group">
        <select wire:model="{{$model}}" class="form-control">
            <option value="0">Seleccionar</option>
            @foreach ($valores as $valor)
                <option value="{{ $valor }}">{{ $valor}}</option>
            @endforeach
        </select>
        @error('{{$model}}') <span class="text-danger">{{$message}}</span>@enderror
    </div>
</div>
