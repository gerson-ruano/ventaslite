<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <link rel="stylesheet" href="{{ asset('css/custom_pdf.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_page.css') }}">
</head>

<body>
    <h1>Detalle de la Venta</h1>
    
    <table>
        <thead>
            <tr>
                <th align="center">No.</th>
                <th align="center">Nombre</th>
                <th align="center">Precio</th>
                <th align="center">Cantidad</th>
                <th align="center">Img</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
                <tr>
                    <td align="center">{{ $item->id }}</td>
                    <td align="center">{{ $item->name }}</td>
                    <td align="center">{{ $item->price }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="center">{{ $item->attributes }}</td>
                </tr>
            @endforeach
        </tbody>
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