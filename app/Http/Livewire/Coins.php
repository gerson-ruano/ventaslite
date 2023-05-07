<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Denomination;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Coins extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $componentName, $pageTitle, $selected_id, $image, $search;

    private $pagination = 3;
    
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->componentName = 'Denominaciones';
        $this->pageTitle = 'Listado';
        $this->selected_id = 0;

    }

    public function render()
    {
        return view('livewire.denominations.component', 
        ['data' => Denomination::paginate($this->pagination)])
        ->extends('layouts.theme.app')
        ->section('content');
    }
}
