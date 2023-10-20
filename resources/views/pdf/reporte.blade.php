<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}">
</head>

<body>

    <section class="header" style="top: -287px;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td colspan="2" align="center">
                    <span style="font-size: 25px; font-weight: bold;"> Sistema VentasLite</span>
                </td>
            </tr>
            <tr>
                <td width="30%"
                style="vertical-align: top; padding-top: 10px; padding-left: 30px; position: relative">
                    <img src="{{ asset('assets/img/ventaslite_logo.png') }}" alt="" class="invoice-logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 30px">
                    @if($reportType == 0)
                    <span style="font-size: 16px"><strong>Reporte de Ventas del Dia</strong></span>
                    @else
                    <span style="font-size: 16px"><strong>Reporte de Ventas por Fechas</strong></span>
                    @endif
                    <br>
                    @if($reportType != 0)
                    <span style="font-size: 16px"><strong>Fecha de consulta: {{$dateFrom}} al
                            {{($dateTo)}}</strong></span>
                    @else
                    <span style="font-size: 16px"><strong>Fecha de consulta:
                            {{\Carbon\Carbon::now()->format('d-m-Y')}}</strong></span>
                    @endif
                    <br>
                    <span style="font-size: 14px">{{__('Usuario')}}: {{$user}}</span>
                </td>
            </tr>
        </table>
    </section>

    <section style="margin-top: 10px">
        <table cellpadding="0" cellspacing="0" class="table-items" width="100%">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="10%">VENTA</th>
                    <th width="14%">IMPORTE</th>
                    <th width="10%">CANT</th>
                    <th width="12%">ESTADO</th>
                    <th width="12%">CLIENTE</th>
                    <th>USUARIO</th>
                    <th width="22%">FECHA/HORA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{($item->id)}}</td>
                    <td style="text-align: right;">{{ number_format($item->total, 2) }}</td>
                    <td align="center">{{($item->items)}}</td>
                    <td align="center">{{($item->status)}}</td>
                    <td align="center">{{($item->vendedor)}}</td>
                    <td align="center">{{($item->user)}}</td>
                    <td align="center">{{($item->created_at)->format('d-m-Y H:i:s')}}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>                 
                <td align="center"colspan="2"><span><b>TOTALES:</b></span></td>
                    <td style="text-align: right;" colspan="1" class="text-center"><span><strong> Q. {{ number_format($data->sum('total'),2) }}</strong></span></td>
                    <td  align="center" class="text-center" style=""> {{ $data->sum('items')}}</td>
                    <td colspan="4"></td>
                </tr>
            </tfoot>
        </table>
    </section>

    <section class="footer">
    <table cellpadding="0" cellspacing="0" class="" width="100%">
        <tr>
            <td width="20%">
                <span>Sistema VentasLite</span>
            </td>
            <td width="60%" class="text-center">
                Gerson Ruano
            </td>
            <td class="text-center" width="20%">
                página <span class="pagenum"></span>
            </td>
        </tr>
    </table>
</section>

</body>

</html>


<style>
    .table-items {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .table-items th, .table-items td {
        /*padding: 2px;*/
        border: 1px solid #ddd;
        text-align: center;
    }

    .table-items th {
        background-color: #f2f2f2;
    }
    .footer {
        position: fixed;
        bottom: 20px; /* Ajusta la distancia desde la parte inferior según tus necesidades */
        left: 0;
        right: 0;
        text-align: center;
    }

    script[type="text/php"] {
            if (isset($pdf)) {
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 10;
                $pdf->page_text(270, 770, "Página: {PAGE_NUM} de {PAGE_COUNT}", $font, $size);
            }
        }

    /*.table-items tfoot td {
        background-color: #f2f2f2;
        font-weight: bold;
    }*/
</style>
