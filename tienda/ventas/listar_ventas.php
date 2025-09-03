<?php
// Incluye el archivo de conexión a la base de datos
include '../config/conexion.php';

// Inicia la sesión
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Consulta para obtener las ventas con información detallada y la cantidad restante
$sql = "SELECT v.id_venta,
               v.fecha,
               v.cantidad AS cantidad_original,
               COALESCE(SUM(d.cantidad_devolver), 0) AS cantidad_devuelta,
               p.nombre AS nombreProducto,
               p.precio,
               (v.cantidad * p.precio) AS total_original,
               c.nombre AS nombreCliente,
               c.id_cliente
        FROM ventas v
        JOIN productos p ON v.id_producto = p.id_producto
        JOIN clientes c ON v.id_cliente = c.id_cliente
        LEFT JOIN devoluciones d ON v.id_venta = d.id_venta
        GROUP BY v.id_venta
        ORDER BY v.fecha DESC";

// Ejecuta la consulta y verifica si hay errores
$result = $conn->query($sql);

if (!$result) {
    // Si la consulta falla, muestra un mensaje de error y detiene la ejecución
    $_SESSION['error'] = "Error en la consulta de ventas: " . $conn->error;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ventas</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcf8f8ff;
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

        /* Estilo para el botón de "Realizar Nueva Venta" */
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

        /* Estilo específico para el botón de Devolver */
        .boton-devolver {
            color: #d62d20;
            border: 2px solid #d62d20;
        }

        .boton-devolver:hover {
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
    <h2>Lista de Ventas</h2>

    <a href="crear_venta.php" class="boton-crear">Realizar Nueva Venta</a>

    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Producto Vendido</th>
                <th>Cantidad Restante</th>
                <th>Precio</th>
                <th>Total Venta</th>
                <th>Comprador</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Solo intenta recorrer el resultado si la consulta fue exitosa
            if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $cantidad_restante = $row['cantidad_original'] - $row['cantidad_devuelta'];
                    $estado = ($cantidad_restante <= 0) ? 'DEVUELTA' : 'ACTIVA';
                    $total_actual = $cantidad_restante * $row['precio'];
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id_venta']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombreProducto']); ?></td>
                        <td><?php echo htmlspecialchars($cantidad_restante); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($row['precio'], 2)); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($total_actual, 2)); ?></td>
                        <td><?php echo htmlspecialchars($row['nombreCliente']); ?></td>
                        <td><?php echo htmlspecialchars($estado); ?></td>
                        <td>
                            <div class="acciones-botones">
                                <a href='editar_venta.php?id=<?php echo $row['id_venta']; ?>' class="boton-editar">Editar</a>
                                <?php
                                // Muestra el botón de Devolver solo si la cantidad restante es mayor a 0
                                if ($cantidad_restante > 0) {
                                ?>
                                    <a href='../devoluciones/crear_devolucion.php?id=<?php echo $row['id_venta']; ?>' class="boton-devolver">Devolver</a>
                                <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='9'>No se encontraron ventas.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="../tablero.php" class="boton-volver">Volver a la página principal</a>
</body>

</html>
<?php
// Cierra la conexión a la base de datos al final del script
if (isset($conn)) {
    $conn->close();
}
?>