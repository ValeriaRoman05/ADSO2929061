<?php
// Inicia la sesión y verifica si el usuario está autenticado
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Incluye el archivo de conexión a la base de datos
include("../config/conexion.php");

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera los datos del formulario
    $id_cliente = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // 1. Prepara la consulta SQL usando sentencias preparadas para evitar la inyección SQL
    $stmt = $conn->prepare("UPDATE clientes SET nombre = ?, email = ? WHERE id_cliente = ?");

    // 2. Vincula los parámetros a la consulta
    $stmt->bind_param("ssi", $nombre, $email, $id_cliente);

    // 3. Ejecuta la consulta
    if ($stmt->execute()) {
        // La actualización fue exitosa, redirige al usuario a la lista de productos
        $_SESSION['mensaje'] = 'El cliente se ha actualizado exitosamente';
        header("Location: listar_clientes.php");
        $stmt->close();
        $conn->close();
        exit();
    } else {
        // Si hay un error, muestra un mensaje
        $_SESSION['error'] = "Error al actualizar el cliente: " . $stmt->error;
        $stmt->close();
        $conn->close();
        header("Location: listar_clientes.php");
        exit();
    }

}
