<?php
require_once '../modelo/libro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $anioPublicacion = $_POST['anioPublicacion'] ?? '';
    $cantidadPaginas = $_POST['cantidadPaginas'] ?? '';
    $id = $_POST['id'] ?? '';

    if ($accion === 'agregar') {
        Libro::agregar($titulo, $autor, $anioPublicacion, $cantidadPaginas);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'editar') {
        Libro::editar($titulo, $autor, $anioPublicacion, $cantidadPaginas);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'eliminar') {
        Libro::eliminar($id);
        header('Location: vistas/listar.php');
        exit;
    }
}
?>
