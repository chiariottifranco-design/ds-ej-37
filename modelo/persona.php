<?php
require_once __DIR__ . '/../core/Database.php';

class Persona {
    private const NOMBRE_CLASE = 'Persona';
    
    public $id;
    public $nombre;
    public $email;
    public $edad;
    public $telefono;

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
            $stmt = $db->prepare('SELECT id, nombre, email, edad, telefono FROM personas ORDER BY id DESC');
            $stmt->execute();
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
        } catch (PDOException $e) {
            error_log("Error al obtener personas: " . $e->getMessage());
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
            $stmt = $db->prepare('SELECT id, nombre, email, edad, telefono FROM personas WHERE id = :id');
            $stmt->execute([':id' => $id]);
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener persona: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Agregar una nueva persona
     */
    public static function agregar($nombre, $email, $edad) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('INSERT INTO personas (nombre, email, edad, telefono) VALUES (:nombre, :email, :edad, :telefono)');
            
            return $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':edad' => $edad,
                ':telefono' => $telefono
            ]);
        } catch (PDOException $e) {
            error_log("Error al agregar persona: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Editar una persona existente
     */
    public static function editar($id, $nombre, $email, $edad, $telefono) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('UPDATE personas SET nombre = :nombre, email = :email, edad = :edad, telefono = :telefono WHERE id = :id');
            
            return $stmt->execute([
                ':id' => $id,
                ':nombre' => $nombre,
                ':email' => $email,
                ':edad' => $edad,
                ':telefono' => $telefono
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar persona: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar una persona
     */
    public static function eliminar($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('DELETE FROM personas WHERE id = :id');
            
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar persona: " . $e->getMessage());
            return false;
        }
    }
}
?>
