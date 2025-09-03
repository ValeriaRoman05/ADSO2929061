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

    // Recupera y sanitiza los datos del formulario
    $id_usuario = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['correo'];
    $perfil = $_POST['perfil'];

    try {
        // 1. Prepara la llamada al procedimiento almacenado
        $stmt = $conn->prepare("CALL UpdateUsuario(?, ?, ?, ?)");

        // 2. Vincula los parámetros a la llamada
        $stmt->bind_param("isss", $id_usuario, $nombre, $email, $perfil);

        // 3. Ejecuta la llamada
        if ($stmt->execute()) {
            // La actualización fue exitosa, redirige al usuario a la lista de usuarios
            $_SESSION['mensaje'] = 'El usuario se ha actualizado exitosamente';
            header("Location: listar_usuarios.php");
            exit();
        } else {
            // Si hay un error, muestra un mensaje
            $_SESSION['error'] = "Error al actualizar el usuario: " . $stmt->error;
            header("Location: listar_usuarios.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error inesperado al actualizar el usuario: " . $e->getMessage();
        header("Location: listar_usuarios.php");
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    // Si la solicitud no es POST, redirige al formulario o a la lista
    $_SESSION['error'] = "Acceso no válido o datos faltantes.";
    header("Location: listar_usuarios.php");
    exit();
}
?>