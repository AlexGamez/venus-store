<header>
    <div>
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
            <path
                d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z" />
            <title>Buscar</title>
        </svg>
        <!-- buscar -->
        <input type="text" id="buscador" placeholder="Buscar ordenes, productos, clientes...">
    </div>

    <div class="utilidades-home">
        <!-- perfil -->
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
            <path
                d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z" />
            <title>Cuenta</title>
        </svg>

        <!-- Dark-mode -->
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
            <path
                d="M320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576C388.8 576 451.3 548.8 497.3 504.6C504.6 497.6 506.7 486.7 502.6 477.5C498.5 468.3 488.9 462.6 478.8 463.4C473.9 463.8 469 464 464 464C362.4 464 280 381.6 280 280C280 207.9 321.5 145.4 382.1 115.2C391.2 110.7 396.4 100.9 395.2 90.8C394 80.7 386.6 72.5 376.7 70.3C358.4 66.2 339.4 64 320 64z" />
            <title>Modo oscuro</title>
        </svg>
    </div>
</header>

<!-- <div class="container generales"> -->
<div class="body-generales">
    <section class="ventas-contenido">

        <!-- Título -->
        <article class="primero">
            <h3 class="titulo">Gestión de Órdenes</h3>
        </article>

        <div class="totales">
            <table class="tabla-ventas" id="tablaPedidos">
                <thead class="ventas-header">
                    <tr class="ventas-titulos">
                        <th class="titulos uno" data-tipo="numero">ID</th>
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
    </section>
</div>