<?php
include 'conexion.php';

session_start();

// Si no hay una sesión activa, redirige al login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST["tipo"];
    
    try {
        if ($tipo == "producto") {
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];
            
            $stmt = $conn->prepare("CALL agregar_producto(?, ?, ?)");
            $stmt->bind_param("sdi", $nombre, $precio, $stock);
        } elseif ($tipo == "cliente") {
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            
            $stmt = $conn->prepare("CALL agregar_cliente(?, ?)");
            $stmt->bind_param("ss", $nombre, $email);
        } elseif ($tipo == "venta") {
            $id_cliente = $_POST["id_cliente"];
            $id_producto = $_POST["id_producto"];
            $cantidad = $_POST["cantidad"];
            
            $stmt = $conn->prepare("CALL registrar_venta(?, ?, ?)");
            $stmt->bind_param("iii", $id_cliente, $id_producto, $cantidad);
        }
        
        if ($stmt->execute()) {
            if ($tipo == "producto") {
                $_SESSION['mensaje'] = "Producto agregado correctamente";
                header("Location: ../productos/listar_Productos.php");
            } elseif ($tipo == "cliente") {
                $_SESSION['mensaje'] = "Cliente agregado correctamente";
                header("Location: ../clientes/listar_clientes.php");
            } elseif ($tipo == "venta") {
                $_SESSION['mensaje'] = "Venta agregada correctamente";
                header("Location: ../ventas/listar_Ventas.php");
            } 
            exit();
        } else {
            throw new Exception($stmt->error);
        }
        
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        
        if (strpos($error_message, 'No hay suficiente stock') !== false) {
            $_SESSION['error'] = "No es posible realizar la venta. La cantidad solicitada excede el stock disponible. 😞";
        } else {
            if ($tipo == "producto") {
                $_SESSION['error'] = "Error al agregar el producto: " . $error_message;
                header("Location: ../productos/listar_Productos.php");
            } elseif ($tipo == "cliente") {
                $_SESSION['error'] = "Error al agregar el cliente: " . $error_message;
                header("Location: ../clientes/listar_clientes.php");
            } elseif ($tipo == "venta") {
                $_SESSION['error'] = "Error al agregar la venta: " . $error_message;
                header("Location: ../ventas/listar_Ventas.php");
            }
        }
        exit();
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
}
?>