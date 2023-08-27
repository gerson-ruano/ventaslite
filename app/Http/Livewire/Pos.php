<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Denomination;
use Darryldecode\Cart\Facades\CartFacade as Cart;


class Pos extends Component

{

    public $total, $itemsQuatity, $efectivo, $change;

    public function mount()
    {
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }


    public function render()
    {
        return view('livewire.pos.component', [
            'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart' => Cart::getContent()->sortBy('name')
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function ACash($value)
    {
        $this->efectivo +- ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $ths->total);
    }

    protected $listener =[
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale'
    ];

    public function ScanCode($barcode, $cant = 1)
    {
        $product = Product::where('barcode', $barcode)->first();

        if($product == null || empty($empy))
        {
            $this->emit('scan-notfound','El producto no esta registrado');
        }else{
            if($this->InCart($product->id))
            {
                $this->increaseQty($product->id);
                return;
            }
            if($product->stock <1)
            {
                $this->emit('no-stock','Stock insuficiente :/');
                return;
            }

            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            $this->total = Cart::getTotal();

            $this->emit('scan-ok','Producto Agregado');
        }
    }

    public function InCart($productId)
    {
        $exist = Cart::get($productId);
        if($exist)
            return true;
        else 
            return false;
    }

}
