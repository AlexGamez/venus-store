<div class="productos">
    <!-- "Header" -->
    <div class="utilidades">
        <!-- Título -->
        <div class="primero">
            <h3 class="titulo">Inventory List</h3>
        </div>
        
        <!-- Buscar productos -->
        <div class="segundo">
            <input type="text" id="busqueda" placeholder="Buscar producto..." onkeyup="buscarProducto()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z"/></svg>
        </div>
        
        <!-- Agregar productos -->
        <div class="tercero">
            <button onclick="mostrarFormulario()" id="btnAgregarProducto">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM296 408L296 344L232 344C218.7 344 208 333.3 208 320C208 306.7 218.7 296 232 296L296 296L296 232C296 218.7 306.7 208 320 208C333.3 208 344 218.7 344 232L344 296L408 296C421.3 296 432 306.7 432 320C432 333.3 421.3 344 408 344L344 344L344 408C344 421.3 333.3 432 320 432C306.7 432 296 421.3 296 408z"/></svg>
            </button>
        </div>
    </div>                

<!-- Tabla de productos -->
    <div class="tabla-scroll">
        <table class="tabla-productos">
            <thead class="productos-header">
                <tr class="text-center align-middle productos-titulos">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Imagen frontal</th>
                    <th>Imagen trasera</th>
                    <th>Género</th>
                    <th>Tipo</th>
                    <th>Color</th>
                    <th>Talla</th>
                    <th>Imagenes adicionales</th>
                    <th>Fecha</th>
                    <th>New IN</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        <tbody id="tablaProductos">
            <!-- Aquí se cargarán los productos con AJAX -->
        </tbody>
        </table>
    </div>        
</div>