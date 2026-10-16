<?php require_once '../../modelo/libro.php'; 
$id = $_GET['id'] ?? null;
$libro = $id ? Libro::obtenerPorId($id) : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <h1>Detalle de Libro</h1>

                <?php if ($libro): ?>
                <div class="card">
                    <div class="card-body">
                        <p><strong>ID:</strong> <?php echo $libro->id; ?></p>
                        <p><strong>Título:</strong> <?php echo $libro->titulo; ?></p>
                        <p><strong>Autor:</strong> <?php echo $libro->autor; ?></p>
                        <p><strong>Año Publicación:</strong> <?php echo $libro->anioPublicacion; ?></p>
                        <p><strong>Cantidad de Páginas:</strong> <?php echo $libro->cantidadPaginas; ?></p>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="listar.php" class="btn btn-secondary">Volver</a>
                    <a href="editar.php?id=<?php echo $libro->id; ?>" class="btn btn-warning">Editar</a>
                </div>
                <?php else: ?>
                <div class="alert alert-danger">Libro no encontrado</div>
                <a href="listar.php" class="btn btn-secondary">Volver</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
