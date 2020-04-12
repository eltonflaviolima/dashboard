$('document').ready(function () {

    $.ajax({
        type: "POST",
        url: chart.php,
        dataType: "json",
        success: function (data) {

            var sensorarray = [];
            var dataarray = [];

            for (var i in data) {
                sensorarray.push(data[i].sensorPressao);
            }

            grafico(sensorarray);

        }
    });
})

function grafico (sensorarray) {
    var ctx = document.getElementById('myChart').getContext('2d');
    //TODO adicionar grafico dinâmico
    //https://www.youtube.com/watch?v=De-zusP8QVM
    var chartGraf = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1h','2h'],
            datasets: [{
                label: false,
                data: [1,2],
                borderWidth: 4,
                borderColor: 'rgba(198, 93, 55, 0.815)',
                backgroundColor: 'rgba(198, 93, 55, 0.2)',
                fontFamily: 'RobotoMono'
            }]
        },
        options: {
            tooltips: {
                callbacks: {
                    label: (item) => `${item.yLabel} bar`,
                },
            },
            legend: {
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                fontFamily: 'RobotoMono',
                text: "PRESSÃO"
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        drawOnChartArea: false,
                        color: '#1D2123'
                    },
                    fontFamily: 'RobotoMono',
                    fontSize: 20
                }],
                yAxes: [{
                    gridLines: {
                        drawOnChartArea: false,
                        color: '#1D2123'
                    }
                }]
            }
        }
    });

}
