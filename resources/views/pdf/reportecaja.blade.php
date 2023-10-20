<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Cierre de Caja</title>
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
                <td width="30%" style="vertical-align: top; padding-top: 10px; padding-left: 30px; position: relative">
                    <img src="{{ asset('assets/img/ventaslite_logo.png') }}" alt="" class="invoice-logo">
                </td>
                <td width="70%" class="text-left text-company" style="vertical-align: top; padding-top: 30px">

                    <span style="font-size: 16px"><strong>Reporte de Cierre de Caja</strong></span><br>
                    <span style="font-size: 16px"><strong>Fecha de consulta: {{$fromDate}} al
                            {{($toDate)}}</strong></span><br>

                    <span style="font-size: 16px"><strong>Fecha de Reporte:
                            {{\Carbon\Carbon::now()->format('d-m-Y')}}</strong></span>
                    <br>
                    <span style="font-size: 14px">Usuario: {{$user}} </span>
                </td>
            </tr>
        </table>
    </section>

    <section class="header" style="top: -287px;">

    <h3>Detalle de las ventas realizadas<h2>PAGADO</h2></h3>

    <table cellpadding="0" cellspacing="0" width="100%" class="table-items">
    {{--dd($data)--}}
    <thead>
            <tr>
                <th align="center">No.</th>
                <th align="center">VENTA</th>
                <th align="center">CANT</th>
                <th align="center">TOTAL</th>
                <th align="center">EFECTIVO</th>
                <th align="center">CAMBIO</th>
                <th align="center">CLIENTE</th>
                <th align="center">USUARIO</th>
                <th align="center">FECHA/HORA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td align="center">{{ $item->id }}</td>
                <td align="center">{{ $item->items }}</td>
                <td style="text-align: right;">{{ $item->total }}</td>
                <td style="text-align: right;">{{ $item->cash }}</td>
                <td style="text-align: right;">{{ $item->change }}</td>
                <td align="center">{{ $item->vendedor }}</td>
                <td align="center">{{ $user}}</td>
                <td align="center">{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
                <tr>
                    <td align="center" colspan="2"><span><b>TOTALES:</b></span></td>
                    <td align="center"  colspan="1" class="text-center"><span><strong>{{ $data->sum('items') }}</strong></span></td>
                    <td style="text-align: right;"  colspan="1" class="text-center"><span><strong> Q. {{ number_format($data->sum('total'),2) }}</strong></span></td>
                    <td style="text-align: right;"  colspan="1" class="text-center"><span><strong> Q. {{ number_format($data->sum('cash'),2) }}</strong></span></td>
                    <td style="text-align: right;"  colspan="1" class="text-center"><span><strong> Q. {{ number_format($data->sum('change'),2) }}</strong></span></td>
                    <td colspan="3"></td>
                </tr>
            </tfoot>
    </table>

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

.table-items th,
.table-items td {
    /*padding: 2px;*/
    border: 1px solid #ddd;
    text-align: center;
}

.table-items th {
    background-color: #f2f2f2;
}

.footer {
    position: fixed;
    bottom: 20px;
    /* Ajusta la distancia desde la parte inferior según tus necesidades */
    left: 0;
    right: 0;
    text-align: center;
}

script[type="text/php"] {
    if (isset($pdf)) {
        $font=$fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
        $size=10;
        $pdf->page_text(270, 770, "Página: {PAGE_NUM} de {PAGE_COUNT}", $font, $size);
    }
}

/*.table-items tfoot td {
        background-color: #f2f2f2;
        font-weight: bold;
    }*/
</style>
