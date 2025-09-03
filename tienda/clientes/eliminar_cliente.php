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
    $id_cliente = $_GET['id'];

    // 2. Prepara la consulta SQL para evitar la inyección SQL
    $stmt = $conn->prepare("CALL eliminar_cliente(?)");
    $stmt->bind_param("i", $id_cliente);

    // 3. Ejecuta la consulta
    if ($stmt->execute()) {
        // La eliminación fue exitosa, redirige a la lista de productos
        $_SESSION['mensaje'] = 'El cliente se ha eliminado exitosamente';
        $stmt->close();
        $conn->close();
        header("Location: listar_clientes.php");
        exit();
    } else {
        // Muestra un mensaje de error si la eliminación falla
        $_SESSION['error'] = "Error al eliminar el cliente: " . $stmt->error;
        $stmt->close();
        $conn->close();
        header("Location: listar_clientes.php");
        exit();
    }
} else {
    // Si no se proporcionó un ID, muestra un error o redirige
    $_SESSION['error'] = "ID de cliente no especificado.";
    $stmt->close();
    $conn->close();
    header("Location: listar_clientes.php");
    exit();
}
