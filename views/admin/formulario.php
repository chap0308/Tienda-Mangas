<style>
    legend {
        font-size: 2rem;
        color: black;
    }
    label{
        font-weight: bold;
        text-transform: uppercase;
        display: block;
    }
    input:not([type="submit"]), 
    textarea,
    select {
        padding: 1rem;
        display: block;
        width: 100%;
        background-color: white;
        border: 1px solid grey;
        border-radius: 1rem;
        margin-bottom: 2rem;
    }
    textarea {
        height: 20rem;
    }
</style>
<fieldset>
    <legend>Producto</legend>

    <label for="Titulo">Titulo:</label>
    <input type="text" id="Titulo" name="productos[Titulo]" placeholder="Titulo del producto" value="<?php echo s(trim( $producto->Titulo ) ); ?>">
    
    <label for="Precio">Precio:</label>
    <input type="number" step="0.01" id="Precio" name="productos[Precio]" placeholder="Precio del producto" value="<?php echo $producto->Precio ? s(trim( $producto->Precio ) ) :''; ?>">


    <label for="Autor">Autor:</label>
    <input type="text" id="Autor" name="productos[Autor]" placeholder="Autor del producto" value="<?php echo s(trim( $producto->Autor ) ); ?>">


    <label for="Editorial">Editorial:</label>
    <input type="text" id="Editorial" name="productos[Editorial]" placeholder="Editorial del producto" value="<?php echo s(trim( $producto->Editorial ) ); ?>">


    <label for="fecha_lanzamiento">Fecha de Lanzamiento:</label>
    <input type="date" id="fecha_lanzamiento" name="productos[fecha_lanzamiento]" placeholder="fecha de lanzamiento del producto" value="<?php echo s(trim( $producto->fecha_lanzamiento ) ); ?>">


    <label for="Descripcion">Descripcion:</label>
    <textarea id="Descripcion" name="productos[Descripcion]"><?php echo s(trim( $producto->Descripcion ) ); ?></textarea>

</fieldset>
<fieldset>
    
    <label for="imagenes">Imagen:</label>
    <input type="file" id="imagenes" accept="image/jpeg, image/png" name="productos[imagenes]">

    <?php if($producto->imagenes) { ?>
        <img src="/build/imagenes/<?php echo $producto->imagenes ?>" style="width:20%;">
    <?php } ?>



    <label for="Categoría">Categoría:</label>
    <input type="text" id="Categoría" name="productos[Categoría]" placeholder="Categoría del producto" value="<?php echo s(trim( $producto->Categoría ) ); ?>">


    <label for="Popularidad">Popularidad:</label>
    <input type="number" step="0.01" id="Popularidad" name="productos[Popularidad]" placeholder="Popularidad del producto" value="<?php echo s(trim( $producto->Popularidad) ); ?>">


    <label for="stock">Stock:</label>
    <input type="number" id="stock" name="productos[stock]" placeholder="stock del producto" value="<?php echo s(trim( $producto->stock ) ); ?>">



</fieldset>