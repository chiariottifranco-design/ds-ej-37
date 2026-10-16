<?php
require_once '../modelo/persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $edad = $_POST['edad'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $id = $_POST['id'] ?? '';

    if ($accion === 'agregar') {
        Persona::agregar($nombre, $email, $edad, $telefono);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'editar') {
        Persona::editar($id, $nombre, $email, $edad, $telefono);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'eliminar') {
        Persona::eliminar($id);
        header('Location: vistas/listar.php');
        exit;
    }
}
?>
