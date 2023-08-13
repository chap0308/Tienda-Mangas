<?php

namespace Controllers;

use Model\Compras;
use Model\DetalleCompras;
use Model\EmailCompra;
use Model\Producto;


class APIController {
    public static function index(){
        $productos=Producto::all();
        
        $respuesta=[
            'productos'=>$productos
        ];

        echo json_encode($respuesta);
        
    }
    public static function guardar(){
        $args=['fecha_compra'=>$_POST['fecha_compra'],'total'=>$_POST['total']];
        $compras= Compras::findCompraId($_POST['idUsuario']);//se guarda lo que coincida con los valores del pedido
        // debuguear($total);
        $compras->sincronizar($args);
        $resultado=$compras->guardar();

        $idCompras=$compras->id;

        $idProductos=explode(",",$_POST['productos']);//IMPORTANTE, PARA SEPARAR CADA ID
        $cant=explode(",",$_POST['cantidad']);
        $precioUn=explode(",",$_POST['precio_unitario']);
        $precioVen=explode(",",$_POST['precio_venta']);
        $stock=explode(",",$_POST['stock']);
        
        
        for($i=0; $i<count($idProductos); $i++){
            $arreglo=[
                'manga_id'=>$idProductos[$i],
                'compra_id'=>$idCompras,
                'precio_unitario'=>$precioUn[$i],
                'cantidad'=>$cant[$i],
                'precio_venta'=>$precioVen[$i]
            ];
            $arreglo2=[
                'stock'=>$stock[$i]
            ];
            
            $detalleCompras=new DetalleCompras($arreglo);
            $detalleCompras->crear();

            $producto=Producto::find($idProductos[$i]);
            $producto->sincronizar($arreglo2);
            $producto->guardar();

        };
        
        $consulta = "SELECT compra.id, concat(usuarios.nombre,' ',usuarios.apellido) as nombre, usuarios.email, usuarios.telefono, producto.Titulo as producto, detalle_compra.cantidad, ";
        $consulta .= " detalle_compra.precio_unitario, detalle_compra.precio_venta, compra.total, compra.fecha_compra ";
        $consulta .= " FROM compra ";
        $consulta .= " LEFT OUTER JOIN usuarios ON compra.idUsuario=usuarios.id ";
        $consulta .= " LEFT OUTER JOIN detalle_compra ON detalle_compra.compra_id=compra.id ";
        $consulta .= " LEFT OUTER JOIN producto ON producto.id=detalle_compra.manga_id  ";
        $consulta .= " WHERE compra.id = $idCompras ";

        $email = EmailCompra::SQL($consulta);
        foreach($email as $mail){
            $productos[]=[
                'productos'=>$mail->producto,
                'cantidad'=>$mail->cantidad,
                'precio_unitario'=>$mail->precio_unitario,
            ];
        };
        $email[0]->enviarConfirmacion($productos);

        $respuesta=[
            'resultado'=>$resultado
        ];
        echo json_encode($respuesta);
    }
}