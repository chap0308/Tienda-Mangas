<?php

namespace Model;

class Compras extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'compra';
    protected static $columnasDB = ['id', 'idUsuario', 'total', 'fecha_compra','token','confirmado'];

    public $id;
    public $idUsuario;
    public $total;
    public $fecha_compra;
    public $token;
    public $confirmado;

    public function __construct($args = [])
    {
        date_default_timezone_set('America/Lima');
        $fecha_actual = date('Y-m-d');
        $this->id = $args['id'] ?? null;
        $this->idUsuario = $args['idUsuario'] ?? null;
        $this->total = $args['total'] ?? 0;
        $this->fecha_compra = $args['fecha_compra'] ?? $fecha_actual;
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }
}