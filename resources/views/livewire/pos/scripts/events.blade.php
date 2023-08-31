<script>

    document.addEventListener('DOMContentLoaded', function(){
        windows.livewire.on('scan-ok', Msg =>{
            noty(Msg)
        })
        windows.livewire.on('scan-notfound', Msg =>{
            noty(Msg, 2)
        })
        windows.livewire.on('no-stock', Msg =>{
            noty(Msg, 2)
        })
        windows.livewire.on('sale-error', Msg =>{
            noty(Msg)
        })
        windows.livewire.on('print-ticket', saleId =>{
            window.open("print://" + saleId , '_blank')
        })

    })

</script>