    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/js/keypress.js') }}"></script>
    {{--<script src="{{ asset('js/sweetAlerts.js') }}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    {{--<script src="{{ asset('chart.js/dist/chart.umd.js') }}"></script>--}}
    {{--<script type="module" src="chart.js/dist/chart.js"></script>--}}
    {{--LIBRERIA CHARJS HABRA QUE INSTALARLA--}}

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css"
        class="dashboard-analytics" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link href="{{ asset('plugins/font-icons/fontawesome/css/fontawesome.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css {{ asset('assets/css/widgets/modules-widgets.css') }}">
    <link rel="stylesheet" type="text/css {{ asset('assets/css/forms/theme-checkbox-radio.css') }}">

    <link href="{{ asset('assets/css/apps/scrumboard.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/apps/notes.css')}}" rel="stylesheet" type="text/css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.5.1/jquery.nicescroll.min.js"></script>
    <style>
aside {
    display: none !important;
}

.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #3b3f5c;
    border-color: #3b3f5c;
}

@media (max-width: 480px) {
    .mtmobile {
        margin-bottom: 20px !important;
    }

    .mbmobile {
        margin-bottom: 10px !important;
    }

    .hideonsm {
        display: none !important;
    }

    .inblock {
        display: block;
    }
}

/*sidebar background*/

.sidebar-theme #compactSidebar {
    background: #191e3a !important;
}

.header-container .sidebarCollapse {
    color: #3b3f5c !important;
}

.navbar .navbar-item .nav-item form.form-inline input.search-form-control {
    font-size: 15px;
    background-color: #3b3f5c !important;
    padding-right: 40px;
    padding-top: 12px;
    border: none;
    color: #fff;
    box-shadow: none;
    border-radius: 30px;
}

@media (min-width: 960px) {
    .sidebar-wrapper2 .menu-categories {
        display: none;
    }
}


.custom-color {
    background-color: #2c3e50;
    /* Cambia esto al color de fondo deseado */
}


.card {
    border: none;
    /* Quita el borde blanco del elemento .card */
}

.chart-canvas {
    width: 100%;
    height: 40vh;
}

/* Estilo para pantallas grandes (ancho mínimo de 992px) */
@media (min-width: 992px) {
    .chart-canvas {
        width: 80vw;
        height: 60vh;
    }
}

.chart-container {
    width: 100%; /* Ajusta el ancho del contenedor */
    height: 400px; /* Define una altura predeterminada para el contenedor */
    position: relative; /* Asegura que el canvas del gráfico se ajuste al tamaño del contenedor */
}

    </style>

    <link href="{{ asset('plugins/flatpickr/flatpickr.dark.css')}}" rel="stylesheet" type="text/css" />

    @livewireStyles
