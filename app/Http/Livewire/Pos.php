<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use App\Models\SaleDetails;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use App\Models\Denomination;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Product;
use DB;


class Pos extends Component

{

    public $total, $itemsQuantity, $efectivo, $change, $tipoPago, $vendedorSeleccionado;
    public $vendedores = [];

    public $revisionVenta = false;


    public function mount()
    {
        $this->efectivo = number_format($this->efectivo, 2); 
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->vendedores = User::where('profile', 'vendedor')->pluck('name');
        //$this->vendedorSeleccionado = 0;

    }


    public function render()
    {
        $valores = $this->filtroTipoPago();
        if ($this->revisionVenta) {
           
        return view('livewire.pos.revision_venta', [
            'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart' => Cart::getContent()->sortBy('name'),
            'valores' => $valores,
            ])
        ->extends('layouts.theme.app')
        ->section('content');
        } else {
        return view('livewire.pos.component', [
            'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart' => Cart::getContent()->sortBy('name'),
            'valores' => $valores,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
        }
    }


    public function filtroTipoPago(){
        return Sale::pluck('status')->unique()->toArray();
        //return $valores; lista de estados
    }

    public function revisarVenta() //Indica que vista utiliza para el index
    {
        $this->revisionVenta = true;
    }

    public function clearChange()
    {
        $this->efectivo = 0;
        $this->change = 0;
    }

    public function ACash($value)
    {
        $this->efectivo += ($value == 0 ? $this->total : (float)$value);
        $this->change = ($this->efectivo - $this->total);
    }

    protected $listeners =[
        'scan-code' => 'ScanCode',
        'removeitem' => 'removeItem',
        'clearcart' => 'clearCart',
        'savesale' => 'saveSale',
        'clearChange' => 'clearChange'
    ];

    public function ScanCode($barcode, $cant = 1)
    {
        //dd($barcode);
        $product = Product::where('barcode', $barcode)->first();

        if ($product == null || empty($product)) {
            $this->emit('scan-notfound', 'El producto no está registrado');
        } else {
            if ($this->InCart($product->id)) {
                $this->increaseQty($product->id);
                return;
            }
            if ($product->stock < 1) {
                $this->emit('no-stock', 'Stock insuficiente :/');
                return;
            }

            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', 'Producto Agregado');
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

    public function increaseQty($productId, $cant = 1)
    {
        $title='';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
            $title = 'Cantidad Actualizada';
        else
            $title = 'Producto agregado';
        if($exist)
        {
            if($product->stock < ($cant + $exist->quantity))
            {
                $this->emit('no-stock','Stock insuficiente :/');
                return;
            }
        }

        Cart::add($product->id, $product->name, $product->price, $cant, $product->image);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok','Cantidad Actualizada');
    }

    public function updateQty($productId, $cant = 1)
    {
        $title='';
        $product = Product::find($productId);
        $exist = Cart::get($productId);
        if($exist)
            $title = 'Cantidad Actualizada';
        else
            $title = 'Producto agregado';
        if($exist)
        {
            if($product->stock < $cant)
            {
                $this->emit('no-stock','Stock insuficiente :/');
                return;
            }
        }

        $this->removeItem($productId);

        if($cant > 0)
        {
            Cart::add($product->id, $product->name, $product->price, $cant, $product->image);

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', $title);
        }

        //definir else para notificar al usuario que debe ser mayor a 0

    }

    public function removeItem($productId)

    {
        //dd("Evento recibido con exito");
        Cart::remove($productId);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto Eliminado');
    }

    public function decreaseQty($productId)
    {
        $item = Cart::get($productId);
        Cart::remove($productId);

        $newQty = ($item->quantity) - 1;
        if($newQty > 0)

        Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0]);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Cantidad Actualizada');

        /*$item = Cart::get($productId);

        if ($item) {
            Cart::remove($productId);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            //Reinician los valores de TOTAL y ARTICULOS

        
            $newQty = ($item->quantity) - 1;
        
            if ($newQty > 0) {
                // Asegúrate de que `attributes` esté definido y sea un array antes de acceder a su índice 0
                $attributes = isset($item->attributes) && is_array($item->attributes) ? $item->attributes : [];
        
                Cart::add($item->id, $item->name, $item->price, $newQty, $attributes);
        
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('scan-ok', 'Cantidad Actualizada 1');
            }
        }*/
    }

    public function clearCart()
    {
        //dd("recibiendo evento");
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->tipoPago = 0;
        $this->vendedorSeleccionado = 0;
        $this->emit('scan-ok', 'Carrito vacio');
    }

    public function saveSale()
    {
        if($this->total <=0)
        {
            $this->emit('sale-error','AGREGA PRODUCTOS A LA VENTA');
            return;
        }
        if($this->efectivo <=0)
        {
            $this->emit('sale-error','INGRESA EL EFECTIVO');
            return;
        }
        if($this->total > $this->efectivo)
        {
            $this->emit('sale-error','EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
            return;
        }
        if($this->tipoPago > 0)
        {
            $tipoPagoSeleccionado = $this->tipoPago;
        }
        if($this->tipoPago == 0)
        {
            $this->emit('sale-error','DEBE SELECCIONAR UN TIPO DE PAGO');
            return;
        }
        if(isset($this->vendedorSeleccionado)) {
            $vendedorAgregado = $this->vendedorSeleccionado;
            if($vendedorAgregado == 0){
                $vendedorAgregado = 'Cliente Final';
            }
        }else{
            $vendedorAgregado = 'Cliente Final';

            //$this->emit('sale-error','DEBE SELECCIONAR UN VENDEDOR O CLIENTE FINAL');
            //return;
        }

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'total' => $this->total,
                'items' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'status' => $tipoPagoSeleccionado,
                'change' => $this->change,
                'vendedor' => $vendedorAgregado,
                'user_id' => Auth()->user()->id
            ]);

            if($sale)
            {
                $items = Cart::getContent();
                //dd($items);
                foreach ($items as $item){
                    SaleDetails::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale_id' => $sale->id,
                    ]);

                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
                
            }
            
            DB::commit();
            
            Cart::clear();
            $this->efectivo =0;
            $this->change =0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->tipoPago = 0;
            $this->vendedorSeleccionado = 0;
            $this->emit('sale-ok','Venta registrada con exito');
            return redirect()->to('pos');
            //$this->emit('print-ticket', $sale->id);
            
            

        }catch (Exception $e){
            DB::rollback();
            $this->emit('sale-error', $e->getMessage());
        }
    }

    public function printTicket($sale)
    {
        return Redirect::to("print://$sale->id");
    }

}