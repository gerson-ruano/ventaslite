<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Sale;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;


class Cashout extends Component
{

    use WithPagination;

    public $fromDate, $toDate, $userid, $total, $items, $details;

    private $pagination = 10; 
    public $currentPage = 1;
    private $sales = [];

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }


    public function mount()
    {
        $this->fromDate = null;
        $this->toDate = null;
        $this->userid = 0;
        $this->total = 0;
        $this->sales = [];
        $this->details = [];
    }
    public function render()
    {
        //$fa = Carbon::now()->format('Y-m-d') . '23:59:59';
        
        return view('livewire.cashout.component',[
            'users' => User::orderBy('name','asc')->get(),
            'sales' => $this->sales,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Consultar()
    {
        $this->currentPage = 1;
        
        $fi= Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $ff= Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';

        $this->sales = Sale::whereBetween('created_at', [$fi, $ff])
        ->where('status','Paid')
        ->where('user_id', $this->userid)
        //->get();
        ->paginate($this->pagination);


        //$perPage = 5; // Número de elementos por página
        //$page = request('page', 1); // Página actual
        //$results = collect($query)->forPage($page, $perPage);
        //$this->sales = new LengthAwarePaginator($results, count($query), $perPage, $page);

        $this->total = $this->sales ? $this->sales->sum('total') : 0;
        $this->items = $this->sales ? $this->sales->sum('items') : 0;   
    }


    public function viewDetails(Sale $sale)
    {
        $fi= Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';
        $ff= Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';

        $this->details = Sale::join('sale_details as d', 'd.sale_id','sales.id')
        ->join('products as p', 'p.id','d.product_id')
        ->select('d.sale_id','p.name as product','d.quantity','d.price')
        ->whereBetween('sales.created_at', [$fi, $ff])
        ->where('sales.status', 'Paid')
        ->where('sales.user_id', $this->userid)
        ->where('sales.id', $sale->id)
        ->get();

        $this->emit('show-modal','open modal');
    }
    public function Print()
    {
        //code
    }
}