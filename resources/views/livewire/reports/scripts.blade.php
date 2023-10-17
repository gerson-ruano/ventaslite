<script>
    // Datos para el gráfico de barras
    var barData = {
        labels: ['A', 'B', 'C', 'D', 'E'],
        datasets: [{
            label: 'Datos de ejemplo',
            backgroundColor: 'rgb(45, 76, 110)',
            data: [12, 19, 3, 5, 2],
        }],
    };

    var barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: barData,
    });

    // Datos para el gráfico de línea
    var lineData = {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
        datasets: [{
            label: 'Datos de ejemplo',
            borderColor: 'rgb(45, 76, 110)',
            data: [12, 19, 3, 5, 2],
        }],
    };

    var lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: lineData,
    });

    // Datos para el gráfico de pastel
    var pieData = {
        labels: ['Rojo', 'Verde', 'Azul'],
        datasets: [{
            data: [30, 40, 30],
            backgroundColor: ['red', 'green', 'blue'],
        }],
    };

    var pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: pieData,
    });

    // Datos para el gráfico radar
    var radarData = {
        labels: ['A', 'B', 'C', 'D', 'E'],
        datasets: [{
            label: 'Datos de ejemplo',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgb(45, 76, 110)',
            data: [12, 19, 3, 5, 2],
        }],
    };

    var radarCtx = document.getElementById('radarChart').getContext('2d');
    new Chart(radarCtx, {
        type: 'radar',
        data: radarData,
    });
</script>
