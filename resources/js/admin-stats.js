document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('adminChart');
    if (canvas) {
        // const data = JSON.parse(canvas.dataset.data);
        // const labels = JSON.parse(canvas.dataset.labels);
        const data = window.appData?.allStats || {};
        const labels = window.appData?.allCosts || {};
        const ctx = canvas.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Количество кликов',
                    data,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});