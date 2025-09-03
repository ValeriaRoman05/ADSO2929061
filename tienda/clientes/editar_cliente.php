<?php
session_start();

// Redirect to login if no active session
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

include("../config/conexion.php");

// Validate and sanitize the ID
$id_cliente = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Check if a valid ID was provided
if (!$id_cliente) {
    echo "ID de cliente no válido.";
    exit;
}

// Call the stored procedure to get the client's data
try {
    $sql = "CALL GetClientePorId(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cliente);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
    } else {
        echo "Cliente no encontrado.";
        exit;
    }
} catch (Exception $e) {
    echo "Error al cargar los datos del cliente: " . $e->getMessage();
    exit;
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <style>
        /* Estilos generales para el cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f2f2ff;
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
        <h2>Editar Cliente</h2>
        <form action="actualizar_cliente.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">
            
            <div class="grupo-formulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
            </div>
            
            <div class="grupo-formulario">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
            </div>
            
            <button type="submit">Actualizar Cliente</button>
        </form>
    </div>
    <a href="listar_clientes.php" class="boton-volver">Cancelar</a>
</body>
</html>
<?php $conn->close(); ?>