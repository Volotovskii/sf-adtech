document.addEventListener('DOMContentLoaded', function () {


    const allStats = window.appData?.allStats || {};
    const allCosts = window.appData?.allCosts || {};

    console.log('All Stats Data:', allStats);
    console.log('All Costs Data:', allCosts);

    // Функция для создания и обновления графика
    function createChart(ctx, initialLabels, initialDatasets, chartType = 'line', options = {}) {
        return new Chart(ctx, {
            type: chartType,
            data: {
                labels: initialLabels,
                datasets: initialDatasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                    x: {
                        // ticks: {
                        //     maxRotation: 45,
                        //     minRotation: 0
                        // }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    }
                },
                ...options
            }
        });
    }

    // Подготовка данных для графика
    function prepareData(type, selectedId = null) {
        let labels = new Set();
        let datasets = [];

        const dataToUse = type === 'clicks' ? allStats : allCosts;

        let finalLabels = [];

        if (selectedId && dataToUse[selectedId]) {
            // Только один оффер
            const offer = dataToUse[selectedId];
            const data = offer.data;

            if (data && data.length > 0) {
                data.forEach(d => {
                    labels.add(d.period);
                });

                finalLabels = Array.from(labels).sort();

                const dataMap = {};
                data.forEach(d => {
                    const value = type === 'clicks' ? d.count : parseFloat(d.total_cost);
                    dataMap[d.period] = value;
                });

                const chartData = finalLabels.map(label => dataMap[label] || 0);

                datasets.push({
                    label: offer.name,
                    data: chartData,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.1,
                    fill: false
                });
            } else {
                datasets.push({
                    label: offer.name,
                    data: [], // <-- ИСПРАВЛЕНО: добавлено 'data:'
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    tension: 0.1,
                    fill: false
                });
            }
        } else {
            // Все офферы
            Object.values(dataToUse).forEach((offer) => {
                const data = offer.data;
                if (data && data.length > 0) {
                    data.forEach(d => labels.add(d.period));
                }
            });

            finalLabels = Array.from(labels).sort();

            Object.entries(dataToUse).forEach(([id, offer], index) => {
                const data = offer.data;

                if (data && data.length > 0) {
                    const dataMap = {};
                    data.forEach(d => {
                        const value = type === 'clicks' ? d.count : parseFloat(d.total_cost);
                        dataMap[d.period] = value;
                    });

                    const chartData = finalLabels.map(label => dataMap[label] || 0);

                    datasets.push({
                        label: offer.name,
                        data: chartData,
                        borderColor: `hsl(${index * 137.5} 50% 50%)`,
                        backgroundColor: `hsla(${index * 137.5} 50% 50%, 0.2)`,
                        tension: 0.1,
                        fill: false
                    });
                } else {
                    const chartData = finalLabels.map(label => 0);
                    datasets.push({
                        label: offer.name,
                        data: chartData,
                        borderColor: `hsl(${index * 137.5} 50% 50%)`,
                        backgroundColor: `hsla(${index * 137.5} 50% 50%, 0.2)`,
                        tension: 0.1,
                        fill: false
                    });
                }
            });
        }
        return {
            labels: finalLabels,
            datasets: datasets
        };
    }


    const initialOfferId = new URLSearchParams(window.location.search).get('offer_id');

    let {
        labels: clicksLabels,
        datasets: clicksData
    } = prepareData('clicks', initialOfferId);
    let {
        labels: costsLabels,
        datasets: costsData
    } = prepareData('costs', initialOfferId);

    let clicksChart = createChart(
        document.getElementById('clicksChart').getContext('2d'),
        clicksLabels,
        clicksData
    );

    let costsChart = createChart(
        document.getElementById('costsChart').getContext('2d'),
        costsLabels,
        costsData
    );

    document.getElementById('statsFilterForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const groupByValue = document.getElementById('group_by').value;
        const offerIdValue = document.getElementById('offerFilter').value;

        // Формируем новый URL с обоими параметрами
        const url = new URL(window.location);
        url.searchParams.set('group_by', groupByValue);
        if (offerIdValue) { // Если выбран конкретный оффер
            url.searchParams.set('offer_id', offerIdValue);
        } else { // Если "Все офферы"
            url.searchParams.delete('offer_id');
        }

        window.location.href = url.toString();
    });

    document.getElementById('offerFilter').addEventListener('change', function () {
        const selectedId = this.value;


        let {
            labels: newClicksLabels,
            datasets: newClicksData
        } = prepareData('clicks', selectedId);
        clicksChart.data.labels = newClicksLabels;
        clicksChart.data.datasets = newClicksData;
        clicksChart.update();


        let {
            labels: newCostsLabels,
            datasets: newCostsData
        } = prepareData('costs', selectedId);
        costsChart.data.labels = newCostsLabels;
        costsChart.data.datasets = newCostsData;
        costsChart.update();
    });
});