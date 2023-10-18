<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    public function index()
    {

        $salesData = $this->ultimasVentas();
        $totalStock = Product::sum('stock');
        $totalSales = Sale::sum('id');
        $totalMoney = Sale::sum('total');
        $productSales = $this->productTop();
        $productNames = $productSales->pluck('name');
        $productQuantities = $productSales->pluck('total_quantity');

        return view('livewire.reports.graficas', compact('salesData',
        'totalStock','totalSales','totalMoney','productNames','productQuantities'));
    }

    public function ultimasVentas(){
        $endDate = Carbon::now(); // Fecha actual
        $startDate = $endDate->copy()->subDays(30); // Fecha hace 6 días

        $salesData = Sale::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        return $salesData;
    }

    public function ventasAnual(){

    }

    public function productTop(){

    $productSales = DB::table('sale_details')
        ->join('products', 'sale_details.product_id', '=', 'products.id') // Ajusta los nombres de las columnas según tu estructura
        ->select('products.name', DB::raw('SUM(sale_details.quantity) as total_quantity'))
        ->groupBy('products.name')
        ->orderByDesc('total_quantity')
        ->limit(5)
        ->get();
    return $productSales;
    }
}
