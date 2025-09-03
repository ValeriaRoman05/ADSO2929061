<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
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
        .form-container {
            background-color: #fff;
            padding: 2.5em;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        /* Estilos para el título principal */
        h2 {
            color: #8b0000;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            text-align: center;
            margin-bottom: 1.5em;
        }

        /* Estilos para las etiquetas e inputs */
        form label {
            display: block;
            margin-bottom: 0.6em;
            font-weight: 600;
            color: #5d0000;
        }

        form input[type="text"],
        form input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 1.8em;
            border: 1px solid #d8a0a0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus {
            border-color: #8b0000;
            outline: none;
            box-shadow: 0 0 5px rgba(139, 0, 0, 0.3);
        }

        /* Estilos para el botón de enviar */
        button[type="submit"] {
            width: 100%;
            background-color: #c0392b;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button[type="submit"]:hover {
            background-color: #a5281a;
        }

        /* Estilos para el enlace de "Ver Clientes" */
        .link-clientes {
            display: inline-block;
            margin-top: 25px;
            color: #8b0000;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1em;
            transition: color 0.3s ease;
        }
        
        .link-clientes:hover {
            color: #5d0000;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Agregar Cliente</h2>
        <form action="../config/insertar.php" method="post">
            <input type="hidden" name="tipo" value="cliente">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <button type="submit">Agregar Cliente</button>
        </form>
    </div>
    <a href="listar_clientes.php" class="link-clientes">Ver Clientes</a>
</body>
</html>