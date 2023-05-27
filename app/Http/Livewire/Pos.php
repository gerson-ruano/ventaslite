<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Denomination;

class Pos extends Component
{

    public $total = 1, $itemsQuatity, $denominations = [], $cart = [], $efectivo, $change;
    public function render()
    {
        $this->denominations = Denomination::all();
        return view('livewire.pos.component')->extends('layouts.theme.app')->section('content');
    }
}
