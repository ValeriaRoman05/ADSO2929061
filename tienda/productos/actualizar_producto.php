<?php
session_start();
include("../config/conexion.php");

// Comprueba que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera y sanitiza los datos del formulario
    $id_producto = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    try {
        // 1. Prepara la llamada al procedimiento almacenado
        $stmt = $conn->prepare("CALL UpdateProducto(?, ?, ?, ?)");

        // 2. Vincula los parámetros a la llamada
        $stmt->bind_param("isdi", $id_producto, $nombre, $precio, $stock);

        // 3. Ejecuta la llamada
        if ($stmt->execute()) {
            // La actualización fue exitosa, redirige al usuario a la lista de productos
            $_SESSION['mensaje']='El producto se ha actualizado exitosamente';
            header("Location: listar_productos.php");
            exit();
        } else {
            // Si hay un error, muestra un mensaje
            $_SESSION['error']="Error al actualizar el producto: " . $stmt->error;
            header("Location: listar_productos.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error inesperado al actualizar el producto: " . $e->getMessage();
        header("Location: listar_productos.php");
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    // Si la solicitud no es POST o faltan datos, muestra un mensaje de error
    $_SESSION['error'] = "Acceso no válido o datos faltantes.";
    header("Location: listar_productos.php");
    exit();
}
?>