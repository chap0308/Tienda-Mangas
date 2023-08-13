<?php

namespace Model;

class Producto extends ActiveRecord{

    protected static $tabla = 'producto';
    protected static $columnasDB = ['id','Titulo', 'Descripcion','Precio', 'Autor','Editorial','fecha_lanzamiento','imagenes','Categoría', 'Popularidad', 'stock'];

    public $id;
    public $Titulo;
    public $Descripcion;
    public $Precio;
    public $Autor;
    public $Editorial;
    public $fecha_lanzamiento;
    public $imagenes;
    public $Categoría;
    public $Popularidad;
    public $stock;

    public function __construct($args=[]){
        
        $this->id=$args['id'] ?? NULL;//si existe en el array $args un $key llamado 'id', entonces toma NULL.
        $this->Titulo=$args['Titulo'] ?? '';
        $this->Descripcion=$args['Descripcion'] ?? '';
        $this->Precio=$args['Precio'] ?? 0;
        $this->Autor=$args['Autor'] ?? '';
        $this->Editorial=$args['Editorial'] ?? '';
        $this->fecha_lanzamiento=$args['fecha_lanzamiento'] ?? '';
        $this->imagenes=$args['imagenes'] ?? '';
        $this->Categoría=$args['Categoría'] ?? '';
        $this->Popularidad=$args['Popularidad'] ?? '';
        $this->stock=$args['stock'] ?? '';

    }

    public function validar() {

        if(!$this->Titulo){
            self::$alertas[]="Debes añadir un Titulo";
        }
        if(!$this->Descripcion){
            self::$alertas[]="Debes añadir la descripcion";
        }

        if(!$this->Precio ) {
            self::$alertas[] = 'Debes añadir el precio';
        }
        if(!$this->Autor){
            self::$alertas[]="El autor es obligatorio";
        }
        if(!$this->Editorial){
            self::$alertas[]="La editorial es obligatorio";
        }

        if(!$this->fecha_lanzamiento ) {
            self::$alertas[] = 'Falta la fecha';
        }
        if(!$this->imagenes ) {
            self::$alertas[] = 'La Imagen es Obligatoria';
        }
        if(!$this->Categoría ) {
            self::$alertas[] = 'El categoria es obligatorio';
        }

        return self::$alertas;

    }
}