<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

include("../config/conexion.php");

// 1. Get the sale ID from the URL and validate it
if (!isset($_GET['id'])) {
    die("ID de venta no especificado.");
}
$id_venta = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// 2. Call the stored procedure to get the specific sale's data
try {
    $sql_venta = "CALL GetVentaPorId(?)";
    $stmt_venta = $conn->prepare($sql_venta);
    $stmt_venta->bind_param("i", $id_venta);
    $stmt_venta->execute();
    $result_venta = $stmt_venta->get_result();

    if ($result_venta->num_rows === 0) {
        $_SESSION['error'] = "Venta no encontrada.";
        header("Location: listar_ventas.php");
        exit();
    }
    $venta = $result_venta->fetch_assoc();
} catch (Exception $e) {
    die("Error al obtener la venta: " . $e->getMessage());
} finally {
    if (isset($stmt_venta)) {
        $stmt_venta->close();
    }
    // mysqli_next_result is required to call another procedure on the same connection
    $conn->next_result();
}

// 3. Call the stored procedure to get all clients
try {
    $sql_clientes = "CALL GetClientesOrdenados()";
    $stmt_clientes = $conn->prepare($sql_clientes);
    $stmt_clientes->execute();
    $clientes = $stmt_clientes->get_result();
} catch (Exception $e) {
    die("Error al obtener clientes: " . $e->getMessage());
} finally {
    // mysqli_next_result is required to call another procedure
    $conn->next_result();
}

// 4. Call the stored procedure to get all products
try {
    $sql_productos = "CALL GetProductosOrdenados()";
    $stmt_productos = $conn->prepare($sql_productos);
    $stmt_productos->execute();
    $productos = $stmt_productos->get_result();
} catch (Exception $e) {
    die("Error al obtener productos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Editar Venta</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 2em;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* Estilos para el contenedor del formulario */
        .contenedor-formulario {
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        /* Estilos para los títulos principales */
        h2 {
            color: #0056b3;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 0.5em;
            text-align: center;
        }

        /* Estilos para el formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 1.5em;
        }

        /* Estilos para los campos de formulario */
        .grupo-formulario {
            display: flex;
            flex-direction: column;
        }

        .grupo-formulario label {
            margin-bottom: 0.5em;
            font-weight: bold;
        }

        .grupo-formulario input,
        .grupo-formulario select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        /* Estilos para el botón */
        button {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 1em;
        }

        button:hover {
            background-color: #218838;
        }

        /* Estilos para los enlaces */
        .enlace {
            display: block;
            margin-top: 2em;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            text-align: center;
        }

        .enlace:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="contenedor-formulario">
        <h2>Editar Venta</h2>
        <form action="actualizar_venta.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($venta['id_venta']); ?>">

            <div class="grupo-formulario">
                <label for="id_cliente">Cliente:</label>
                <select id="id_cliente" name="id_cliente" required>
                    <?php while ($cliente = $clientes->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>"
                            <?php echo ($venta['id_cliente'] == $cliente['id_cliente']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cliente['nombre']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="id_producto">Producto:</label>
                <select id="id_producto" name="id_producto" required>
                    <?php while ($producto = $productos->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($producto['id_producto']); ?>"
                            <?php echo ($venta['id_producto'] == $producto['id_producto']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($producto['nombre']); ?> - $<?php echo number_format($producto['precio'], 2); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" value="<?php echo htmlspecialchars($venta['cantidad']); ?>" required min="1">
            </div>

            <button type="submit">Actualizar Venta</button>
        </form>
    </div>

    <a href="listar_ventas.php" class="enlace">
        <h2>Volver a Ventas</h2>
    </a>
</body>
</html>
<?php
// Close statements and connection
if (isset($stmt_clientes)) {
    $stmt_clientes->close();
}
if (isset($stmt_productos)) {
    $stmt_productos->close();
}
$conn->close();
?>