
const ctz = document.getElementById('desempenho-consultor').getContext('2d');
const chartConsul = new Chart(ctz, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'Desempenho de Cada Consultor',
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
        url:'pages/chart-info-consultants.php',
        dataType:'json',
        success:function(chart_info){
            chartConsul.destroy();
            performanceChart = new Chart(ctz, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov'],
                    datasets: [{
                        label: 'Desempenho dos Consultores',
                        data: [chart_info[0].valor, chart_info[1].valor, chart_info[2].valor, chart_info[3].valor, chart_info[4].valor, chart_info[5].valor, chart_info[6].valor, chart_info[7].valor, chart_info[8].valor, chart_info[9].valor, chart_info[10].valor, chart_info[11].valor],
                        backgroundColor: [
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)',
                            'rgb(0, 0, 255)',
                            'rgb(255, 0, 0)',
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
                            'rgb(255, 0, 0)',
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


    const cty = document.getElementById('receita-liquida-consultor').getContext('2d');
    const chartConsulPizza = new Chart(cty, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'Receita Líquida dos Consultores',
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
            url:'pages/chart-info-consultants.php',
            dataType:'json',
            success:function(chart_info){
                chartConsulPizza.destroy();
                performanceChart = new Chart(cty, {
                    type: 'doughnut',
                    data: {
                        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov'],
                        datasets: [{
                            label: 'Receita Líquida dos Consultores',
                            data: [chart_info[0].valor, chart_info[1].valor, chart_info[2].valor, chart_info[3].valor, chart_info[4].valor, chart_info[5].valor, chart_info[6].valor, chart_info[7].valor, chart_info[8].valor, chart_info[9].valor, chart_info[10].valor, chart_info[11].valor],
                            backgroundColor: [
                                'rgb(0, 0, 255)',
                                'rgb(255, 0, 0)',
                                'rgb(0, 0, 255)',
                                'rgb(255, 0, 0)',
                                'rgb(0, 0, 255)',
                                'rgb(255, 0, 0)',
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
                                'rgb(255, 0, 0)',
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