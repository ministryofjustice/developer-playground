import Chart from 'chart.js/auto';

let licence = {};

const licenceChart = document.getElementById('licence-dashboard-chart');

if (licenceChart) {
    licence.rates = new Chart(licenceChart, {
        type: 'line',
        data: {
            datasets: [{
                label: 'Licencing trend',
                data: {
                    "2019": 9,
                    "2020": 5,
                    "2021": 12
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

export default licence;
