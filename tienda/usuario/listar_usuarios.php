<?php
include '../config/conexion.php';

session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

$result = $conn->query("SELECT id_usuario,
                               nombre,
                               correo,
                               perfil
                            FROM usuarios");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Usuarios</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcebeb;
            color: #4a1c1c;
            line-height: 1.6;
            margin: 0;
            padding: 2em;
        }

        /* Estilos para el contenedor principal de la tabla y botones */
        .contenedor {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2.5em;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        /* Estilos para el título principal */
        h2 {
            color: #8b0000;
            text-align: center;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            margin-bottom: 1.5em;
        }

        /* Estilo para el botón de "Nuevo usuario" */
        .boton-crear {
            display: inline-block;
            background-color: #c0392b;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 25px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .boton-crear:hover {
            background-color: #a5281a;
            transform: translateY(-2px);
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 2em 0;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Estilos para las celdas del encabezado (<th>) */
        th {
            background-color: #8b0000;
            color: white;
            padding: 15px;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9em;
        }

        /* Estilos para las celdas del cuerpo de la tabla (<td>) */
        td {
            padding: 15px;
            border-bottom: 1px solid #f2d9d9;
        }

        /* Estilos para filas pares, para mejorar la legibilidad */
        tr:nth-child(even) {
            background-color: #fff5f5;
        }

        /* Efecto al pasar el cursor sobre las filas */
        tr:hover {
            background-color: #f7e1e1;
        }

        /* Contenedor para los botones de acción en la tabla */
        .acciones-botones {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Estilos base para los enlaces de acción */
        td .acciones-botones a {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        /* Estilo específico para el botón de Editar */
        .boton-editar {
            color: #c0392b;
            border: 2px solid #c0392b;
        }

        .boton-editar:hover {
            background-color: #c0392b;
            color: white;
        }

        /* Estilo específico para el botón de Eliminar */
        .boton-eliminar {
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        .boton-eliminar:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Estilo para el botón de "Volver" */
        .boton-volver {
            display: inline-block;
            margin-top: 30px;
            color: #8b0000;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .boton-volver:hover {
            color: #5d0000;
            text-decoration: underline;
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
    <div class="contenedor">
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
        <h2>Lista de Usuarios</h2>
        <a href="crear_usuariox.php" class="boton-crear">Nuevo usuario</a>
        <table>
            <thead>
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php echo isset($row['id_usuario']) ? htmlspecialchars($row['id_usuario']) : 'N/A'; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['correo']); ?></td>
                        <td><?php echo htmlspecialchars($row['perfil']); ?></td>
                        <td>
                            <div class="acciones-botones">
                                <a href='editar_usuario.php?id=<?php echo htmlspecialchars($row['id_usuario']); ?>' class="boton-editar">Editar</a>
                                <a href='eliminar_usuario.php?id=<?php echo htmlspecialchars($row['id_usuario']); ?>' class="boton-eliminar" onclick='return confirm("¿Estás seguro de eliminar este usuario?")'>Eliminar</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="../index.php" class="boton-volver">Volver a la página principal</a>
</body>

</html>
<?php $conn->close(); ?>