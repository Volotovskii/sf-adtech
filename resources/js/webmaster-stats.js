
document.addEventListener('DOMContentLoaded', function () {
    // const allClicks = @json($allClicks);
    // const allEarnings = @json($allEarnings);
    const allClicks = window.appData?.allClicks || {};
    const allEarnings = window.appData?.allEarnings || {};

    // Функция для создания графика
    function createChart(ctx, labels, datasets, options = {}) {
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                ...options
            }
        });
    }

    // Подготовка данных для кликов
    let clicksLabels = new Set();
    let clicksDatasets = [];

    Object.values(allClicks).forEach((offer, index) => {
        offer.data.forEach(d => clicksLabels.add(d.period));
    });

    clicksLabels = Array.from(clicksLabels).sort();

    Object.entries(allClicks).forEach(([id, offer], index) => {
        const dataMap = {};
        offer.data.forEach(d => {
            dataMap[d.period] = d.count;
        });

        const chartData = clicksLabels.map(label => dataMap[label] || 0);

        clicksDatasets.push({
            label: offer.name,
            data: chartData,
            borderColor: `hsl(${index * 137.5} 50% 50%)`,
            tension: 0.1
        });
    });

    // Подготовка данных для доходов
    let earningsLabels = new Set();
    let earningsDatasets = [];

    Object.values(allEarnings).forEach((offer, index) => {
        offer.data.forEach(d => earningsLabels.add(d.period));
    });

    earningsLabels = Array.from(earningsLabels).sort();

    Object.entries(allEarnings).forEach(([id, offer], index) => {
        const dataMap = {};
        offer.data.forEach(d => {
            dataMap[d.period] = parseFloat(d.total_earnings) || 0;
        });

        const chartData = earningsLabels.map(label => dataMap[label] || 0);

        earningsDatasets.push({
            label: offer.name,
            data: chartData,
            borderColor: `hsl(${index * 137.5} 50% 50%)`,
            tension: 0.1
        });
    });

    // Создаём графики
    const clicksChart = createChart(
        document.getElementById('clicksChart').getContext('2d'),
        clicksLabels,
        clicksDatasets
    );

    const earningsChart = createChart(
        document.getElementById('earningsChart').getContext('2d'),
        earningsLabels,
        earningsDatasets
    );
});