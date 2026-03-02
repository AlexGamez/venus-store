// 1️⃣ FUNCIÓN ORIGINAL (NO CAMBIA)
function ventasBadge() {
    fetch(`${window.BASE_URL}/back-graficas.php`)
        .then(r => r.json())
        .then(data => {
            console.log('DATA RECIBIDA:', data);

            const totalVentasSpan = document.getElementById('totalVentas');
            const crecimientoSpan = document.getElementById('crecimiento-ventas');

            if (!totalVentasSpan) {
                console.warn("⚠️ No existe #totalVentas aún");
                return;
            }

            const totalFormateado = Number(data.ventas_totales).toLocaleString('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            });

            totalVentasSpan.textContent = totalFormateado;
            console.log("✅ Ventas actualizadas:", totalFormateado);

            if (crecimientoSpan) {
                const totalActual = Number(data.total_mes_actual) || 0;
                const totalAnterior = Number(data.total_mes_anterior) || 0;
                const crecimiento = totalAnterior > 0
                    ? ((totalActual - totalAnterior) / totalAnterior) * 100
                    : 100;

                const signo = crecimiento >= 0 ? '+' : '';
                crecimientoSpan.textContent = `${signo}${crecimiento.toFixed(1)}%`;
            }
        })
        .catch(err => console.error('Error cargando ventas:', err));
}

// 2️⃣ AL CARGAR LA PÁGINA (F5)
document.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        console.log("🚀 DOM cargado, ejecutando ventasBadge");
        ventasBadge();
    }, 500);
});

// 3️⃣ CUANDO EL DASHBOARD INSERTA HTML (CAMBIO DE PESTAÑA)
const observer = new MutationObserver(() => {
    const totalVentasSpan = document.getElementById('totalVentas');

    if (totalVentasSpan) {
        console.log("👀 totalVentas apareció en el DOM");
        ventasBadge();
    }
});

// 4️⃣ ACTIVAMOS EL OBSERVER UNA SOLA VEZ
observer.observe(document.body, {
    childList: true,
    subtree: true
});