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
        //$stockMinimo = 10;

        $salesData = $this->ultimasVentas();
        $totalStock = $this->productoStock();
        $totalSales = $this->ventasTotales();

        $ingresosPorStatus = $this->ingresoTotalPorStatus();
        $totalMoney = $ingresosPorStatus->pluck('total_por_status')->toArray();

        $TopUserData = $this->TopUserVentas();

        $productSales = $this->productTop();
        //$productNames = $productSales->pluck('name');
        //$productQuantities = $productSales->pluck('total_quantity');

        $stockProducts = $this->productosConMenosExistencias();
        
        $posicion = 0; // Puedes cambiar esta variable para elegir otra posición si es necesario
        if (isset($stockProducts[$posicion])) {
            $stock = $stockProducts[$posicion]['alerts'];
            $datosDeVentas = $this->obtenerDatosDeVentas($stock);
        } else {
            $stock = 10; 
            $datosDeVentas = $this->obtenerDatosDeVentas($stock);
        }
        //$datosDeVentas = $this->obtenerDatosDeVentas(10);

        $ventasTipoPago = $this->obtenerDatosDeVentasTipoPago();

        $salesMonths = $this->TendenciaAnual();

        return view('livewire.reports.graficas', compact('salesData','totalStock', 'TopUserData',
        'totalSales','totalMoney','productSales','datosDeVentas','stockProducts','ventasTipoPago','salesMonths'));
    }

    public function productoStock(){
        return Product::sum('stock');
    }
    public function ventasTotales(){
        return Sale::count();
    }

    public function ingresoTotalPorStatus() {
        return Sale::select('status', DB::raw('SUM(total) as total_por_status'))
            ->groupBy('status')
            ->get();
    }


    public function ultimasVentas(){
        $endDate = Carbon::now(); // Fecha actual
        $startDate = $endDate->copy()->subDays(30); // Fecha hace 30 días

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

    public function TopUserVentas(){
        $endDate = Carbon::now(); // Fecha actual
        $startDate = $endDate->copy()->subDays(90); // Fecha hace 30 días

    $TopUserData = Sale::whereDate('sales.created_at', '>=', $startDate)
        ->whereDate('sales.created_at', '<=', $endDate)
        ->join('users', 'sales.user_id', '=', 'users.id')
        ->selectRaw('users.name as user_name, COUNT(*) as sales_count')
        ->groupBy('user_name')
        ->orderBy('user_name')
        ->get();
        return $TopUserData;
    }


   /* public function productosConMenosExistencias($stockMinimo) {
        return Product::where('stock', '<', $stockMinimo)->get();
    }*/

    public function productosConMenosExistencias() {
        return Product::whereColumn('stock', '<', 'alerts')->get();
    }
    

    public function obtenerDatosDeVentas($stock) {
        return Sale::join('sale_details', 'sales.id', '=', 'sale_details.sale_id')
        ->join('products', 'sale_details.product_id', '=', 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select(
            'products.id as product_id',
            'categories.name as category_name',
            DB::raw('SUM(sale_details.quantity) as total_quantity')
        )
        ->where('products.stock', '<=', $stock)
        ->groupBy('products.id', 'categories.name') // Agrupa por los campos seleccionados
        ->get();
    }

    public function obtenerDatosDeVentasTipoPago() {
        return DB::table('sales')
        ->select('status', DB::raw('COUNT(id) as total_ventas'))
        ->groupBy('status')
        ->get();
    }

    public function TendenciaAnual(){
    $endDate = Carbon::now(); // Fecha actual
    $startDate = $endDate->copy()->subDays(365); // Fecha hace 30 días

    $salesMonths = Sale::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as sales')
        ->groupBy('month')
        ->orderBy('month')
        ->get();  
    return $salesMonths;
}

}