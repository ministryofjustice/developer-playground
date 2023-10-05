import Chart from 'chart.js/auto';

let businessCases = {};

const businessCaseChart = document.getElementById('business-case-dashboard-chart');

if (businessCaseChart) {
    businessCases.rates = new Chart(businessCaseChart, {
        type: 'pie',
        data: {
            datasets: [{
                data: [ 16, 3, 24 ],
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
            }],
            labels: ['Blue', 'Purple', 'Orange']
        }
    });
}

export default businessCases;
