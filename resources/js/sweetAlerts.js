


/*function confirmDeletion(id, products) {
    if (products > 0) {
        Swal.fire({
            title: 'No se puede eliminar la categoría',
            text: 'Tiene productos existentes',
            icon: 'warning'
        });
        return;
    }

    Swal.fire({
        title: '¿Qué desea realizar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'SI, ELIMINAR!',
        closeOnConfirm: false
    }).then(function(result) {
        if (result.isConfirmed) {
            window.livewire.emit('deleteRow', id);
            Swal.close();
        }
    });
}

function showError(message) {
    Swal.fire({
        title: 'Error',
        text: message,
        icon: 'error'
    });
}

export { confirmDeletion, showError };*/



