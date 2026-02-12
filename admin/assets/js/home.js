// En lugar de solo DOMContentLoaded, usa un pequeño retraso para probar
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        console.log("Ejecutando ventasBadge con retraso...");
        ventasBadge();
    }, 500); // Medio segundo de retraso
});
function ventasBadge() {
    fetch(`${window.BASE_URL}/back-graficas.php`)
        .then(r => r.json())
        .then(data => {
            console.log('DATA RECIBIDA:', data);

            const totalVentasSpan = document.getElementById('totalVentas');
            const crecimientoSpan = document.getElementById('crecimiento-ventas');

            // ESTO ES PARA DEPURAR:
            if (!totalVentasSpan) {
                console.warn("⚠️ Error: No encontré el span #totalVentas en el DOM.");
                return; // Detenemos la ejecución si no existe
            }

            // Si llegamos aquí, el elemento existe
            const totalFormateado = Number(data.ventas_totales).toLocaleString('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            });
            
            totalVentasSpan.textContent = totalFormateado;
            console.log("✅ HTML actualizado con:", totalFormateado);

            // Lógica de crecimiento...
            if (crecimientoSpan) {
                const totalActual = Number(data.total_mes_actual) || 0;
                const totalAnterior = Number(data.total_mes_anterior) || 0;
                const crecimiento = totalAnterior > 0 ? ((totalActual - totalAnterior) / totalAnterior) * 100 : 100;
                const signo = crecimiento >= 0 ? '+' : '';
                crecimientoSpan.textContent = `${signo}${crecimiento.toFixed(1)}%`;
            }
        })
        .catch(err => console.error('Error cargando ventas:', err));
}
