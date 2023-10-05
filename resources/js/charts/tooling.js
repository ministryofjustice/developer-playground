import Chart from 'chart.js/auto';

let tooling = {};

// How many tools are created each year; display the tooling rate, over time
const toolingChart = document.getElementById('tooling-dashboard-chart');

if (toolingChart) {
    tooling.rates = new Chart(toolingChart, {
        type: 'bar',
        data: {
            datasets: [{
                label: 'Tooling trend',
                data: {
                    "2019": 9,
                    "2020": 5,
                    "2021": 32
                },
                backgroundColor: [
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 5
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

export default tooling
