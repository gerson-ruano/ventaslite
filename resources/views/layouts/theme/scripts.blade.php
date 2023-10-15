<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
$(document).ready(function() {
    App.init();
});
</script>

<script src="{{ asset('assets/js/custom.js') }}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="{{ asset('plugins/nicescroll/nicescroll.js') }}"></script>
<script src="{{ asset('plugins/currency/currency.js') }}"></script>

<script>
function noty(msg, option = 1) {
    Snackbar.show({
        text: msg.toUpperCase(),
        actionText: 'CERRAR',
        actionTextColor: '#fff',
        backgroundColor: option == 1 ? '#3b3f5c' : '#e75115a',
        pos: 'top-right'

    });
}
</script>

<script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>

@livewireScripts

{{--<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->--}}