<h1 class="nombre-pagina">Actualizar Producto</h1>

<main class="contenedor seccion" >
    <a href="/productos" class="boton-verde">Volver</a>

    <?php foreach ($alertas as $alerta) : ?>
        <div class="alerta error">
            <?php echo $alerta; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario1" method="POST" enctype="multipart/form-data">

    <?php include __DIR__.'/formulario.php'; ?>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>

</main>