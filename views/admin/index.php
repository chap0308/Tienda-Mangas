<h1 class="nombre-pagina">Productos</h1>

<?php if( intval( $resultado ) === 1): ?>
            <p class="alerta exito">Producto Creado Correctamente</p>
        <?php elseif( intval( $resultado ) === 2): ?>
            <p class="alerta exito">Actualizado Correctamente</p>
        <?php elseif( intval( $resultado ) === 3 ): ?>
            <p class="alerta exito">Producto Eliminado Correctamente</p>
<?php endif; ?>


<main class="contenedor seccion">
    <a href="/AgregarProductos" class="boton-verde">Agregar Nuevo Producto</a>

    <table class="propiedades" style="margin-top:2rem;">
        <thead >
            <tr>
                <th>Codigo del producto</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th style="text-align: center;">Imagenes</th>
                <th>Acciones</th>
            </tr>
        </thead>
        
        <tbody>
        <?php foreach($productos as $producto){ ?>
            <tr >

                <td><?php echo $producto->id; ?></td>
                <td><?php echo $producto->Titulo; ?></td>
                <td><?php echo $producto->Precio ?></td>
                <td><?php echo $producto->Categoría ?></td>
                <td><?php echo $producto->stock ?></td>
                <td style="text-align: center;"> <img src="/build/imagenes/<?php echo $producto->imagenes ?>" style="width: 20%;"> </td>
                
                <td>
                    
                    <form method="POST" class="" action="/EliminarProductos">

                        <input type="hidden" name="id" value="<?php echo $producto->id; ?>">

                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                
                    <a href="/ActualizarProductos?id=<?php echo $producto->id; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
        <?php } ?>
            </tr>
        </tbody>

    </table>
</main>

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