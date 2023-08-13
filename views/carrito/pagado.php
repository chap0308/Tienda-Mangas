<div id="mostrar-contenido" style="display:none;">
    <h1 class="nombre-pagina" style="margin-top:10rem;">Se ha compleado el pago correctamente!!</h1>
    <p class="descripcion-pagina" style="margin-top:10rem;font-size: 2.5rem;">Por favor, revise su correo, hemos enviado un mensaje con todos los detalles de la compra.</p>
    <a href="/" style="font-size: 1.30rem;display: flex;justify-content: center;">Inicio</a>
</div>
<div id="spiner" style="display: block;">
    <h1 class="nombre-pagina" style="margin-top:10rem;font-size: 4rem">Cargando la compra, espere por favor...</h1>
</div>

<div id="actualizar-pago">
        <?php
            date_default_timezone_set('America/Lima');
            $fecha_actual = date('Y-m-d');
            
        ?>
    <div hidden>

        <p id="fecha"><?php echo $fecha_actual ?></p>
    </div>
</div>
<form class="formulario" method="GET" hidden>
    <div class="campo">
        <label for="token">Email</label>
        <input
            type="text"
            id="token"
            name="token"
            
        />
    </div>
</form>

<?php
    $script = '
    <script src="build/js/app.js"></script>
    '
?>