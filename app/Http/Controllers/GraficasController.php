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
        $totalSales = Sale::count();
        $totalMoney = Sale::sum('total');

        $productSales = $this->productTop();
        //$productNames = $productSales->pluck('name');
        //$productQuantities = $productSales->pluck('total_quantity');

        $stockProducts = $this->productosConMenosExistencias();
        $datosDeVentas = $this->obtenerDatosDeVentas();
        

        return view('livewire.reports.graficas', compact('salesData','totalStock',
        'totalSales','totalMoney','productSales','datosDeVentas','stockProducts'));
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

    public function ProductTop2()
    {
        $products = Product::select('name')
        ->selectRaw('COUNT(*) as total_sales')
        ->join('sale_details', 'products.id', '=', 'sale_details.product_id')
        ->groupBy('products.name')
        ->orderByDesc('total_sales')
        ->take(5) // Obtener los 5 productos más vendidos
        ->get();

        return $products;
    }

    public function productosConMenosExistencias() {
        return Product::where('stock', '<', 10)->get();
    }

    public function obtenerDatosDeVentas() {
        return  Sale::join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
        ->select('sale_details.product_id', DB::raw('SUM(sale_details.quantity) as total_quantity'))
        ->groupBy('sale_details.product_id')
        ->get(); 
    }
    
}
