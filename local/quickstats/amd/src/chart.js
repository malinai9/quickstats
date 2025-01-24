define(['jquery', 'core/str', 'core/ajax', 'core/chart'], function($, Str, Ajax, Chart) {
    return {
        init: function(canvasId, dataUrl) {
            // Obține datele de la server
            Ajax.call([{
                methodname: 'local_quickstats_get_chart_data',
                args: {},
                done: function(data) {
                    const ctx = document.getElementById(canvasId).getContext('2d');
                    const chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: Str.get_string('activeusers', 'local_quickstats'),
                                data: data.values,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                fill: true,
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
                },
                fail: function(err) {
                    console.error("Error fetching chart data:", err);
                }
            }]);
        }
    };
});
