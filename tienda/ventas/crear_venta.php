<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

include("../config/conexion.php");

// Consulta para obtener los clientes
$clientes = $conn->query("SELECT id_cliente, nombre FROM clientes ORDER BY nombre ASC");

// Consulta para obtener los productos
$productos = $conn->query("SELECT id_producto, nombre, precio FROM productos ORDER BY nombre ASC");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Registrar Venta</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f4f4ff;
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

        /* Estilos para el enlace de "Ver Ventas realizadas" */
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
        <h2>Registrar Venta</h2>
        <form action="../config/insertar.php" method="post">
            <input type="hidden" name="tipo" value="venta">

            <div class="grupo-formulario">
                <label for="id_cliente">Cliente:</label>
                <select id="id_cliente" name="id_cliente" required>
                    <option value="">Selecciona un cliente</option>
                    <?php while ($cliente = $clientes->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">
                            <?php echo htmlspecialchars($cliente['nombre']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="id_producto">Producto:</label>
                <select id="id_producto" name="id_producto" required>
                    <option value="">Selecciona un producto</option>
                    <?php while ($producto = $productos->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
                            <?php echo htmlspecialchars($producto['nombre']); ?> - $<?php echo number_format($producto['precio'], 2); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="grupo-formulario">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required min="1">
            </div>

            <button type="submit">Registrar Venta</button>
        </form>
    </div>

    <a href="listar_ventas.php" class="enlace">
        <h2>Ver Ventas realizadas</h2>
    </a>
</body>

</html>