<?php
    foreach($alertas as $key => $mensajes):
        foreach($mensajes as $mensaje):
            
?>
    <div class="alerta <?php echo $key; ?>" style="<?php echo $_GET['token'] ? 'margin-top: 10rem' : '';  ?>;">
        <?php echo $mensaje; ?>
    </div>
<?php
        endforeach;
    endforeach;
?>