<?php

namespace Controllers;



use Model\Compras;
use Model\DetalleCompras;
use Model\EmailCompra;
use Model\Producto;
use MVC\Router;
use \Stripe\StripeClient;


class CarritoController{
    public static function index(Router $router){

        $router->render('carrito/index',[
        ]);
    }
    
    public static function pagar(){
        $token=uniqid();
        $args=['token'=>$token,'idUsuario'=>intval($_POST['idUsuario'])];
        $compras= new Compras($args);
        $verdad=$compras->verificarCompra($_POST['idUsuario']);
        if(isset($verdad)){
            $args=['token'=>$token];
            $verdad->sincronizar($args);
            $verdad->guardar();
        }else{
            $compras->guardar();
        }

        $idUsuario=intval($_POST['idUsuario']);
        
        // $idProductos=explode(",",$_POST['productos']);
        $nombresProd=explode(",",$_POST['nombre']);
        $cant=explode(",",$_POST['cantidad']);
        $precioUn=explode(",",$_POST['precio_unitario']);
        // $precioVen=explode(",",$_POST['precio_venta']);
        // $stock=explode(",",$_POST['stock']);
        $products=[];

        

        for($i=0; $i<count($cant); $i++){
            // $arreglo=[
            //     'manga_id'=>$idProductos[$i],
            //     'compra_id'=>$idCompras,
            //     'precio_unitario'=>$precioUn[$i],
            //     'cantidad'=>$cant[$i],
            //     'precio_venta'=>$precioVen[$i]
            // ];
            // $arreglo2=[
            //     'stock'=>$stock[$i]
            // ];
            $products[] = [
                'name' => $nombresProd[$i],
                'amount' => floatval($precioUn[$i])*100,
                'quantity' => intval($cant[$i]),
            ];
            // $detalleCompras=new DetalleCompras($arreglo);
            // $detalleCompras->crear();

            // $producto=Producto::find($idProductos[$i]);
            // $producto->sincronizar($arreglo2);
            // $producto->guardar();

        }

        $lineItems = [];

        foreach ($products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'pen',
                    'unit_amount' => $product['amount'], // Monto en centavos para cada producto
                    'product_data' => [
                        'name' => $product['name'],
                    ],
                ],
                'quantity' => $product['quantity'],
            ];
        }
        
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $stripe = new \Stripe\StripeClient('sk_test_51NLgwCAlWKSY6t8kNnO44n546zprmnVrtyRyrH3t6qovZToW6iTmS7aLE0HZ4wyT9C3lfQzW2xOgkJE6WlSQLEBF00lttVD28b');
            
            $session =$stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $_ENV['APP_URL'].'/pagado?id='.$idUsuario.'&token='.$token,
                'cancel_url' => $_ENV['APP_URL'].'/carrito',
            ]);
            // header('Location: ' . $session->url);
            // exit();
            
            
        }
        
        $respuesta=[
            'session'=>$session
            // 'resultado'=>$resultado

        ];
        echo json_encode($respuesta);
        // exit;
    }
    public static function pagado(Router $router){

        $tok=s($_GET['token']);
        $id=s($_GET['id']);
        // debuguear($id=='""' );

        // debuguear($tok);
        // debuguear(is_null($tok) && is_null($id) );
        //debuguear(is_null($tok) && is_null($id) );
        if(is_null($tok) || is_null($id) || $tok==="''" || $id==="''" || $tok==='' || $id==='' ){
            header('Location: /');
            exit;
        }
        // if(){
        //     header('Location: /');
        //     exit;
        // }

        $resultado=Compras::findCompra($id,$tok);
        // debuguear($resultado);
        // debuguear($resultado->confirmado);
        // debuguear($resultado->token);
        // debuguear($tok);
        if( !isset($resultado) || $resultado->confirmado==1){
            header('Location: /');
            exit;
        }
        
        $resultado->confirmado=1;
        $resultado->token=null;
        $resultado->guardar();

        $router->render('carrito/pagado',[
        ]);
    }

}