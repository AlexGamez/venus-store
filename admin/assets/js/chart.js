function cargarGraficaVentas() {
    fetch(`${window.BASE_URL}/admin/back-graficas.php`)
        .then(r => r.json())
        .then(data => {

            // ==============================
            // 1. NORMALIZAMOS LOS DATOS
            // ==============================
            const totales = data.totales.map(Number);

            const mesesCortos = data.meses.map(m =>
                m.slice(0, 3).charAt(0).toUpperCase() + m.slice(1, 3).toLowerCase()
            );

            // ==============================
            // 3. CANVAS
            // ==============================
            const canvas = document.getElementById("graficaVentas");
            if (!canvas) return;

            const ctx = canvas.getContext("2d");

            // ==============================
            // 4. COLORES DESDE CSS
            // ==============================
            const styles = getComputedStyle(document.documentElement);

            const startColor = styles.getPropertyValue('--line-start').trim();
            const mainColor = styles.getPropertyValue('--line-main').trim();
            const endColor = styles.getPropertyValue('--line-end').trim();
            const fillColor = styles.getPropertyValue('--fill-color').trim();

            // ==============================
            // 5. CHART
            // ==============================
            new Chart(ctx, {
                type: "line",
                data: {
                    labels: mesesCortos,
                    datasets: [{
                        data: totales,
                        borderWidth: 2,
                        tension: 0.45,
                        pointRadius: 8.5,
                        pointBackgroundColor: "#fff",
                        fill: true,
                        maintainAspectRatio: false,

                        // ===== GRADIENTE LÍNEA =====
                        borderColor: (context) => {
                            const chart = context.chart;
                            const { ctx, chartArea } = chart;

                            if (!chartArea) return null;

                            const { top, bottom } = chartArea;

                            const gradient = ctx.createLinearGradient(
                                150,
                                top + (bottom - top) * 2.3,
                                chart.width,
                                bottom
                            );

                            gradient.addColorStop(0, startColor);
                            gradient.addColorStop(0.1, startColor);
                            gradient.addColorStop(0.3, mainColor);
                            gradient.addColorStop(0.8, mainColor);
                            gradient.addColorStop(1, endColor);

                            return gradient;
                        },

                        // ===== GRADIENTE RELLENO =====
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const { ctx, chartArea } = chart;

                            if (!chartArea) return null;

                            const gradient = ctx.createLinearGradient(
                                0,
                                chartArea.top,
                                0,
                                chartArea.bottom
                            );

                            gradient.addColorStop(0, fillColor);
                            gradient.addColorStop(1, 'rgba(255,255,255,0)');

                            return gradient;
                        }
                    }]
                },

                options: {
                    responsive: true,

                    layout: {
                        padding: { bottom: 45 }
                    },

                    animation: {
                        duration: 100,
                        easing: 'linear'
                    },

                    animations: {
                        y: {
                            easing: 'easeOutQuart',
                            duration: 800,
                            from: 2400
                        }
                    },

                    plugins: {
                        title: {
                            display: true,
                            text: 'Overview',
                            align: 'start',
                            color: '#ffffff',
                            font: {
                                size: 20,
                                weight: 'bold'
                            },
                            padding: { bottom: 20 }
                        },
                        legend: { display: false }
                    },

                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: {
                                color: "#f8f8f8",
                                font: { size: 9, weight: 'bold' },
                                maxRotation: 0,
                                autoSkip: true,
                                maxTicksLimit: window.innerWidth < 600 ? 6 : 12
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { display: false },
                            ticks: {
                                color: '#000',
                                font: { size: 10.5 },
                                callback: value => {
                                    if (value >= 1_000_000) return '$ ' + (value / 1_000_000) + 'M';
                                    if (value >= 1_000) return '$ ' + (value / 1_000) + 'K';
                                    return '$' + value;
                                }
                            }
                        }
                    }
                },

                plugins: [{
                    afterDraw(chart) {
                        const { ctx, chartArea } = chart;
                        if (!chartArea) return;

                        const total = chart.data.datasets[0].data
                            .map(Number)
                            .reduce((a, b) => a + b, 0);

                        const valor = total.toLocaleString('es-CO', {
                            style: 'currency',
                            currency: 'COP'
                        });

                        const titulo = "Total Recaudo";
                        const x = (chartArea.left + chartArea.right) / 2;
                        const y = chartArea.bottom - (chartArea.height - 230);

                        ctx.save();
                        ctx.textAlign = "center";
                        ctx.textBaseline = "top";

                        // Título
                        ctx.font = "12px sans-serif";
                        ctx.fillStyle = "#cac9c9";
                        ctx.fillText(titulo, x, y);

                        // Valor
                        ctx.font = "bold 16px sans-serif";
                        ctx.fillStyle = "#efeeee";
                        ctx.fillText(valor, x, y + 14);

                        ctx.restore();
                    }
                }]

            });
        });
}