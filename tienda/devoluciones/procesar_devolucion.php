<?php
session_start();
include("../config/conexion.php");

// Comprueba que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}

// 1. Validate and get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_venta = filter_input(INPUT_POST, 'id_venta', FILTER_SANITIZE_NUMBER_INT);
    $cantidad_devolver = filter_input(INPUT_POST, 'cantidad_devolver', FILTER_SANITIZE_NUMBER_INT);
    $motivo = $_POST['motivo'] ?? null;

    if (!$id_venta || !$cantidad_devolver || !$motivo) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: crear_devolucion.php?id=" . $id_venta);
        exit();
    }
    
    // 2. Get original quantity and already returned quantity by calling the stored procedure
    $datos_venta = null;
    try {
        $stmt_cantidad = $conn->prepare("CALL GetDatosVentaParaDevolucion(?)");
        $stmt_cantidad->bind_param("i", $id_venta);
        $stmt_cantidad->execute();
        $result_cantidad = $stmt_cantidad->get_result();
        $datos_venta = $result_cantidad->fetch_assoc();
        $stmt_cantidad->close();
        // Need to call this to prepare for the next query
        $conn->next_result();
    } catch (Exception $e) {
        $_SESSION['error'] = "Error al obtener datos de la venta: " . $e->getMessage();
        header("Location: crear_devolucion.php?id=" . $id_venta);
        exit();
    }

    if (!$datos_venta) {
        $_SESSION['error'] = "Error: Venta no encontrada.";
        header("Location: listar_devoluciones.php");
        exit();
    }
    
    $cantidad_restante = $datos_venta['cantidad_original'] - $datos_venta['cantidad_devuelta'];

    // 3. Validate that the quantity to be returned is not greater than the remaining quantity
    if ($cantidad_devolver > $cantidad_restante) {
        $_SESSION['error'] = "Error: No se puede devolver una cantidad mayor a la cantidad restante. Cantidad disponible para devolver: " . $cantidad_restante;
        header("Location: crear_devolucion.php?id=" . $id_venta);
        exit();
    }
    
    // Use a transaction for atomicity
    $conn->begin_transaction();

    try {
        // 4. Insert the return record by calling the stored procedure
        $stmt_devolucion = $conn->prepare("CALL InsertarDevolucion(?, ?, ?)");
        $stmt_devolucion->bind_param("isi", $id_venta, $motivo, $cantidad_devolver);
        $stmt_devolucion->execute();
        $stmt_devolucion->close();
        $conn->next_result();
        
        // 5. Update the product stock by calling the stored procedure
        $stmt_stock = $conn->prepare("CALL ActualizarStockPorDevolucion(?, ?)");
        $stmt_stock->bind_param("ii", $id_venta, $cantidad_devolver);
        $stmt_stock->execute();
        $stmt_stock->close();
        $conn->next_result();

        // If all queries were successful, commit the transaction
        $conn->commit();
        $_SESSION['mensaje'] = "Devolución registrada y stock actualizado correctamente.";
    } catch (Exception $e) {
        // If there's an error, roll back the transaction
        $conn->rollback();
        $_SESSION['error'] = "Error al procesar la devolución: " . $e->getMessage();
    }

    $conn->close();

    // Redirect to the returns page
    header("Location: listar_devoluciones.php");
    exit();
} else {
    // If the request is not POST, redirect to the form
    header("Location: crear_devolucion.php");
    exit();
}
?>