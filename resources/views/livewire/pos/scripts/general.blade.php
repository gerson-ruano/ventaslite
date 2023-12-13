<script>
$('.table-responsive-tblscroll').niceScroll({
    cursorcolor: "#515365",
    cursorwidth: "20px",
    background: "rgba(20,20,20,0.3)",
    cursorborder: "0px",
    cursorborderradius: 3
});



function Confirm(id, removeitem, text) {
    swal({
        title: "DESEA QUITAR EL ARTICULO?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ELIMINAR!",
        cancelButtonColor: "#A9A9A9",
        cancelButtonText: 'CANCELAR',
    }).then(function(result) {
        if (result.value) {
            window.livewire.emit('removeitem', id)
            swal.close()
        }
    });

}

function ConfirmVaciarCart(clearcart, text) {
    swal({
        title: "DESEA QUITAR TODOS LOS ARTICULOS?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ELIMINAR!",
        cancelButtonColor: "#A9A9A9",
        cancelButtonText: 'CANCELAR',
    }).then(function(result) {
        if (result.value) {
            window.livewire.emit('clearcart')
            swal.close()
        }
    });
}

document.addEventListener('livewire:load', function() {
    Livewire.on('sale-ok', message => {
        swal({
            position: "top-end",
            type: "success",
            title: message,
            showConfirmButton: false,
            timer: 1500
        });
        
        setTimeout(() => {
            Livewire.emit('redirectPos');
        }, 1200);
    });
});

/*
document.addEventListener('livewire:load', function() {
    Livewire.on('sale-ok', message => {
        swal({
            position: "top-end",
            type: "success",
            title: message,
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            Livewire.emit('redirectPos');
        });
    });
});*/
</script>