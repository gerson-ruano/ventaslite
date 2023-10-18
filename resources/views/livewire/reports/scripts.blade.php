<script>
    var salesData = @json($salesData);
    var daysOfWeek = @json($salesData->pluck('date'));
    var totalStock = @json($totalStock);
    var totalSales = @json($totalSales);
    var totalMoney = @json($totalMoney);
    var productNames = @json($productNames);
    var productQuantities = @json($productQuantities);


    // Datos para el gráfico de Barras Ultimas ventas
    var barData = {
        labels: daysOfWeek,
        datasets: [{
            label: 'Ventas por día',
            data: @json($salesData->pluck('sales')),
            backgroundColor: 'rgb(45, 76, 110)',
        }],
    };

    var barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: barData,
    });



    // Datos para el gráfico de línea Tendencia
    var lineData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo','Abril', 'Mayo', 'Junio', 'Julio', 'Agosto','Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datasets: [{
            label: 'Datos de ejemplo',
            borderColor: 'rgb(45, 76, 110)',
            data: [12, 19, 3, 5, 2,5,10,3,11,20,7,11,3,8],
        }],
    };

    var lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: lineData,
    });

    // Datos para el gráfico de pastel
    var pieData = {
        labels: ['Ingresos', 'Stock', 'Ventas'],
        datasets: [{
            data: [totalMoney, totalStock, totalSales],
            backgroundColor: ['blue', 'green', 'red'], // Colores para cada sección
        }],
    };

    var pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: pieData,
    });

    // Datos para el gráfico radar Productos mas vendidos
    var radarData = {
        labels: productNames,
        datasets: [
            {
                label: 'Productos más vendidos',
                data: productQuantities,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgb(45, 76, 110)',
            },
        ],
    };

    // Obtén el contexto del elemento canvas
    var radarCtx = document.getElementById('radarChart').getContext('2d');
    new Chart(radarCtx, {
        type: 'radar',
        data: radarData,
        options: {
            scale: {
                ticks: {
                    beginAtZero: true,
                },
            },
        },
    });

    // Datos para el gráfico de Barras Ultimas ventas
    var barData = {
        labels: daysOfWeek,
        datasets: [{
            label: 'Ventas por día',
            data: @json($salesData->pluck('sales')),
            backgroundColor: 'rgb(45, 76, 110)',
        }],
    };

    var barCtx = document.getElementById('barChart2').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: barData,
    });
</script>
