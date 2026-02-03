<!-- modal_producto.php -->
<div class="modal fade mt-4" id="productoModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true" data-bs-scroll="false">
  
  <div class="modal-dialog modal-xl modal-info">
    <div class="modal-padre">
      <div class="modal-content popup">

        <div class="col-sm-1 col-md-1 col-lg-1 carrusel-interno">
          <div class="div-dinamico"> <!-- Este div y su contenido se añade desde js mostrarDetalleProducto.js -->
            <img src="" alt=""> 
          </div>
        </div>

        <button type="button" class="btn-close cerrar" data-bs-dismiss="modal" aria-label="Cerrar"></button>

        <div class="col-sm-6 col-md-5 col-lg-5 modal-body-producto foto-popup">
          <img id="modalImagen-producto" class="zoom-img" src="" alt=""><!-- Imagen Principal se inserta desde js tambien-->
        </div>

        <div class="col-sm-5 col-md-5 col-lg-5 sub-contenido">
          <div class="modal-header-producto">
            <h5 class="modal-title-producto" id="modalNombre"> <!-- Nombre se inserta desde js --></h5>
            <p class="mt-4 ms-2" id="modalPrecioTexto">$<span id="modalPrecio"><!-- Precio se inserta desde js --></span></p>
          </div>

          <div class="modal-cantidad mt-3">
            <span>Cantidad:</span>
            <div class="mt-2 ms-2 botones-modal">
              <button class="btn-menos-modal">−</button>
              <span class="cantidad-modal">1</span>
              <button class="btn-mas-modal">+</button>
            </div>
          </div>

          <div class="d-grid gap-2 mt-4 p-0 sumar-cesta">
            <button class="btn btn-lg w-90 ms-2 checkout-modal">
              <span class="fs-8 fs-sm-5">AÑADIR AL CARRITO</span>
            </button>
          </div>

          <div class="mt-2 tallas">
            <div class="ms-2 talla">
              <span class="mt-3 ms-2 stock">Unds disponible:</span>
              <span class="mt-3 ms-2 talla-actual">Talla:
                <span id="talla-activa"></span>
              </span>
            </div>
            <div class="mt-2 ms-4 tallas-botones">
              <!-- <button>S</button>
              <button>M</button>
              <button>L</button>
              <button>XL</button> -->
            </div>
          </div>
          </div>
          
      </div>
      <div class="data-inferior">
          <div class="col-lg-12 descripcion">
            <p class="mt-1 mb-2"><strong>Descripcion</strong></p>
            <span id="modalDescripcion">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo libero unde corporis consequuntur repudiandae provident vero recusandae, nam non modi quisquam repellendus commodi necessitatibus magni veritatis odit aliquid, dolore earum!
            </span>
          </div>

          <div class="col-lg-12 detalles">
            <span><strong> Detales:</strong></span>
            <ul>
              <li><span>Material: </span> Algodón y lana<span id="material"></span></li>
              <li><span>Cuidados: </span>Lavar en frío, No planchar <span id="cuidados"></span></li>
              <li><span>Hecho en: </span>Colombia <span id="colombia"></span></li>
            </ul>
          </div>
          <div class="col-lg-12 entrega">
            <span><strong>Envío y devoluciones:</strong></span>
            <ul>
              <li>Envios a todo el pais</li>
              <li>Entrega estimada: Entre 3-7 días hábiles</li>
              <li>Cuentas con 7 días(naturales) para devolver sin costo.</li>
            </ul>
          </div>
      </div>
    </div>
  </div>
</div>