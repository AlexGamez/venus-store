<header>
    <div>
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
            <path
                d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z" />
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
        </svg>

        <!-- Dark-mode -->
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
            <path
                d="M320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576C388.8 576 451.3 548.8 497.3 504.6C504.6 497.6 506.7 486.7 502.6 477.5C498.5 468.3 488.9 462.6 478.8 463.4C473.9 463.8 469 464 464 464C362.4 464 280 381.6 280 280C280 207.9 321.5 145.4 382.1 115.2C391.2 110.7 396.4 100.9 395.2 90.8C394 80.7 386.6 72.5 376.7 70.3C358.4 66.2 339.4 64 320 64z" />
        </svg>
    </div>

</header>

<section class="home-contenido">
    <!-- saludo -->
    <h3 class="titulo">Bienvenido de vuelta
        <span>
            👋
        </span>
    </h3>
    <p>Dashboard</p>

    <!-- graficas -->
    <div class="datos">
        <div class="datos-div-1">
            <canvas id="graficaVentas"></canvas>
        </div>

        <div class="datos-div-2">
            <div class="datos-div-2-superior">
                <!-- Ventas totales historico -->
                <div class="datos-div-2-sub-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M192 96C156.7 96 128 124.7 128 160L128 384C128 419.3 156.7 448 192 448L544 448C579.3 448 608 419.3 608 384L608 160C608 124.7 579.3 96 544 96L192 96zM368 192C412.2 192 448 227.8 448 272C448 316.2 412.2 352 368 352C323.8 352 288 316.2 288 272C288 227.8 323.8 192 368 192zM192 216L192 168C192 163.6 195.6 160 200 160L248 160C252.4 160 256.1 163.6 255.5 168C251.9 197 228.9 219.9 200 223.5C195.6 224 192 220.4 192 216zM192 328C192 323.6 195.6 319.9 200 320.5C229 324.1 251.9 347.1 255.5 376C256 380.4 252.4 384 248 384L200 384C195.6 384 192 380.4 192 376L192 328zM536 223.5C507 219.9 484.1 196.9 480.5 168C480 163.6 483.6 160 488 160L536 160C540.4 160 544 163.6 544 168L544 216C544 220.4 540.4 224.1 536 223.5zM544 328L544 376C544 380.4 540.4 384 536 384L488 384C483.6 384 479.9 380.4 480.5 376C484.1 347 507.1 324.1 536 320.5C540.4 320 544 323.6 544 328zM80 216C80 202.7 69.3 192 56 192C42.7 192 32 202.7 32 216L32 480C32 515.3 60.7 544 96 544L488 544C501.3 544 512 533.3 512 520C512 506.7 501.3 496 488 496L96 496C87.2 496 80 488.8 80 480L80 216z" />
                    </svg>

                    <span id="crecimiento-ventas">$-</span>

                    <div class="total-ventas-texto">
                        <p>VENTAS TOTALES</p>
                        <span id="totalVentas">--</span>
                    </div>
                </div>

                <!-- Pedidos del día -->
                <div class="datos-div-2-sub-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M32 160C32 124.7 60.7 96 96 96L384 96C419.3 96 448 124.7 448 160L448 192L498.7 192C515.7 192 532 198.7 544 210.7L589.3 256C601.3 268 608 284.3 608 301.3L608 448C608 483.3 579.3 512 544 512L540.7 512C530.3 548.9 496.3 576 456 576C415.7 576 381.8 548.9 371.3 512L268.7 512C258.3 548.9 224.3 576 184 576C143.7 576 109.8 548.9 99.3 512L96 512C60.7 512 32 483.3 32 448L32 160zM544 352L544 301.3L498.7 256L448 256L448 352L544 352zM224 488C224 465.9 206.1 448 184 448C161.9 448 144 465.9 144 488C144 510.1 161.9 528 184 528C206.1 528 224 510.1 224 488zM456 528C478.1 528 496 510.1 496 488C496 465.9 478.1 448 456 448C433.9 448 416 465.9 416 488C416 510.1 433.9 528 456 528z" />
                    </svg>

                    <span>+19%</span>

                    <div class="total-pedidos-texto">
                        <p>ORDENES DIARIAS</p>
                        <span>40</span>
                    </div>
                </div>
            </div>

            <div class="datos-div-2-inferior">
                <!-- Visitas diarias a la tienda -->
                <div class="datos-div-3-sub-1">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M320 96C239.2 96 174.5 132.8 127.4 176.6C80.6 220.1 49.3 272 34.4 307.7C31.1 315.6 31.1 324.4 34.4 332.3C49.3 368 80.6 420 127.4 463.4C174.5 507.1 239.2 544 320 544C400.8 544 465.5 507.2 512.6 463.4C559.4 419.9 590.7 368 605.6 332.3C608.9 324.4 608.9 315.6 605.6 307.7C590.7 272 559.4 220 512.6 176.6C465.5 132.9 400.8 96 320 96zM176 320C176 240.5 240.5 176 320 176C399.5 176 464 240.5 464 320C464 399.5 399.5 464 320 464C240.5 464 176 399.5 176 320zM320 256C320 291.3 291.3 320 256 320C244.5 320 233.7 317 224.3 311.6C223.3 322.5 224.2 333.7 227.2 344.8C240.9 396 293.6 426.4 344.8 412.7C396 399 426.4 346.3 412.7 295.1C400.5 249.4 357.2 220.3 311.6 224.3C316.9 233.6 320 244.4 320 256z" />
                    </svg>

                    <span>+6%</span>

                    <div class="total-visitas-texto">
                        <p>DAILY STORE VISITS</p>
                        <span>240</span>
                    </div>
                </div>

                <!-- Nuevos clientes -->
                <div class="datos-div-3-sub-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M376 88C376 57.1 350.9 32 320 32C289.1 32 264 57.1 264 88C264 118.9 289.1 144 320 144C350.9 144 376 118.9 376 88zM400 300.7L446.3 363.1C456.8 377.3 476.9 380.3 491.1 369.7C505.3 359.1 508.3 339.1 497.7 324.9L427.2 229.9C402 196 362.3 176 320 176C277.7 176 238 196 212.8 229.9L142.3 324.9C131.8 339.1 134.7 359.1 148.9 369.7C163.1 380.3 183.1 377.3 193.7 363.1L240 300.7L240 576C240 593.7 254.3 608 272 608C289.7 608 304 593.7 304 576L304 416C304 407.2 311.2 400 320 400C328.8 400 336 407.2 336 416L336 576C336 593.7 350.3 608 368 608C385.7 608 400 593.7 400 576L400 300.7z" />
                    </svg>

                    <span>+19%</span>

                    <div class="total-clientes-texto">
                        <p>CLIENTES NUEVOS</p>
                        <span>20</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Ventas Recientes -->
    <div class="recientes">
        <div>
            <h4 class="titulo">Órdenes Recientes</h4>
            <div class="export-content">
                <button id="export" type="button" aria-label="Exportar Lista">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path fill="#ffffff"
                            d="M128.5 64C93.2 64 64.5 92.7 64.5 128L64.5 512C64.5 547.3 93.2 576 128.5 576L384.5 576C419.8 576 448.5 547.3 448.5 512L448.5 416L526.6 416L495.6 447C486.2 456.4 486.2 471.6 495.6 480.9C505 490.2 520.2 490.3 529.5 480.9L601.5 408.9C610.9 399.5 610.9 384.3 601.5 375L529.5 303C520.1 293.6 504.9 293.6 495.6 303C486.3 312.4 486.2 327.6 495.6 336.9L526.6 367.9L448.5 367.9L448.5 234.4C448.5 217.4 441.8 201.1 429.8 189.1L323.2 82.7C311.2 70.7 295 64 278 64L128.5 64zM390 240L296.5 240C283.2 240 272.5 229.3 272.5 216L272.5 122.5L390 240zM256.5 392C256.5 378.7 267.2 368 280.5 368L384.5 368L384.5 416L280.5 416C267.2 416 256.5 405.3 256.5 392z" />
                    </svg>
                    <span>Exportar Lista</span>
                </button>
            </div>
        </div>
        <table class="mt-2 tabla-ventas">
            <thead class="ventas-header">
                <tr class="ventas-titulos">
                    <th class="titulos">Orden ID</th>
                    <th class="titulos">Monto</th>
                    <th class="titulos">Fecha</th>
                    <th class="titulos">Estado</th>
                    <th class="titulos">Nombre</th>
                </tr>
            </thead>
            <tbody class="ventas-recientes">
                <!-- aquí JS inyecta filas -->
            </tbody>
        </table>
    </div>
</section>