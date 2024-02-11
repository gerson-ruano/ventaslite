@include('common.modalHead')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="form-group text-center">
                <label>Estado</label>
                <select wire:model="selectedStatus" class="form-control">
                    <option value="Elegir">Elegir</option>
                    <option value="PAID">PAID</option>
                    <option value="PENDING">PENDIENTE</option>
                    <option value="CANCELLED">CANCELADO</option>
                </select>
                @error('type')
                <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    
    {{--@include('partials.select_filtro', ['tam' => '6', 'title' =>'Estado','model' => 'tipoPago', 'valores' => $status])--}}
    </div>
        <div class="modal-footer">
            <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info"
                data-dismiss="modal">CERRAR</button>
            <button type="button" wire:click.prevent="Update()" class="btn btn-dark close-modal">ACTUALIZAR</button>
        </div>
    </div>
</div>
</div>

