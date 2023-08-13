<?php

namespace Model;


use PHPMailer\PHPMailer\PHPMailer;

class EmailCompra extends ActiveRecord{

    protected static $tabla = 'emailcompra';//no respeta las mayusculas el sql
    protected static $columnasDB = ['id', 'nombre', 'email', 'producto', 'cantidad', 'precio_unitario', 'precio_venta','total','fecha_compra'];

    public $id;
    public $nombre;
    public $email;
    public $telefono;
    public $producto;
    public $cantidad;
    public $precio_unitario;
    public $precio_venta;
    public $total;
    public $fecha_compra;

    
    public function __construct()
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->producto = $args['producto'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->precio_unitario = $args['precio_unitario'] ?? '';
        $this->precio_venta = $args['precio_venta'] ?? '';
        $this->total = $args['total'] ?? '';
        $this->fecha_compra = $args['fecha_compra'] ?? '';
    }

    public function enviarConfirmacion($args=[]) {

         // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('teitukomangas@correo.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Pago realizado con exito';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre .  "</strong>, este es su factura de su compra en Teitukomangas</p>";
        for ($i = 0; $i < count($args); $i++) {
            $contenido.="<p><strong>".($i+1).".</strong> Nombre del manga: <strong>" . $args[$i]['productos'] . " </strong></p>";
            $contenido.="<p>Cantidad: " . $args[$i]['cantidad'] . "</p>";
            $contenido.="<p>El precio unitario: S/. " . $args[$i]['precio_unitario']. "</p>";
        }
        $contenido .= "<p><strong>Total:</strong> S/. ".$this->total."</a>";
        $contenido .= "<p>Muchas gracias por la compra!</p>";
        $contenido .= "<p>De parte de teitukomangas@correo.com</p>";
        $contenido .= '</html>';
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }
}