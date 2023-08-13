<div class="contenedor-app">
    <div class="imagen">
    <img src="/build/imagenes/<?php echo $producto->imagenes?>" style="height: 45rem;" alt="" class="img-item">
    </div>
    <div class="app">
        <h2 class="titulo-item" style="font-family: Roboto;font-style: normal;"><span><?php echo $producto->Titulo; ?></span></h2>
        <p><?php echo $producto->Descripcion; ?></p>
        
        <div class="precioC">
            S/.<span class="precio-item"><?php echo $producto->Precio;?></span>
        </div>
        <div class="stock" hidden>
            <span><?php echo $producto->stock;?></span>
        </div>
        <div class="detall">
            
            <button class="btn btn-info btn-sm" style="font-size:1.5rem;"  data-id="<?php echo $producto->id?>">
                +
            </button>
            <p id="cantidadDe" class="cant" style="font-size:1.3rem">1</p>
            <button  class="btn btn-danger btn-sm" style="font-size:1.5rem; padding-right:1rem;margin-left:0.9rem" data-id="<?php echo $producto->id?>">
            -
            </button>
        
            <button id="agregarManga" class="boton1 agregar-carrito" style="padding:1rem;margin:0 0 0 5rem;" data-id="<?php echo $producto->id ?>">Añadir al Carrito</button>
        </div>
    </div>
</div>

<?php
    $script = '
    <script src="build/js/app.js"></script>
    
    '
?>