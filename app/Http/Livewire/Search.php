<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Search extends Component
{

    public $search = '';
    
    public function render()
    {
        return view('livewire.search');
    }

    public function submitSearch()
    {
        // Captura el código ingresado
        $barcode = $this->search;

        // Emite un evento al otro componente y pasa el código como dato
        $this->emit('scan-code', $barcode);

        // Restablece el valor del campo de búsqueda
        $this->search = '';
        //dd($barcode);
    }


}
