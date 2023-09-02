<script>
    $('.tblscroll').nicescroll({
        cursorcolor: "#515365",
        cursorwidth: "30px",
        background: "rgba(20,20,20,0.3)",
        cursorborder: "0px",
        cursorborderradius:3
    })


    function Confirm(id, removeitem, text) {

        swal({
            title: "QUE DESEA REALIZAR?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI, ELIMINAR!",
            closeOnConfirm: false
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('removeitem', id)
                swal.close()
            }
        });

    }

    function ConfirmVaciarCart(clearcart, text) {

        swal({
            title: "DESEA SALIR Y QUITAR PRODUCTOS?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI, ELIMINAR!",
            closeOnConfirm: false
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('clearcart')
                swal.close()
            }
        });

    }

</script>