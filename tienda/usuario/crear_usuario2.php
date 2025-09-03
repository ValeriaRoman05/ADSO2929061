<?php
session_start();

include '../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
    $perfil = $_POST["perfil"];

    try {
        // Prepare the call to the stored procedure
        $stmt = $conn->prepare("CALL InsertarUsuario(?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $contrasena, $perfil);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = 'El usuario se ha creado exitosamente';
            header("location: listar_usuarios.php");
            exit();
        } else {
            $_SESSION['error'] = "Error al registrar el usuario: " . $stmt->error;
            header("location: listar_usuarios.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error inesperado al registrar el usuario: " . $e->getMessage();
        header("location: listar_usuarios.php");
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    $_SESSION['error'] = "No se han recibido datos correctamente.";
    header("location: listar_usuarios.php");
    exit();
}
?>