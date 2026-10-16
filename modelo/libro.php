<?php
require_once __DIR__ . '/../core/Database.php';

class Libro {
    private const NOMBRE_CLASE = 'Libro';
    
    public $id;
    public $titulo;
    public $autor;
    public $anioPublicacion;
    public $cantidadPaginas;

    public function __construct() {
        // Constructor vacío para que FETCH_CLASS funcione correctamente
    }

    /**
     * Obtener todas las personas desde la BD
     * Usando FETCH_CLASS para mapear automáticamente a objetos Persona (ORM)
     */
    public static function obtenerTodas() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT id, titulo, autor, anioPublicacion, cantidadPaginas FROM libros ORDER BY id DESC');
            $stmt->execute();
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
        } catch (PDOException $e) {
            error_log("Error al obtener libros: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener una persona por ID
     * Usando FETCH_CLASS para mapear automáticamente a objeto Persona (ORM)
     */
    public static function obtenerPorId($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT id, titulo, autor, anioPublicacion, cantidadPaginas FROM libros WHERE id = :id');
            $stmt->execute([':id' => $id]);
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener libro: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Agregar una nueva persona
     */
    public static function agregar($titulo, $autor, $anioPublicacion, $cantidadPaginas) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('INSERT INTO libros (titulo, autor, anioPublicacion, cantidadPaginas) VALUES (:titulo, :autor, :anioPublicacion, :cantidadPaginas)');
            
            return $stmt->execute([
                ':titulo' => $titulo,
                ':autor' => $autor,
                ':anioPublicacion' => $anioPublicacion,
                ':cantidadPaginas' => $cantidadPaginas
            ]);
        } catch (PDOException $e) {
            error_log("Error al agregar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Editar una persona existente
     */
    public static function editar($id, $titulo, $autor, $anioPublicacion, $cantidadPaginas) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('UPDATE libros SET titulo = :titulo, autor = :autor, anioPublicacion = :anioPublicacion, cantidadPaginas = :cantidadPaginas WHERE id = :id');
            
            return $stmt->execute([
                ':id' => $id,
                ':titulo' => $titulo,
                ':autor' => $autor,
                ':anioPublicacion' => $anioPublicacion,
                ':cantidadPaginas' => $cantidadPaginas
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar una persona
     */
    public static function eliminar($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('DELETE FROM libros WHERE id = :id');
            
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar libro: " . $e->getMessage());
            return false;
        }
    }
}
?>
