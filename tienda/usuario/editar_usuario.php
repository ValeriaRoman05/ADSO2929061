<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

include("../config/conexion.php");

// Sanitiza el ID del usuario recibido por la URL
$id_usuario = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$id_usuario) {
    $_SESSION['error'] = "ID de usuario no especificado.";
    header("location: listar_usuarios.php");
    exit();
}

// Preparar y ejecutar la llamada al procedimiento almacenado
$usuario = null;
try {
    $stmt = $conn->prepare("CALL GetUsuarioPorId(?)");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "Usuario no encontrado.";
        header("location: listar_usuarios.php");
        exit();
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Error al obtener el usuario: " . $e->getMessage();
    header("location: listar_usuarios.php");
    exit();
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
        .opcion-enlace {
            margin-top: 2em;
            font-size: 14px;
        }

        .opcion-enlace a {
            color: #8b0000;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .opcion-enlace a:hover {
            color: #5d0000;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <h2>Editar usuario</h2>
        <form action="actualizar_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id_usuario']); ?>">
            <div class="grupo-formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
            <div class="grupo-formulario">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
            </div>
            <div class="grupo-formulario">
                <label for="perfil">Perfil:</label>
                <select name="perfil" id="perfil">
                    <option value="admin" <?php echo ($usuario['perfil'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="usuario" <?php echo ($usuario['perfil'] == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                </select>
            </div>
            <button type="submit">Actualizar Usuario</button>
        </form>
        <div class="opcion-enlace">
            <a href="listar_usuarios.php">Volver a la lista de usuarios</a>
        </div>
    </div>
</body>

</html>