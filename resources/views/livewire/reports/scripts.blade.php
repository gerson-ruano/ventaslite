<script>
//import { Chart, LinearScale, BarElement, BarController, CategoryScale } from 'chart.js/auto';
//Chart.register(LinearScale, BarElement, BarController, CategoryScale);
///////////////// GRAFICA 1 ////////////////
// Datos para el gráfico de Barras ULTIMOS DIAS / VENTAS
var daysOfWeek = @json($salesData-> pluck('date'));
var salesData = @json($salesData-> pluck('sales'));
var trendline = calculateTrendline(daysOfWeek, salesData);
var barData = {
    labels: daysOfWeek,
    datasets: [{
        label: 'Ventas del día',
        data: salesData,
        backgroundColor: 'rgb(45, 76, 110)',
    }, {
        label: 'Línea de Tendencia',
        data: salesData, // Agrega aquí los valores de la línea de tendencia
        type: 'line', // Define el tipo de gráfico como línea
        borderColor: 'rgb(255, 99, 132)', // Color de la línea de tendencia
        fill: false, // Sin relleno
    }],
};
var barCtx = document.getElementById('chartUltimosDias').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: barData,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'ULTIMOS DIAS / NO. VENTAS',
            }
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false // Permite que el tamaño se ajuste al contenedor
    }
});

function calculateTrendline(x, y) {
    const n = x.length;
    let xySum = 0;
    let xSum = 0;
    let ySum = 0;
    let xxSum = 0;

    for (let i = 0; i < n; i++) {
        xySum += x[i] * y[i];
        xSum += x[i];
        ySum += y[i];
        xxSum += x[i] * x[i];
    }

    const m = (n * xySum - xSum * ySum) / (n * xxSum - xSum * xSum);
    const b = (ySum - m * xSum) / n;

    const trendline = [];
    for (let i = 0; i < n; i++) {
        trendline.push(m * x[i] + b);
    }

    console.log("Slope (m):", m);
    console.log("Intercept (b):", b);
    console.log("Trendline Values:", trendline);

    return trendline;
}

///////////////// GRAFICA 2 ////////////////
// Renderiza el gráfico de barras BAJA EXISTENCIA Y VENTAS
var datosDeVentas = @json($datosDeVentas);
var productosConMenosExistencias = @json($stockProducts);

//var labels = datosDeVentas.map(venta => venta.name); // Asegúrate de usar el nombre correcto de la columna
var ventas = datosDeVentas.map(venta => venta.total_quantity);
var labels = productosConMenosExistencias.map(products => products.name);
var existencias = productosConMenosExistencias.map(products => products.stock);

var ctx = document.getElementById('chartStock').getContext('2d');
var data = {
    labels: labels,
    datasets: [{
            label: 'Ventas',
            type: 'bar',
            data: ventas,
            borderColor: 'rgba(191, 74, 74)',
            backgroundColor: 'rgba(74, 133, 191)',
        },
        {
            label: 'Existencias',
            type: 'bar',
            data: existencias,
            borderColor: 'rgba(74, 133, 191)',
            backgroundColor: 'rgba(191, 74, 74)',
        }
    ]
};

new Chart(ctx, {
    type: 'bar',
    data: data,
    type: 'bar',
    data: data,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'PRODUCTOS CON STOCK MINIMO'
            }
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false // Permite que el tamaño se ajuste al contenedor
    }
});

///////////////// GRAFICA 3 ////////////////
// Datos para el gráfico de pastel PRODUCTOS MAS VENDIDOS
var productData = @json($productSales);
var productLabels = [];
var productQuantities = [];
productData.forEach(function(item) {
    productLabels.push(item.name);
    productQuantities.push(item.total_quantity);
});

var pieCtx = document.getElementById('chartProductTop').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: productLabels,
        datasets: [{
            data: productQuantities,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(201, 203, 207)',
                'rgb(54, 162, 235)'
                // Agrega más colores según sea necesario
            ],
        }],
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'PRODUCTOS MAS VENDIDOS',
            },
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false // Permite que el tamaño se ajuste al contenedor
    }

});

///////////////// GRAFICA 4 ////////////////
// Datos para el gráfico de DONA INGRESOS, PRODUCTOS, VENTAS
var totalStock = @json($totalStock);
var totalSales = @json($totalSales);
var totalMoney = @json($totalMoney);
if (totalMoney && totalMoney.length > 0) {
    var numericValues = totalMoney.map(Number); // Convertir a números explícitamente

    var totalSum = numericValues.reduce(function(accumulator, currentValue) {
        return accumulator + currentValue;
    }, 0);
    //console.log(totalSum);
} else {
    console.log('El array totalMoney está vacío o no definido.');
}

var donutData = {
    labels: ['CAJA TOTAL', 'PRODUCTOS EXISTENTES', 'VENTAS REALIZADAS'],
    datasets: [{
        data: [totalSum, totalStock, totalSales],
        backgroundColor: ['blue', 'green', 'red'],
    }],
};

var donutCtx = document.getElementById('chartReport').getContext('2d');
new Chart(donutCtx, {
    type: 'doughnut',
    data: donutData,
    options: {
        cutoutPercentage: 50,
        plugins: {
            title: {
                display: true,
                text: 'REPORTE ESTADISTICO GENERAL',
            }
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false // Permite que el tamaño se ajuste al contenedor
    }
});

///////////////// GRAFICA 5 ////////////////
// Datos para el gráfico de Barras TOP USUARIOS / VENTAS
var userNames = @json($TopUserData-> pluck('user_name')-> toArray());
var salesCounts = @json($TopUserData-> pluck('sales_count')-> toArray());
//var daysOfWeek = salesData.map(item => item.user_name); //OTRA FORMA DE OBTENER
//var salesData = salesData.map(item => item.sales_count);
var barData = {
    labels: userNames,
    datasets: [{
        label: 'No. de Ventas',
        data: salesCounts,
        backgroundColor: 'rgb(45, 76, 110)',
    }]
};

var barCtx = document.getElementById('chartTopUsers').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: barData,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'NO. VENTAS POR USUARIO',
            }
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false // Permite que el tamaño se ajuste al contenedor
    }
});

///////////////// GRAFICA 6 ////////////////
// Datos para el gráfico de DONA INGRESOS MONETARIOS
var totalMoney = @json($totalMoney);
var donutData = {
    labels: ['ACTIVO', 'DEUDAS', 'CANCELADOS'],
    datasets: [{
        data: totalMoney,
        backgroundColor: ['blue', 'green', 'red'],
    }],
};

var donutCtx = document.getElementById('chartIngresos').getContext('2d');

new Chart(donutCtx, {
    type: 'doughnut',
    data: donutData,
    options: {
        cutoutPercentage: 30,
        plugins: {
            title: {
                display: true,
                text: 'REPORTE MONETARIOS ACTIVO/PASIVO',
            }
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false
    }
});

///////////////// GRAFICA 7 ////////////////
// Datos para el gráfico de línea TENDENCIA DE VENTAS ANUALES
var salesData = @json($salesData);
var salesMonths = @json($salesMonths);
// Mapeo de números de mes a nombres de mes
var months = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

// Función para obtener el nombre del mes
function getMonthName(monthNumber) {
    return months[monthNumber - 1];
}

// Procesar los datos para el gráfico
var lineData = {
    labels: [], // Labels para los meses
    datasets: [], // Datos de ventas por año
};

// Iterar sobre los datos de ventas por año
for (var year in salesMonths) {
    var yearData = salesMonths[year];

    // Labels de los meses para el año actual
    var labels = [];
    var sales = [];

    // Iterar sobre los datos de ventas para cada mes del año actual
    for (var i = 1; i <= 12; i++) {
        var monthData = yearData.find(data => data.month === i);
        if (monthData) {
            labels.push(getMonthName(i));
            sales.push(monthData.sales);
        } else {
            labels.push(getMonthName(i));
            sales.push(0);
        }
    }

    lineData.labels = labels; // Agregar labels al conjunto de datos
    lineData.datasets.push({
        label: ' Ventas ' + year,
        data: sales,
        borderColor: 'rgb(45, 76, 110)',
    });
}

var lineCtx = document.getElementById('chartTendenciaAnual').getContext('2d');
new Chart(lineCtx, {
    type: 'line',
    data: lineData,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'LINEA DE TENDENCIA AÑO / MES',
            }
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false // Permite que el tamaño se ajuste al contenedor
    }
});

///////////////// GRAFICA 8 ////////////////
// Datos para el gráfico de Barras VENTAS / ESTADO DE PAGO
// Obtén los datos de ventas por tipo de pago desde el backend
var datosVentasPorTipoPago = @json($ventasTipoPago);

// Extrae los nombres de tipo de pago y las cantidades de ventas
var tipoPago = datosVentasPorTipoPago.map(venta => venta.status);
var totalVentas = datosVentasPorTipoPago.map(venta => venta.total_ventas);

// Crea un contexto para el elemento canvas de la gráfica
var ctx = document.getElementById('chartTipoPago').getContext('2d');

// Configura los datos para la gráfica de barras
var data = {
    labels: tipoPago,
    datasets: [{
        label: 'Numero de Ventas',
        data: totalVentas,
        backgroundColor: [
            'rgb(75, 192, 192)',
            'rgb(255, 99, 132)',
            'rgb(201, 203, 207)',
            'rgb(255, 205, 86)',
            'rgb(201, 203, 207)',
            'rgb(54, 162, 235)'
            // Agrega más colores según sea necesario
        ],
    }]
};

// Crea y muestra la gráfica
new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }

        },
        plugins: {
            title: {
                display: true,
                text: 'ESTADOS DE PAGO EN VENTAS',
            }
        },
        responsive: true, // Permite que el gráfico sea receptivo
        maintainAspectRatio: false // Permite que el tamaño se ajuste al contenedor

    }
});
</script>