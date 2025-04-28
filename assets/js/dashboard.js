

chartsData.forEach(chartConfig => {
    const ctx = document.getElementById(chartConfig.chartId).getContext('2d');
    new Chart(ctx, {
        type: chartConfig.chartType,
        data: {
            labels: chartConfig.labels,
            datasets: [{
                label: chartConfig.labelText,
                data: chartConfig.data,
                borderColor: chartConfig.borderColor,
                backgroundColor: chartConfig.backgroundColor,
                fill: true
            }]
        }, 
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    })
})