<script>
//import Chart from 'chart.js/auto'; 
// Datos para el gráfico de Barras ULTIMOS DIAS / VENTAS
var daysOfWeek = @json($salesData->pluck('date'));
var salesData = @json($salesData->pluck('sales'));
var trendline = calculateTrendline(daysOfWeek, salesData);
var barData = {
    labels: daysOfWeek,
    datasets: [{
        label: 'Ventas Diarias',
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
                text: 'ULTIMAS DIAS / VENTAS',
            }
        }
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


// Datos para el gráfico de línea TENDENCIA DE VENTAS ANUAL
var lineData = {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
        'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ],
    datasets: [{
        label: '2023',
        borderColor: 'rgb(45, 76, 110)',
        data: [12, 19, 3, 5, 2, 5, 10, 3, 11, 20, 7, 11, 3, 8],
    }],
};

var lineCtx = document.getElementById('chartTendenciaAnual').getContext('2d');
new Chart(lineCtx, {
    type: 'line',
    data: lineData,
    options: {
        plugins: {
            title: {
                display: true,
                text: 'LINEA DE TENDENCIA ANUAL',
            }
        }
    }
});


// Datos para el gráfico de DONA INGRESOS, PRODUCTOS, VENTAS
var totalStock = @json($totalStock);
var totalSales = @json($totalSales);
var totalMoney = @json($totalMoney);
var donutData = {
    labels: ['INGRESOS', 'PRODUCTOS', 'No.VENTAS'],
    datasets: [{
        data: [totalMoney, totalStock, totalSales],
        backgroundColor: ['blue', 'green', 'red'], 
    }],
};

var donutCtx = document.getElementById('chartReport').getContext('2d');
new Chart(donutCtx, {
    type: 'doughnut', 
    data: donutData,
    options: {
        cutoutPercentage: 30,
        plugins: {
            title: {
                display: true,
                text: 'REPORTE ESTADISTICO',
            }
        }
    }
});


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
    },
    
});

    
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
                    text: 'STOCK MINIMO'
                }
            }
        }
    
    });

// Datos para el gráfico de Barras VENTAS / TIPO DE PAGO
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
        label: 'Ventas por Tipo de Pago',
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
                text: 'ESTADOS DE PAGO',
            }
        }
        
    }
});


</script>