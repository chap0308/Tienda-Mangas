<?php

namespace Model;

class DetalleCompras extends ActiveRecord {
    protected static $tabla = 'detalle_compra';
    protected static $columnasDB = ['id','manga_id', 'compra_id', 'precio_unitario', 'cantidad', 'precio_venta'];

    public $id;
    public $manga_id;
    public $compra_id;
    public $precio_unitario;
    public $cantidad;
    public $precio_venta;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->manga_id = $args['manga_id'] ?? '';
        $this->compra_id = $args['compra_id'] ?? '';
        $this->precio_unitario = $args['precio_unitario'] ?? null; 
        $this->cantidad = $args['cantidad'] ?? null; 
        $this->precio_venta = $args['precio_venta'] ?? null; 

    }
}