<?php

define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/build/imagenes/');

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
    return $s;
}

function validarid(string $url) {
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    
    if(!$id) {
        header("Location: $url " );
    }

    return $id;
}

function validarCategoria(string $url) {
    $categoria = $_GET['categoria'];
    
    $contenedor=['Shonen','Deporte','shoujo','Terror'];
    if(!in_array($categoria, $contenedor)) {
        header("Location: $url " );
        exit;
    }

    return $categoria;
}

function validarORedireccionar(string $url) {
    $valor = $_GET['pagina'];
    $valor = filter_var($valor, FILTER_VALIDATE_INT);
    
    if(!$valor) {
        header("Location: $url " );
    }

    return $valor;
}
// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /login');
    }
}

function isAdmin() : void {
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}
