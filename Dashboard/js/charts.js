$('document').ready(function (){

    $.ajax({
        type: "POST",
        url: chart.php,
        dataType: "json",
        success: function (data) {
            alert("Ok");
        }
    });
})

var ctx = document.getElementById('myChart');
//TODO adicionar grafico dinâmico
//https://www.youtube.com/watch?v=De-zusP8QVM
var chartGraf = new Chart(ctx, {
type: 'line',
data: {
    labels: ["0h", "4h", "8h", "12h", "16h", "20h"],
    datasets: [{
        label:false,
        data: [12,35,38,29,37,16],
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






var ctx2 = document.getElementById('myChart2');
var chartGraf = new Chart(ctx2, {
    type: 'line',
    data: {
        labels: ["0h", "4h", "8h", "12h", "16h", "20h"],
        datasets: [{
            label:false,
            data: [12,35,38,29,37,16],
            borderWidth: 4,
            borderColor: 'rgba(94, 107, 121, 0.836)',
            backgroundColor: 'rgba(94, 107, 121, 0.2)',
            fontFamily: 'RobotoMono'
        }]
    },
    options: {
        legend: {
            display: false
        },
        title: {
            display: true,
            fontSize: 20,
            text: "PRESSÃO",
            fontFamily: 'RobotoMono'
        },
        scales: {
            xAxes: [{
                gridLines: {
                    drawOnChartArea: false
                }
            }],
            yAxes: [{
                gridLines: {
                    drawOnChartArea: false
                }   
            }]
        }
    }
})
