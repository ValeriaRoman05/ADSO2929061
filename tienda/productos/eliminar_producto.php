<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Incluye el archivo de conexión a la base de datos
include("../config/conexion.php");

// 1. Verifica si se ha recibido un ID de producto por la URL
if (isset($_GET['id'])) {
    // Sanitiza el ID para asegurar que sea un número entero
    $id_producto = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($id_producto === false) {
        $_SESSION['error'] = "ID de producto no válido.";
        header("Location: listar_productos.php");
        exit();
    }

    try {
        // 2. Prepara la llamada al procedimiento almacenado
        $stmt = $conn->prepare("CALL DeleteProducto(?)");

        // 3. Vincula el parámetro a la llamada
        $stmt->bind_param("i", $id_producto);

        // 4. Ejecuta la llamada
        if ($stmt->execute()) {
            // La eliminación fue exitosa, redirige a la lista de productos
            $_SESSION['mensaje'] = 'El producto se ha eliminado exitosamente';
            header("Location: listar_productos.php");
            exit();
        } else {
            // Muestra un mensaje de error si la eliminación falla
            $_SESSION['error'] = "Error al eliminar el producto: " . $stmt->error;
            header("Location: listar_productos.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error inesperado al eliminar el producto: " . $e->getMessage();
        header("Location: listar_productos.php");
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    // Si no se proporcionó un ID, muestra un error o redirige
    $_SESSION['error'] = "ID de producto no especificado.";
    header("Location: listar_productos.php");
    exit();
}
?>