<div wire:ignore.self class="modal fade" id="modalDetails" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">
                    <b>Detalle de la Venta #{{$saleId}}</b>
                </h5>
                <h6 class="text-center-text-warning" wire:loading>POR FAVOR ESPERE...</h6>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white text-center">ITEM</th>
                                <th class="table-th text-white text-center">PRODUCTO</th>
                                <th class="table-th text-white text-center">PRECIO</th>
                                <th class="table-th text-white text-center">CANT</th>
                                <th class="table-th text-white text-center">IMPORTE</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--dd($details)--}}
                            @foreach($details as $d)
                            {{--($d)--}}
                            <tr>
                                <td class="text-center">
                                    <h6>{{$d->id}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{$d->product}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{number_format($d->price,2)}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{number_format($d->quantity,2)}}</h6>
                                </td>
                                <td class="text-center">
                                    <h6>{{number_format($d->price * $d->quantity,2)}}</h6>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <h5 class="text-center font-weight-bold">TOTALES</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">{{$countDetails}}</h5>
                                </td>
                                <td>
                                    <h5 class="text-center">Q. {{number_format($sumDetails,2)}}</h5>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark close-btn text-info" data-dismiss="modal">
                    CERRAR
                </button>
                <button onclick="printModalContent();" class="btn btn-dark d-print-none">Imprimir</button>
            </div>
        </div>
    </div>
</div>
<script>
let printWindow = null;
function printModalContent() {
    if (printWindow) {
        printWindow.close();
    }
    var modalContent = document.getElementById('modalDetails');
    printWindow = window.open('', '_blank', 'width=1000,height=800');
    var printDocument = printWindow.document;
    var printBody = printDocument.body;

    /*printDocument.write('<html><head><title>Detalle de Venta</title></head><body>');
    printDocument.write('<div class="modal-content">');
    printDocument.write(modalContent.innerHTML);
    printDocument.write('</div>');
    printDocument.write('<style>.btn { display: none; }</style>');
    printDocument.write('<style>.btn-print, .btn-close { display: inline-block; margin: 5px; }</style>');
    printDocument.write('<style>');
    printDocument.write('<button onclick="window.print();" class="btn-print btn btn-dark">Imprimir</button>');
    printDocument.write('<button onclick="window.close();" class="btn-close btn btn-dark">Cerrar</button>');
    printDocument.write('</body></html>');
    */

    printDocument.write('<html><head><title>Detalle de Venta</title></head><body>');
    printDocument.write('<div class="modal-content">');
    printDocument.write(modalContent.innerHTML);
    printDocument.write('<style>.btn { display: none; }</style>');
    printDocument.write('</div>');
    printDocument.write('<style>.btn-print, .btn-close { display: inline-block; margin: 5px; }</style>');
    printDocument.write('<button onclick="window.print();" class="btn-print btn btn-dark">Imprimir</button>');
    printDocument.write('<button onclick="window.close();" class="btn-close btn btn-dark">Cerrar</button>');
    printDocument.write('</body></html>');

    printWindow.onload = function() {
        printWindow.print();
        printWindow.setTimeout(function() {
            printWindow.close(); // Cierra la ventana después de imprimir
            printWindow = null; // Restablece la referencia a la ventana
        }, 100);
    };
}
</script>