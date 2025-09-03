<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

// Verifica si el usuario es administrador 
$es_admin = ($_SESSION['perfil'] === 'admin');
?>
?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f4f4ff;
            color: #4a1c1c;
            line-height: 1.6;
            margin: 2em;
            text-align: center;
        }

        h2 {
            color: #9b2226;
            border-bottom: 2px solid #9b2226;
            padding-bottom: 0.5em;
        }

        .boton-contenedor {
            display: inline-block;
            margin: 10px;
        }

        .boton {
            display: block;
            background-color: #bb3e03;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .boton:hover {
            background-color: #9b2226;
        }
    </style>
</head>

<body>
    <h2>¡Bienvenido, <?php echo $_SESSION['nombre']; ?>!</h2>
    <p>Esta es tu página de inicio. Elige una de las siguientes opciones:</p>

    <div class="boton-contenedor">
        <a href="productos/listar_productos.php" class="boton">Ver Productos</a>
    </div>

    <div class="boton-contenedor">
        <a href="clientes/listar_clientes.php" class="boton">Ver Clientes</a>
    </div>

    <div class="boton-contenedor">
        <a href="ventas/listar_ventas.php" class="boton">Ver Ventas</a>
    </div>

    <div class="boton-contenedor">
        <a href="devoluciones/listar_devoluciones.php" class="boton">Ver Devoluciones</a>
    </div>

    <?php if ($es_admin) : ?>
        <div class="boton-contenedor">
            <a href="usuario/listar_usuarios.php" class="boton">Usuarios</a>
        </div>
    <?php endif; ?>

    <br><br>
    <a href="config/logout.php">Cerrar Sesión</a>
</body>

</html>