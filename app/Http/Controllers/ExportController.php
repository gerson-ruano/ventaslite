<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
//use Barryvdh\DomPDF\Facade\Pdf;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\SaleDetails;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;

class ExportController extends Controller
{
    public function reportPDF($userId, $reportType, $dateFrom = null, $dateTo = null){


        $data = [];

        if($reportType == 0)  //VENTAS DEL DIA
        {
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($userId == 0){
            $data = Sale::join('users as u','u.id','sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.created_at', [$from, $to])
            ->get();
        }else{
            $data = Sale::join('users as u', 'u.id','sales.user_id')
            ->select('sales.*','u.name as user')
            ->whereBetween('sales.created_at', [$from, $to])
            ->where('user_id', $userId)
            ->get();
        }

        $user = $userId == 0 ? 'Todos' : User::find($userId)->name;
        $pdf = PDF\Pdf::loadView('pdf.reporte', compact('data', 'reportType','user','dateFrom','dateTo'));

        return $pdf->stream('salesReport.pdf'); //visualizar
        //return $pdf->download('salesReport.pdf'); //descargar
    }

    public function reportExcel($userId, $reportType, $dateFrom = null, $dateTo = null)
    {
        $reportName = 'Reporte de Ventas_' . uniqid() . '.xlsx';
        return Excel::download(new SalesExport($userId, $reportType, $dateFrom, $dateTo),$reportName);
    }

    public function reportVenta($cart){

        $cart = Cart::getContent();

        
        /*$data = [];

            $data = Sale::join('users as u','u.id','sales.user_id')
            ->select('sales.*','u.name as user')
            //->whereBetween('sales.created_at', [$from, $to])
            ->get();

        $carts = json_decode($cart, true);

        //$user = $userId == 0 ? 'Todos' : User::find($userId)->name;
        $pdf = PDF\Pdf::loadView('pdf.reporteventa', compact('data', 'total','itemsQuantity','efectivo','change', ['carts' => $carts]));
        return $pdf->stream('venta.pdf');*/

        $pdf = PDF\Pdf::loadView('pdf.reporteventa', ['cart' => $cart]);
        return $pdf->stream('VentaReport.pdf'); //visualizar
    }

    public function reportCaja($userid, $fromDate = null, $toDate = null){

        $from = Carbon::parse($fromDate)->format('Y-m-d') . ' 00:00:00';
        $to = Carbon::parse($toDate)->format('Y-m-d') . ' 23:59:59';

        $data = Sale::join('users as u', 'u.id','sales.user_id')
        ->select('sales.*','u.name as user')
        ->where('sales.user_id', $userid)
        ->whereBetween('sales.created_at', [$from, $to])
        ->get();

        $user = User::find($userid)->name;
        $pdf = PDF\Pdf::loadView('pdf.reportecaja', compact('data','user','fromDate','toDate'));
        return $pdf->stream('CajaReport.pdf'); //visualizar
    }
}