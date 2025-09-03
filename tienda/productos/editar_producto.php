<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

include("../config/conexion.php");

// Validate and sanitize the input ID
$id_producto = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Use a prepared statement to call the stored procedure
try {
    $stmt = $conn->prepare("CALL GetProductoPorId(?)");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "Producto no encontrado.";
        header("Location: listar_productos.php");
        exit();
    }
} catch (Exception $e) {
    $_SESSION['error'] = "Error al obtener el producto: " . $e->getMessage();
    header("Location: listar_productos.php");
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
    <title>Editar Producto</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #faf5f5ff;
            color: #4a1c1c;
            line-height: 1.6;
            margin: 2em;
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

        /* Estilos para el título */
        h2 {
            color: #8b0000;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            text-align: center;
            margin-bottom: 1.5em;
        }

        /* Estilos para los campos de formulario */
        .grupo-formulario {
            margin-bottom: 1.8em;
        }

        .grupo-formulario label {
            display: block;
            margin-bottom: 0.6em;
            font-weight: 600;
            color: #5d0000;
        }

        .grupo-formulario input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8a0a0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        
        .grupo-formulario input:focus {
            border-color: #8b0000;
            outline: none;
            box-shadow: 0 0 5px rgba(139, 0, 0, 0.3);
        }

        /* Estilos para el botón */
        button {
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

        button:hover {
            background-color: #a5281a;
        }
        
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
    <div class="contenedor-formulario">
        <h2>Editar Producto</h2>
        <form action="actualizar_producto.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
            
            <div class="grupo-formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
            </div>
            
            <div class="grupo-formulario">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" step="0.01" name="precio" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
            </div>
            
            <div class="grupo-formulario">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
            </div>
            
            <button type="submit">Actualizar Producto</button>
        </form>
    </div>
    <a href="listar_productos.php" class="boton-volver">Cancelar</a>
</body>
</html>