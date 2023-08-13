<?php 

namespace Controllers;

use Model\Producto;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController {
    public static function productos( Router $router ) {
        // session_start();
        isAdmin();
        
        $paginas=validarORedireccionar('/productos?pagina=1');
        $pagina= isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $postPorPagina=10;
        
        $inicio=($pagina>1) ? ($pagina * $postPorPagina- $postPorPagina) : 0;

        $productos=Producto::productosAdmin($inicio,$postPorPagina);
        if(empty($productos)){
            header('Location: /productos?pagina=1');
        }
        $totalArticulos=Producto::cantidadFilas();
        $totalArticulos=intval($totalArticulos->id);
        
        $numeroPaginas= ceil($totalArticulos/$postPorPagina);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'productos'=>$productos,
            'numeroPaginas'=>$numeroPaginas,
            'pagina'=>$pagina
        ]);
    }

    public static function crear(Router $router){
        // session_start();
        isAdmin();
        $producto= new Producto;//esto es para tener al objeto vacio
        // debuguear($producto);
        //Arreglo con mensajes de errores
        $alertas=Producto::getAlertas();

        if($_SERVER['REQUEST_METHOD']==='POST'){

            $producto->sincronizar($_POST['productos']);

    
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            
            // Setear la imagen
            // Realiza un resize a la imagen con intervention
            if($_FILES['productos']['tmp_name']['imagenes']){//si existe entonces lo va a colocar(setImagen)
                
                $image = Image::make($_FILES['productos']['tmp_name']['imagenes'])->fit(400,600);//estas son funciones del composer
                
                $producto->setImagen($nombreImagen);//ponemos el nombre de la imagen en el array $propiedad
                
            }
            

            // Validar
            $alertas = $producto->validar();
            
    
            if(empty($alertas)){
    
                // Crear la carpeta para subir imagenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                // Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                $resultado=$producto->guardar();
                if($resultado) {
                    header('location: /productos?resultado=1');
                }
    
            }

        }

        $router->render('admin/crear',[
            'alertas' => $alertas,
            'producto'=>$producto
        ]);
    }

    public static function actualizar(Router $router){
        // session_start();
        isAdmin();
        $id = validarid('/productos');

        // Obtener los datos de la propiedad
        $producto= Producto::find($id);
        

        //Arreglo con mensajes de errores
        $alertas=Producto::getAlertas();
        

        if($_SERVER['REQUEST_METHOD']==='POST'){

            $args=$_POST['productos'];
    
            //para que los valores que actualices, se inserten en una array nuevo
            $producto->sincronizar($args);
            //y luego sean validadas, es decir si está está completa
            $alertas=$producto->validar();
    
            // Subida de archivos
            // Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
            if($_FILES['productos']['tmp_name']['imagenes']) {//si existe esta imagen, entonces 
                $image = Image::make($_FILES['productos']['tmp_name']['imagenes'])->fit(400,600);//crea la imagen como se pide
                $producto->setImagen($nombreImagen);//ponemos el nombre de la imagen en el array $propiedad
            }
    
    
            if(empty($alertas)){
    
                // Almacenar la imagen
                //como el "actualizar" de imagen es "eliminar y crear", entonces hacemos de nuevo la comprobacion
                if($_FILES['productos']['tmp_name']['imagenes']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);//entonces guardamos la imagen en el array
                    //el codigo de arriba solo se debe ejecutar si hay una nueva imagen
                }
                $resultado=$producto->guardar();
                if($resultado){
                    header('Location: /productos?resultado=2');
                }
            }
        }

        $router->render('admin/actualizar',[
            'producto'=>$producto,
            'alertas'=>$alertas
        ]);
    }

    public static function eliminar(){
        // session_start();
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if($id) {
    
                $eliminar=Producto::find($id);
                
                $resultado=$eliminar->eliminar();

                if ($resultado) {
                    $eliminar->borrarImagen();
                    header('location: /productos?resultado=3');
                }
            }
            
        }
        
    }

}