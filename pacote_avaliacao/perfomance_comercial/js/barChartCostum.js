
const ctx = document.getElementById('desempenho-cliente').getContext('2d');
const chartCostum = new Chart(ctx, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'Desempenho dos Clientes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)'
            ],
            borderColor: [
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

    $.ajax({
        url:'pages/chart-info-costumers.php',
        dataType:'json',
        success:function(chart_info){
            chartCostum.destroy();
            performanceChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov'],
                    datasets: [{
                        label: 'Desempenho dos Clientes',
                        data: [chart_info[0].valor, chart_info[1].valor, chart_info[2].valor, chart_info[3].valor, chart_info[4].valor, chart_info[5].valor, chart_info[6].valor, chart_info[7].valor, chart_info[8].valor, chart_info[9].valor, chart_info[10].valor, chart_info[11].valor],
                        backgroundColor: [
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)'
                        ],
                        borderColor: [
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })


const ctw = document.getElementById('receita-liquida-cliente').getContext('2d');
const chartCostumPizza = new Chart(ctw, {
    type: 'pie',
    data: {
        datasets: [{
            label: 'Receita Líquida dos Clientes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)'
            ],
            borderColor: [
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)',
                'rgb(0, 0, 255)',
                'rgb(255, 0, 0)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

    $.ajax({
        url:'pages/chart-info-costumers.php',
        dataType:'json',
        success:function(chart_info){
            chartCostumPizza.destroy();
            performanceChart = new Chart(ctw, {
                type: 'pie',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov'],
                    datasets: [{
                        label: 'Receita Líquida dos Clientes',
                        data: [chart_info[0].valor, chart_info[1].valor, chart_info[2].valor, chart_info[3].valor, chart_info[4].valor, chart_info[5].valor, chart_info[6].valor, chart_info[7].valor, chart_info[8].valor, chart_info[9].valor, chart_info[10].valor, chart_info[11].valor],
                        backgroundColor: [
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)'
                        ],
                        borderColor: [
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })
