<script>
var listener = new window.keypress.Listener();

listener.simple_combo("f6", function() {
    livewire.emit('savesale')
})

listener.simple_combo("f8", function() {
    document.getElementById('cash').value = ''
    document.getElementById('cash').focus()
})

listener.simple_combo("f4", function() {
    var total = parseFloat(document.getElementById('hiddenTotal').value)
    if (total > 0) {
        ConfirmVaciarCart(0, 'clearCart', 'SEGURO DE ELIMINAR EL CARRITO?')
        //console.log(total)
    } else {
        noty('AGREGA PRODUCTOS A LA VENTA')
    }
})

function clearCash() {
    document.getElementById('cash').value = '';
    document.getElementById('cash').focus();

    Livewire.emit('clearChange');
}

function clearCart() {
    var total = parseFloat(document.getElementById('hiddenTotal').value);
    if (total > 0) {
        ConfirmVaciarCart(0, 'clearCart', 'SEGURO DE ELIMINAR EL CARRITO?');
        //console.log(total);
    } else {
        noty('AGREGA PRODUCTOS A LA VENTA');
    }
}


if (document.getElementById("clearCash")) {
    document.getElementById("clearCash").addEventListener("click", clearCash);
}

if (document.getElementById("clearCart")) {
    document.getElementById("clearCart").addEventListener("click", clearCart);
}

</script>