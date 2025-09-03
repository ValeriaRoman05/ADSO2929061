-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2025 a las 05:22:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_cliente` (IN `p_nombre` VARCHAR(100), IN `p_email` VARCHAR(100))   BEGIN
INSERT INTO clientes (nombre, email) 
VALUES (p_nombre,p_email);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `agregar_producto` (IN `p_nombre` VARCHAR(100), IN `p_precio` DECIMAL(10,2), IN `p_stock` INT)   BEGIN
INSERT INTO productos (nombre, precio, stock) 
values (p_nombre, p_precio, p_stock);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `aumentar_precio` (IN `porcentaje` DECIMAL(5,2))   BEGIN
    	UPDATE productos
        SET precio=precio*(1 + porcentaje / 100);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clientes_compras_mayores` (IN `monto` DECIMAL(10,2))   BEGIN
    	SELECT c.id_cliente, c.nombre, sum(p.precio*v.cantidad) as total_compras
        FROM ventas v
       	join clientes c on v.id_cliente = c.id_cliente
        JOIN productos p on v.id_producto = p.id_producto
        group by c.id_cliente, c.nombre
        HAVING total_compras > monto;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_ventas_antes_fecha` (IN `fecha_limite` DATE)   BEGIN
    	delete from ventas where fecha < fecha_limite;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productos_mas_caros` ()   BEGIN
    	select * from productos ORDER by precio desc LIMIT 5;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `productos_stock_bajo` ()   BEGIN
    	Select * from productos where stock<5;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `producto_mas_vendido` ()   BEGIN
    SELECT p.id_producto, p.nombre, SUM(v.cantidad) AS total_vendido
    FROM ventas v
    JOIN productos p ON v.id_producto = p.id_producto
    GROUP BY p.id_producto, p.nombre
    ORDER BY total_vendido DESC
    LIMIT 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_devolucion` (IN `p_id_venta` INT, IN `p_motivo_devolucion` VARCHAR(255))   BEGIN
    -- Declaración de variables para almacenar el ID del producto y la cantidad vendida
    DECLARE v_id_producto INT;
    DECLARE v_cantidad_vendida INT;

    -- Manejador de errores para revertir la transacción si ocurre una excepción SQL
    -- Esto asegura que, si algo falla, la base de datos no quede en un estado inconsistente.
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK; -- Deshace todas las operaciones de la transacción
        SIGNAL SQLSTATE '45000' -- Lanza una señal de error personalizada
        SET MESSAGE_TEXT = 'Error al procesar la devolución. La transacción ha sido revertida.';
    END;

    -- Inicia la transacción para asegurar que todas las operaciones se completen exitosamente o ninguna lo haga
    START TRANSACTION;

    -- 1. Obtener el id_producto y la cantidad de la venta original
    -- Esto es crucial porque la devolución se basa en una venta ya existente.
    SELECT id_producto, cantidad INTO v_id_producto, v_cantidad_vendida
    FROM ventas
    WHERE id_venta = p_id_venta;

    -- 2. Verificar si la venta existe antes de continuar
    IF v_id_producto IS NULL THEN
        -- Si no se encuentra la venta, se lanza un error y la transacción se revierte
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La venta especificada no existe en el sistema.';
    ELSE
        -- 3. Insertar el registro de la devolución en la tabla 'devoluciones'
        -- Se registra el ID de la venta, el motivo, la cantidad devuelta y la fecha actual.
        INSERT INTO devoluciones (id_venta, motivo)
        VALUES (p_id_venta, p_motivo_devolucion);

        -- 4. Actualizar el stock del producto
        -- La cantidad devuelta se suma de nuevo al stock del producto.
        UPDATE productos
        SET stock = stock + v_cantidad_vendida
        WHERE id_producto = v_id_producto;
        -- Si todas las operaciones anteriores fueron exitosas, se confirman los cambios en la base de datos
        COMMIT;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registrar_venta` (IN `p_id_cliente` INT, IN `p_id_producto` INT, IN `p_cantidad` INT)   BEGIN
    DECLARE v_stock INT;
    -- Obtener el stock actual del producto
    SELECT stock INTO v_stock
    FROM productos
    WHERE id_producto = p_id_producto;
    -- Verificar si hay suficiente stock
    IF v_stock >= p_cantidad THEN
        -- Registrar la venta
        INSERT INTO ventas (id_cliente, id_producto, cantidad)
        VALUES (p_id_cliente, p_id_producto, p_cantidad);
        -- Actualizar el stock del producto
        UPDATE productos
        SET stock = stock - p_cantidad
        WHERE id_producto = p_id_producto;
    ELSE
        -- Lanzar mensaje de advertencia
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Stock insuficiente para realizar la venta';
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_ventas_producto` (IN `p_id_producto` INT)   BEGIN
    	SELECT SUM(v.cantidad * p.precio) as total_ventas
        FROM ventas v 
        join productos p on v.id_producto = p.id_producto
        WHERE v.id_producto = p_id_producto;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `email`) VALUES
(1, 'Juan Pérez', 'juan.perez@email.com'),
(2, 'María Gómez Vale', 'maria.gomez@email.com'),
(4, 'Ana Martínez', 'ana.martinez@email.com'),
(6, 'Carlos Andica', 'andica001@gmail.com'),
(7, 'Sara la mocha', 'saralamocha123@gmail.com'),
(8, 'Nicol Puerta Puerta', 'npalcuadrado@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id_devolucion` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `fecha_devolucion` timestamp NOT NULL DEFAULT current_timestamp(),
  `motivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`id_devolucion`, `id_venta`, `fecha_devolucion`, `motivo`) VALUES
(1, 3, '2025-08-25 01:19:13', 'Defectuosos'),
(2, 1, '2025-08-25 01:21:06', 'porque quiso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `stock`) VALUES
(1, 'Laptop', 1320.55, 26),
(2, 'mouse', 28.59, 50),
(3, 'teclado', 50.33, 30),
(4, 'monitor', 275.00, 14),
(5, 'impresora', 165.00, 20),
(8, 'plancha para calvos', 87500.00, 20),
(11, 'impresora 3D', 3500000.00, 10),
(14, 'mousepad', 30000.00, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `perfil` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contrasena`, `perfil`) VALUES
(3, 'Carlos Andica', 'andica001@gmail.com', '$2y$10$xpIoM8V5PEaVqxaxD7a1a.rCTKV0drhZz1wHReqkg4Cxw1ANOyJkS', 'admin'),
(6, 'usuario2', 'usuario2@gmail.com', '$2y$10$gcfs.IsRYBaPgViSUNesxO0KNV9RlKuXwe3B6HfWgSMvtNJNumx4.', 'usuario'),
(7, 'usuario3', 'usuario3@gmail.com', '$2y$10$v1Ls/PRklXRDf7dvwcEigOA1yX3aCY/ocNeJJS4Lnhi9hWmhpV7ou', 'usuario'),
(8, 'usuario4', 'usuario4@gmail.com', '$2y$10$ipkeL97/sGjWyNnA7x7uVuOGj/lnV1WkfR0KWerCsdU2yqdaqnfHO', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_cliente`, `id_producto`, `cantidad`, `fecha`) VALUES
(1, 4, 1, 8, '2025-08-02 14:12:43'),
(2, 1, 1, 8, '2025-08-02 14:15:40'),
(3, 1, 1, 8, '2025-08-02 14:17:17'),
(4, 2, 8, 80, '2025-08-09 14:04:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
