<div class="container" style="margin-top: 10rem; min-height: 600px;">
    <H1 class="" >Realizar Compra</H1>
    <form id="procesar-pago">

        <div id="carrito1" class="form-group table-responsive" >
            <table class="form-group table" id="lista-compra" style >
                <thead>
                    <tr id="">
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Sub Total</th>
                        <th scope="col"></th>
                    </tr>

                </thead>
                <tbody >
                
                </tbody>

                <div class="subtotal">
                    <th colspan="4" scope="col" class="text-right">TOTAL :</th>
                    <th>
                        <p id="totalCompra"  class="price"></p>
                    </th>
                </div >
                
            </table>
        </div>
        <div class="botones-comprar">
            <div id="mensaje-compra" style="display:none;" >
                <p >No tienes ningún artículo en tu carrito de compras.</p>
            </div>
            <div class="col-md-4 mb-2" style="text-align: center;">
                <a href="/" class="btn btn-info btn-block" >Seguir comprando</a>
            </div>
            
        </div>
        
    </form>
    <form id="procesar-compra" action="/carrito" method="POST" style="text-align: center;">
        <button type="submit" id="checkout-button">Pagar</button>
    </form>
        

</div>

<?php
    $script = '
    <script src="https://js.stripe.com/v3/"></script>
    <script src="build/js/app.js"></script>
    '
?>