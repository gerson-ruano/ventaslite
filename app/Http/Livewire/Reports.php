<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleDetails;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;


class Reports extends Component
{

    use WithPagination;

    public $componentName, $data, $details, $sumDetails, $countDetails, 
    $reportType, $userId, $dateFrom, $dateTo, $saleId, $datos = null;

    private $pagination = 10;

    public function mount(){
        $this->componentName = 'Reporte de Ventas';
        $this->data = [];
        $this->details = [];
        $this->sumDetails = 0;
        $this->countDetails = 0;
        $this->reportType = 0;
        $this->userId = 0;
        $this->saleId = 0;
    }
    public function render()
    {
        $this->SalesByDate();

        //$data = $this->data->paginate($this->pagination);
       // $sales = new Paginator($this->data, $this->pagination);

        return view('livewire.reports.component',[
            'users' => User::orderBy('name','asc')->get(),
            //'sales' => $data,
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function SalesByDate()
    {

        if($this->reportType == 0)  //VENTAS DEL DIA
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($this->reportType == 1 && ($this->dateFrom == '' || $this->dateTo == '')){
            return;
        }

        $query = Sale::join('users as u', 'u.id', 'sales.user_id')
            ->select('sales.*', 'u.name as user')
            ->whereBetween('sales.created_at', [$from, $to]);

        if ($this->userId != 0) {
            $query->where('user_id', $this->userId);
        }

        //return $query->paginate($this->pagination);
        //$this->data = $query->get();
       //$this->data = $query->paginate($this->pagination);

        if($this->userId == 0){

            $this->data = Sale::join('users as u','u.id','sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.created_at', [$from, $to])
            ->get();
        }else{
            $this->data = Sale::join('users as u', 'u.id','sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.created_at', [$from, $to])
            ->where('user_id', $this->userId)
            ->get();//->paginate($this->pagination);
        }
        //dd($from);
        //return $this->data->paginate($this->pagination);

        //$data = $query->paginate($this->pagination)->toArray();

       // $this->data = $data['data'];
        
    } 

    

    public function getDetails($saleId)
    {
        $this->details = SaleDetails::join('products as p','p.id','sale_details.product_id')
        ->select('sale_details.id','sale_details.price','sale_details.quantity','p.name as product')
        ->where('sale_details.sale_id', $saleId)
        ->get();

        //dd($this->details);

        $suma = $this->details->sum(function($item){
            return $item->price * $item->quantity;
        });

       

        $this->sumDetails = $suma;
        
        $this->countDetails = $this->details->sum('quantity');
        //dd($this->countDetails);

        $this->saleId = $saleId;

        $this->emit('show-modal','Detalles Cargados');
    }
    
}
