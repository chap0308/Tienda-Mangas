<?php

namespace Controllers;

use Model\Producto;
use MVC\Router;

class PaginasController{
    public static function index(Router $router){
        $paginas=validarORedireccionar('/?pagina=1');
        $pagina= isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $postPorPagina=16;
        
        $inicio=($pagina>1) ? ($pagina * $postPorPagina- $postPorPagina) : 0;

        $productos=Producto::cantidadPorPagina($inicio,$postPorPagina);
        if(empty($productos)){
            header('Location: /?pagina=1');
        }
        $totalArticulos=Producto::cantidadFilas();
        $totalArticulos=intval($totalArticulos->id);
        
        $numeroPaginas= ceil($totalArticulos/$postPorPagina);

        $router->render('inicio/index',[
            'productos'=>$productos,
            'numeroPaginas'=>$numeroPaginas,
            'pagina'=>$pagina
        ]);
    }

    public static function categorias(Router $router){
        
        $categoria = validarCategoria('/?pagina=1');
        $paginas=validarORedireccionar('/categorias?categoria='.$categoria.'&pagina=1');
        $pagina= isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $postPorPagina=16;
        
        $inicio=($pagina>1) ? ($pagina * $postPorPagina- $postPorPagina) : 0;
        $productos= Producto::cantidadPorPaginaCategoria($categoria,$inicio,$postPorPagina);
        if(empty($productos)){
            header('Location: /categorias?categoria='.$categoria.'&pagina=1');
        }
        $totalArticulos=Producto::cantidadFilasCategoria($categoria);
        $totalArticulos=intval($totalArticulos->id);
        $numeroPaginas= ceil($totalArticulos/$postPorPagina);
        
        $router->render('inicio/categorias',[
            'productos'=>$productos,
            'numeroPaginas'=>$numeroPaginas,
            'pagina'=>$pagina,
            'categoria'=>$categoria
        ]);
    }

    public static function detalles(Router $router){
        $id=$_GET['id'];
        $producto=Producto::find($id);
        // debuguear($producto);
        if(!$producto){
            header('Location: /');
        }
        
        $router->render('inicio/detalles',[
            'producto'=>$producto
        ]);
    }

}