<?php
include '../config/conexion.php';
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Llama al procedimiento almacenado para obtener todos los productos
try {
    $result = $conn->query("CALL GetAllProductos()");
    if (!$result) {
        throw new Exception("Error al ejecutar el procedimiento almacenado: " . $conn->error);
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: ../tablero.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Productos</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f7f7ff;
            color: #4a1c1c;
            line-height: 1.6;
            margin: 2em;
        }

        /* Estilos para el título principal */
        h2 {
            color: #8b0000;
            text-align: center;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            margin-bottom: 1.5em;
        }

        /* Estilo para el botón de "Crear Producto" */
        .boton-crear {
            display: inline-block;
            background-color: #c0392b;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 25px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .boton-crear:hover {
            background-color: #a5281a;
        }

        /* Estilos para la tabla */
        table {
            width: 90%;
            margin: 2em auto;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

        /* Estilos para los enlaces de acción (Editar y Eliminar) */
        td a {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            margin-right: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        /* Estilo específico para el botón de Editar */
        td a:first-of-type {
            color: #c0392b;
            border: 2px solid #c0392b;
        }

        td a:first-of-type:hover {
            background-color: #c0392b;
            color: white;
        }

        /* Estilo específico para el botón de Eliminar */
        td a:last-of-type {
            color: #d62d20;
            border: 2px solid #d62d20;
        }

        td a:last-of-type:hover {
            background-color: #d62d20;
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
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            padding: 15px;
            margin: 20px auto;
            border-radius: 8px;
            text-align: center;
            max-width: 600px;
        }

        .mensaje-error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
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

    <h2>Lista de Productos</h2>

    <a href="crear_producto.php" class="boton-crear">Crear Nuevo Producto</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php
                        echo isset($row['id_producto']) ? htmlspecialchars($row['id_producto']) : 'N/A';
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td>$<?php echo htmlspecialchars(number_format($row['precio'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($row['stock']); ?></td>
                    <td>
                        <a href='editar_producto.php?id=<?php echo htmlspecialchars($row['id_producto']); ?>'>Editar</a>
                        <a href='eliminar_producto.php?id=<?php echo htmlspecialchars($row['id_producto']); ?>' onclick='return confirm("¿Estás seguro de eliminar este producto?")'>Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../tablero.php" class="boton-volver">Volver al inicio</a>
</body>

</html>
<?php 
$result->free();
$conn->close(); 
?>