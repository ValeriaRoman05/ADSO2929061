<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Lógica para procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../config/conexion.php';

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);
    $perfil = $_POST["perfil"];

    try {
        // Prepara la llamada al procedimiento almacenado
        $stmt = $conn->prepare("CALL InsertarUsuario(?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $contrasena, $perfil);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = 'El usuario se ha creado exitosamente';
            header("Location: listar_usuarios.php"); // Redirige a la lista de usuarios
            exit();
        } else {
            $_SESSION['error'] = "Error al registrar el usuario: " . $stmt->error;
            header("Location: crear_usuario.php"); // En caso de error, redirige al mismo formulario
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error inesperado al registrar el usuario: " . $e->getMessage();
        header("Location: crear_usuario.php");
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcebeb;
            color: #4a1c1c;
            line-height: 1.6;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Estilos para el contenedor del formulario */
        .contenedor {
            background-color: #fff;
            padding: 2.5em;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        /* Estilos para el título principal */
        h2 {
            color: #8b0000;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            margin-bottom: 1.5em;
        }

        /* Estilos para los campos del formulario */
        .grupo-formulario {
            text-align: left;
            margin-bottom: 1.8em;
        }

        .grupo-formulario label {
            display: block;
            margin-bottom: 0.6em;
            font-weight: 600;
            color: #5d0000;
        }

        .grupo-formulario input,
        .grupo-formulario select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8a0a0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .grupo-formulario input:focus,
        .grupo-formulario select:focus {
            border-color: #8b0000;
            outline: none;
            box-shadow: 0 0 5px rgba(139, 0, 0, 0.3);
        }

        /* Estilos para el botón de enviar */
        button {
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #c0392b;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 1em;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #a5281a;
        }

        /* Estilos para el enlace de "Volver" */
        .boton-volver {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #c0392b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .boton-volver:hover {
            background-color: #a5281a;
            transform: translateY(-2px);
        }

        /* Estilos para los mensajes de éxito y error */
        .mensaje-exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin: 20px auto;
            border-radius: 8px;
            text-align: center;
            max-width: 600px;
        }

        .mensaje-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 15px;
            margin: 20px auto;
            border-radius: 8px;
            text-align: center;
            max-width: 600px;
        }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['mensaje'])) : ?>
        <div class="mensaje-exito">
            <?php
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
            ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="mensaje-error">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <div class="contenedor">
        <h2>Crear Usuario</h2>
        <form action="crear_usuario.php" method="POST">
            <div class="grupo-formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="grupo-formulario">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="grupo-formulario">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="grupo-formulario">
                <label for="perfil">Perfil:</label>
                <select name="perfil" id="perfil">
                    <option value="admin">Administrador</option>
                    <option value="usuario">Usuario</option>
                </select>
            </div>
            <button type="submit">Crear Cuenta</button>
        </form>
    </div>

    <a href="listar_usuarios.php" class="boton-volver">Volver a la lista</a>
</body>

</html>