$(document).ready(function () {
    $.ajax({
        url: "visitas/graficas/mes/mes",
        data: "",
        method: "get",
         success: function (result) {
            let datos = jQuery.parseJSON(result);
            let ctx = document.getElementById("chartsmes").getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                    datasets: [{
                        label: 'visitas',
                        data: datos[0],
                        backgroundColor: [
                            'rgba(0, 0, 0, 0.2)'
                        ],
                        borderColor: [
                            'rgba(0, 0, 0, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        error: function (result) {
            console.log('Error');

        },
        beforeSend: function (result) {
            console.log('Cargando');
        }
    });

    $.ajax({
        url: "visitas/graficas/mes/dias",
        data: "",
        method: "get",
        success: function (result) {
            let datos = jQuery.parseJSON(result);
            let ctx = document.getElementById("chartdias").getContext('2d');
            let myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: datos[1],
                    datasets: [{
                        label: 'visitas',
                        data: datos[0],
                        backgroundColor: [
                            'rgba(0, 0, 0, 0.2)'
                        ],
                        borderColor: [
                            'rgba(0, 0, 0, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },
        error: function (result) {
            console.log('Error');

        },
        beforeSend: function (result) {
            console.log('Cargando');
        }
    });

    $.ajax({
        url: "/visitas/procedencia",
        data: "",
        method: "get",
        success: function (result) {
            let data = JSON.parse(result);
            for(let a = 0; a < data.length; a++){
                $('#tdcuerpoprocedencia').append('<tr><th scope="row">'+a+'</th><td>'+data[a]['url']+'</td><td>'+data[a]['fecha']+'</td><td>'+data[a]['conteo']+'</td></tr>');
            }
        },
        error: function (result) {
            console.log('Error');

        },
        beforeSend: function (result) {
            $('#tdcuerpoprocedencia').children('li').remove();
            console.log('Cargando');
        }
    });

    $.ajax({
        url: "/visitas/paginas/visitadas",
        data: "",
        method: "get",
        success: function (result) {
            let data = JSON.parse(result);
            for(let a = 0; a < data.length; a++){
                $('#tdcuerpomasviitados').append('<tr><th scope="row">'+a+'</th><td>'+data[a]['url']+'</td><td>'+data[a]['fecha']+'</td><td>'+data[a]['conteo']+'</td></tr>');
            }
        },
        error: function (result) {
            console.log('Error');

        },
        beforeSend: function (result) {
            $('#tdcuerpomasviitados').children('li').remove();
            console.log('Cargando');
        }
    });
});
