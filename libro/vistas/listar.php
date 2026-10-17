<?php require_once '../../modelo/libro.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <h1>Libros</h1>
            </div>
            <div class="col text-end">
                <a href="editar.php" class="btn btn-success">+ Agregar</a>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Año Publicación</th>
                    <th>Cantidad de Páginas</th>
                </tr>
            </thead>
            <tbody>
                <?php $libros = Libro::obtenerTodas(); foreach ($libros as $l): ?>
                <tr>
                    <td><?php echo $l->id; ?></td>
                    <td><?php echo $l->titulo; ?></td>
                    <td><?php echo $l->autor; ?></td>
                    <td><?php echo $l->anioPublicacion; ?></td>
                    <td><?php echo $l->cantidadPaginas; ?></td>
                    <td>
                        <a href="ver.php?id=<?php echo $l->id; ?>" class="btn btn-sm btn-primary">Ver</a>
                        <a href="editar.php?id=<?php echo $l->id; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <form method="POST" action="../acciones.php" style="display:inline;">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id" value="<?php echo $l->id; ?>">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>