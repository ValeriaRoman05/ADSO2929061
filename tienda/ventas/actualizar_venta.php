<?php
// Inicia la sesión y verifica si el usuario está autenticado
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Incluye el archivo de conexión a la base de datos
include("../config/conexion.php");

// 1. Verifica si la solicitud es de tipo POST y si se recibieron los datos esperados
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['id_cliente']) && isset($_POST['id_producto']) && isset($_POST['cantidad'])) {

    // 2. Recupera los datos del formulario
    $id_venta = $_POST['id'];
    $id_cliente = $_POST['id_cliente'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // 3. Prepara la consulta SQL usando sentencias preparadas para evitar la inyección SQL
    $stmt = $conn->prepare("UPDATE ventas SET id_cliente = ?, id_producto = ?, cantidad = ? WHERE id_venta = ?");

    // 4. Vincula los parámetros a la consulta
    // "iiii" indica que los 4 parámetros son de tipo entero (integer)
    $stmt->bind_param("iiii", $id_cliente, $id_producto, $cantidad, $id_venta);

    // 5. Ejecuta la consulta
    if ($stmt->execute()) {
        // La actualización fue exitosa, redirige al usuario a la lista de ventas
        $_SESSION['mensaje']='la venta se ha actualizado exitosamente';
        $stmt->close();
        $conn->close();
        header("Location: listar_ventas.php");
        exit();
    } else {
        // Si hay un error, muestra un mensaje
        $_SESSION['error'] = "Error al actualizar la venta: " . $stmt->error;
        $stmt->close();
        $conn->close();
        header("Location: listar_ventas.php");
        exit();
    }
} else {
    // Si la solicitud no es POST o faltan datos, muestra un mensaje de error
    $_SESSION['error'] = "Acceso no válido o datos faltantes.";
    $conn->close();
    header("Location: listar_ventas.php");
    exit();
}
