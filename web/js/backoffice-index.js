$(function () {
    $('#contenido_principal').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Productos más vendidos'
        },
        subtitle: {
            text: 'Registro histórico - <strong>Top 10</strong>.'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Número de productos'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> unidades<br/>'
        },

        series: [{
            name: "Producto",
            colorByPoint: true,
            data: [{
                name: $("#nombre_0").val(),
                y: parseFloat($('#vendidos_0').val())
            }, {
                name: $("#nombre_1").val(),
                 y: parseFloat($('#vendidos_1').val())
            }, {
                name: $("#nombre_2").val(),
                 y: parseFloat($('#vendidos_2').val())
            }, {
                name: $("#nombre_3").val(),
                 y: parseFloat($('#vendidos_3').val())
            }, {
                name:$("#nombre_4").val(),
                 y: parseFloat($('#vendidos_4').val())
            }, {
               name: $("#nombre_5").val(),
                y: parseFloat($('#vendidos_5').val())
            },
            {
               name: $("#nombre_6").val(),
                y: parseFloat($('#vendidos_6').val())
            },
            {
               name: $("#nombre_7").val(),
                y: parseFloat($('#vendidos_7').val())
            },
            {
               name: $("#nombre_8").val(),
                y: parseFloat($('#vendidos_8').val())
            },
            {
               name: $("#nombre_9").val(),
                y: parseFloat($('#vendidos_9').val())
            },]
        }]
    });
});