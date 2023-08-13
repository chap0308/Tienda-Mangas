<?php
// $mainArray = [];

// $subArray = ['name' => 1, 2, 3];
// $subArray2 = ['name' => 1, 2, 3];
// $subArray3 = ['name' => 1, 2, 3];

// $mainArray[] = $subArray;
// $mainArray[] = $subArray2;
// $mainArray[] = $subArray3;

// debuguear($mainArray);

?>

<section class="contenedor">
    <div id="lista-productos" class="contenedor-items" style="margin-bottom: 5rem;">
        <?php foreach( $productos as $producto): ?>
            <div data-manga="<?php echo $producto->id ?>" class="item">
                <span class="titulo-item"><?php echo $producto->Titulo; ?></span>
                <img src="/build/imagenes/<?php echo $producto->imagenes?>" class="card-img-top" style="width:100px;height: 190px;cursor: pointer;" alt="" class="img-item">
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
        <li><a href="?pagina=<?php echo $pagina - 1 ?>" >&laquo;</a></li>
    <?php  } ?>

    <?php
        for($i=1;$i<=$numeroPaginas;$i++){
            if($pagina==$i){
                echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";
            }else{
                echo "<li><a href='?pagina=$i'>$i</a></li>";
            }
        }
    ?>
    <?php if($pagina==$numeroPaginas){   ?>
        <li class="disabled">&raquo;</li>
    <?php  }else{ ?>
        <li><a href="?pagina=<?php echo $pagina + 1 ?>" >&raquo;</a></li>
    <?php  } ?>
    </ul>
</div>
<?php
    $script = '
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="build/js/app.js"></script>
    
    '
?>