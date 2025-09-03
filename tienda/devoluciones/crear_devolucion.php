<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

include("../config/conexion.php");

// Obtiene el ID de la venta de la URL, si existe.
$id_venta = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$cantidad_venta = null;

// Si se ha proporcionado un ID de venta, obtén su cantidad restante.
if ($id_venta) {
    try {
        $sql_cantidad = "CALL tienda.GetCantidadRestanteDeVenta(?)";
        $stmt_cantidad = $conn->prepare($sql_cantidad);
        $stmt_cantidad->bind_param("i", $id_venta);
        $stmt_cantidad->execute();
        $result_cantidad = $stmt_cantidad->get_result();

        if ($result_cantidad->num_rows > 0) {
            $cantidad_venta = $result_cantidad->fetch_assoc()['cantidad_restante'];
        }
    } catch (Exception $e) {
        die("Error al obtener la cantidad restante: " . $e->getMessage());
    } finally {
        if (isset($stmt_cantidad)) {
            $stmt_cantidad->close();
        }
        if (isset($result_cantidad)) {
            $result_cantidad->free();
        }
    }
    // Llama a mysqli_next_result() para limpiar el búfer de resultados de la conexión.
    $conn->next_result();
}

// Obtiene el ID del usuario de la sesión para pasarlo al procedimiento
$usuario_id = $_SESSION['usuario_id'];

// Consulta para obtener las ventas con productos disponibles para devolución
try {
    $sql_ventas = "CALL tienda.GetDatosVentaParaDevolucion(?)";
    $stmt_ventas = $conn->prepare($sql_ventas);
    $stmt_ventas->bind_param("i", $usuario_id);
    $stmt_ventas->execute();
    $ventas_query = $stmt_ventas->get_result();
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registrar Devolucion</title>
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
        .contenedor-formulario {
            background-color: #fff;
            padding: 2.5em;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        /* Estilos para los títulos principales */
        h2 {
            color: #8b0000;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            text-align: center;
            margin-bottom: 1.5em;
        }

        /* Estilos para el formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 1.8em;
        }

        /* Estilos para los campos de formulario */
        .grupo-formulario {
            display: flex;
            flex-direction: column;
        }

        .grupo-formulario label {
            margin-bottom: 0.6em;
            font-weight: 600;
            color: #5d0000;
        }

        .grupo-formulario input,
        .grupo-formulario select,
        .grupo-formulario textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8a0a0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .grupo-formulario input:focus,
        .grupo-formulario select:focus,
        .grupo-formulario textarea:focus {
            border-color: #8b0000;
            outline: none;
            box-shadow: 0 0 5px rgba(139, 0, 0, 0.3);
        }

        /* Estilos para el botón */
        button {
            background-color: #c0392b;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            margin-top: 1em;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #a5281a;
        }

        /* Estilos para los enlaces */
        .enlace {
            display: block;
            margin-top: 25px;
            text-decoration: none;
            color: #8b0000;
            font-weight: bold;
            font-size: 1.1em;
            text-align: center;
            transition: color 0.3s ease;
        }

        .enlace:hover {
            color: #5d0000;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="contenedor-formulario">
        <h2>Registrar Devolución</h2>
        <form action="procesar_devolucion.php" method="post">
            <input type="hidden" name="tipo" value="devolucion">

            <div class="grupo-formulario">
                <label for="id_venta">Venta:</label>
                <select id="id_venta" name="id_venta" required>
                    <option value="">Selecciona una venta</option>
                    <?php
                    // Bucle para llenar la lista desplegable con las ventas del usuario
                    if ($ventas_query && $ventas_query->num_rows > 0) {
                        while ($venta = $ventas_query->fetch_assoc()) {
                            $cantidad_restante = $venta['cantidad'] - $venta['cantidad_devuelta'];
                            $descripcion_venta = "#{$venta['id_venta']} - {$venta['nombre_producto']} a {$venta['nombre_cliente']} ({$cantidad_restante} unidades)";
                    ?>
                            <option value="<?php echo htmlspecialchars($venta['id_venta']); ?>" <?php echo ($venta['id_venta'] == $id_venta) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($descripcion_venta); ?>
                            </option>
                    <?php 
                        }
                    } else {
                        // Muestra una opción si no hay ventas para devolver
                        echo "<option disabled>No hay ventas disponibles para devolución</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="cantidad_devolver">Cantidad a Devolver:</label>
                <input type="number" id="cantidad_devolver" name="cantidad_devolver" required min="1" <?php echo ($cantidad_venta) ? 'max="' . htmlspecialchars($cantidad_venta) . '" value="' . htmlspecialchars($cantidad_venta) . '"' : ''; ?>>
            </div>

            <div class="grupo-formulario">
                <label for="motivo">Motivo de la devolución:</label>
                <textarea id="motivo" name="motivo" required></textarea>
            </div>

            <button type="submit">Registrar Devolución</button>
        </form>
    </div>

    <a href="listar_devoluciones.php" class="enlace">
        <h2>Ver Devoluciones</h2>
    </a>
    <a href="../ventas/listar_ventas.php" class="enlace">
        <h2>Ventas</h2>
    </a>
</body>

</html>
<?php
// Cierra los statements y la conexión
if (isset($stmt_ventas)) {
    $stmt_ventas->close();
}
$conn->close();
?>