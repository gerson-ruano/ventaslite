<?php

namespace App\Exports;

use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class SalesExport implements FromCollection, WithHeadings, WithCustomStartCell, WithTitle,
WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $userId, $dateFrom, $dateTo, $reportType;

    function __construct($userId, $reportType, $f1, $f2){
        $this->userId = $userId;
        $this->reportType = $reportType;
        $this->dateFrom = $f1;
        $this->dateTo = $f2;
    }

    public function collection()
    {
       // return Sale::all();

       $data = [];
       if($this->reportType == 1)
       {
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';
            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
       }

       if($this->userId == 0)
       {
        $data = Sale::join('users as u','u.id','sales.user_id')
            ->select('sales.id','sales.total','sales.items','sales.status','u.name as user','sales.created_at')
            ->whereBetween('sales.created_at', [$from, $to])
            ->get();
            foreach ($data as $sale) {
                $sale->created_at = date('Y-m-d H:i:s', strtotime($sale->created_at));
            }

        }else{
            $data = Sale::join('users as u', 'u.id','sales.user_id')
            ->select('sales.id','sales.total','sales.items','sales.status','u.name as user','sales.created_at')
            ->whereBetween('sales.created_at', [$from, $to])
            ->where('user_id', $this->userId)
            ->get();
            foreach ($data as $sale) {
                $sale->created_at = date('Y-m-d H:i:s', strtotime($sale->created_at));
            }


       }

       return $data;
    }


    public function headings() : array
    {
        return [ "VENTA", "IMPORTE", "ITEMS","ESTADO","USUARIO","FECHA"];
    }

    public function startcell() : string
    {
        return 'A2';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            2 => [ 'font' => ['bold' => true]],
        ];
    }

    public function title() : string
    {
        return 'Reporte de Ventas';
    }


}
