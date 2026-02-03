document.addEventListener('DOMContentLoaded', () => {
    ventasBadge();
});

function ventasBadge() {
    fetch(`${window.BASE_URL}/admin/back-graficas.php`)
        .then(r => r.json())
        .then(data => {
            console.log('DATA BACKEND:', data);
            
            // ==============================
            // TOTAL HISTÓRICO
            // ==============================
            const totalVentasSpan = document.getElementById('totalVentas');
            if (totalVentasSpan) {
                const totalFormateado = data.ventas_totales.toLocaleString('es-CO', {
                    style: 'currency',
                    currency: 'COP',
                    minimumFractionDigits: 0
                });
                totalVentasSpan.textContent = totalFormateado;
            }

            // ==============================
            // % CRECIMIENTO
            // ==============================
            const crecimientoSpan = document.getElementById('crecimiento-ventas');
            if (crecimientoSpan) {

                const totalActual = Number(data.total_mes_actual) || 0;
                const totalAnterior = Number(data.total_mes_anterior) || 0;

                const crecimiento = totalAnterior > 0
                    ? ((totalActual - totalAnterior) / totalAnterior) * 100
                    : 100;

                const signo = crecimiento >= 0 ? '+' : '';
                crecimientoSpan.textContent = `${signo}${crecimiento.toFixed(1)}%`;

                // Opcional: color según sube o baja
                crecimientoSpan.classList.toggle('positivo', crecimiento >= 0);
                crecimientoSpan.classList.toggle('negativo', crecimiento < 0);
            }

        })
        .catch(err => console.error('Error cargando ventas:', err));
}
