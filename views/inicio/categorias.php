
<section class="contenedor">
    <div id="lista-productos" class="contenedor-items" style="margin-bottom: 5rem;">
        <?php foreach( $productos as $producto): ?>
            <div data-manga="<?php echo $producto->id ?>" class="item">
                <span class="titulo-item"><?php echo $producto->Titulo; ?></span>
                <img src="/build/imagenes/<?php echo $producto->imagenes?>" class="card-img-top" style="width:100px;height: 190px;cursor: pointer;"; alt="" class="img-item">
                <div class="precioC">
                    S/.<span class="precio-item"><?php echo $producto->Precio;?></span>
                </div>
                <div class="stock" hidden>
                    <span><?php echo $producto->stock;?></span>
                </div>
                <button class="boton-item agregar-carrito" data-id="<?php echo $producto->id ?>">Agregar al Carrito</button>
                
            </div>
        <?php endforeach; ?>
    </div>
    
</section>

<div class="paginacion">
    <ul>
    <?php  if($pagina==1){ ?>
        <li class="disabled">&laquo;</li>
    <?php  }else{ ?>
        <li><a href="/categorias?categoria=<?php echo $categoria ?>&pagina=<?php echo $pagina - 1 ?>" >&laquo;</a></li>
    <?php  } ?>

    <?php
        for($i=1;$i<=$numeroPaginas;$i++){
            if($pagina==$i){
                echo "<li class='active'><a href='/categorias?categoria=$categoria?&pagina=$i'>$i</a></li>";
            }else{
                echo "<li><a href='/categorias?categoria=$categoria&pagina=$i'>$i</a></li>";
            }
        }
    ?>
    <?php if($pagina==$numeroPaginas){   ?>
        <li class="disabled">&raquo;</li>
    <?php  }else{ ?>
        <li><a href="/categorias?categoria=<?php echo $categoria ?>&pagina=<?php echo $pagina + 1 ?>" >&raquo;</a></li>
    <?php  } ?>
    </ul>
</div>

<?php
    $script = '
    <script src="build/js/app.js"></script>
    '
?>