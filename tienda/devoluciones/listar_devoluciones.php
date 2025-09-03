<?php
include '../config/conexion.php';

session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// Llama al procedimiento almacenado para obtener la lista de devoluciones
try {
    $sql = "CALL GetListaDevoluciones()";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
} catch (Exception $e) {
    $_SESSION['error'] = "Error al cargar la lista de devoluciones: " . $e->getMessage();
    header("Location: ../tablero.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Devoluciones</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0eaeaff;
            color: #4a1c1c;
            line-height: 1.6;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2em;
        }

        /* Estilos para el título principal */
        h2 {
            color: #8b0000;
            text-align: center;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            margin-bottom: 1.5em;
        }

        /* Estilo para el botón de "Crear Devolucion" */
        .boton-crear {
            display: inline-block;
            background-color: #c0392b;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin-bottom: 2em;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .boton-crear:hover {
            background-color: #a5281a;
        }

        /* Estilos para la tabla */
        table {
            width: 100%;
            max-width: 1200px;
            border-collapse: collapse;
            margin: 2em 0;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Estilos para las celdas del encabezado (<th>) */
        th {
            background-color: #8b0000;
            color: white;
            padding: 15px 20px;
            text-align: left;
        }

        /* Estilos para las celdas del cuerpo de la tabla (<td>) */
        td {
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        /* Estilos para filas pares, para mejorar la legibilidad */
        tr:nth-child(even) {
            background-color: #f8f0f0;
        }

        /* Efecto al pasar el cursor sobre las filas */
        tr:hover {
            background-color: #ffeaea;
        }
        
        /* Estilos para el mensaje de sesión */
        .mensaje {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }

        .mensaje.exito {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .mensaje.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Estilo para el botón de "Volver" */
        .boton-volver {
            display: inline-block;
            margin-top: 25px;
            color: #8b0000;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1em;
            transition: color 0.3s ease;
        }

        .boton-volver:hover {
            color: #5d0000;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION['mensaje'])) : ?>
        <div class="mensaje exito">
            <?php
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
            ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])) : ?>
        <div class="mensaje error">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <h2>Lista de Devoluciones</h2>
    

    <a href="crear_devolucion.php" class="boton-crear">Realizar Nueva Devolución</a>

    <table>
        <thead>
            <tr>
                <th>ID Devolución</th>
                <th>ID Venta</th>
                <th>Fecha Venta</th>
                <th>Producto Devuelto</th>
                <th>Cantidad Devuelta</th>
                <th>Precio Unitario</th>
                <th>Total Devolución</th>
                <th>Cliente</th>
                <th>Fecha Devolución</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_devolucion']); ?></td>
                    <td><?php echo htmlspecialchars($row['id_venta']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombreProducto']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad_devuelta']); ?></td>
                    <td>$<?php echo number_format($row['precio'], 2); ?></td>
                    <td>$<?php echo number_format($row['total_devolucion'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['nombreCliente']); ?></td>
                    <td><?php echo htmlspecialchars($row['fecha_devolucion']); ?></td>
                    <td><?php echo htmlspecialchars($row['motivo']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="../tablero.php" class="boton-volver">Volver a la página principal</a>
</body>

</html>
<?php 
// Close the statement and connection
$stmt->close();
$conn->close();
?>