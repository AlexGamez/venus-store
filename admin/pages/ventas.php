<div class="body-generales">
    <div class="container mt-4 header">

        <!-- Título -->
        <div class="primero">
            <h3 class="titulo">Gestión de Pedidos</h3>
        </div>
    </div>

    <div class="container d-flex justify-content-center gap-5 mt-5 pb-5">
        <div class="mt-1 generales">
            <h4 class="titulo">Ventas Generales</h4>
            <div class="totales">
                <table class="mt-2 tabla-ventas" id="tablaPedidos">
                    <thead class="ventas-header">
                        <tr class="ventas-titulos">
                            <!-- <th class="titulos uno" data-tipo="numero">ID</th> -->
                            <th class="titulos dos" data-tipo="numero">Monto</th>
                            <th class="titulos tres" data-tipo="fecha">Fecha</th>
                            <th class="titulos cuatro" data-tipo="estado">Estado</th>
                            <th class="titulos uno" data-tipo="nombre">Nombre</th>
                        </tr>
                    </thead>
                    <tbody class="ventas-generales">
                        <!-- aquí JS inyecta filas -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>