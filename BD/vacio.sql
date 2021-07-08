-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2020 a las 13:21:44
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vacio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `bitacora_id` int(11) NOT NULL,
  `bitacora_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_fecha` date NOT NULL,
  `bitacora_horaInicio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_horaFin` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_tipoUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `bitacora_ano` int(4) NOT NULL,
  `bitacora_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(10) NOT NULL,
  `cliente_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_dni` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_direccion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_correo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `compra_id` int(11) NOT NULL,
  `compra_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_tipoComprobante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_serie` varchar(7) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_numComprobante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_fecha` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `compra_impuesto` int(11) NOT NULL,
  `compra_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `compra_id_proveedor` int(11) NOT NULL,
  `compra_id_usuario` int(11) NOT NULL,
  `compra_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `comprobante_id` int(10) NOT NULL,
  `comprobante_nombre` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_letraSerie` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_serie` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_numero` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `comprobante_estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`comprobante_id`, `comprobante_nombre`, `comprobante_letraSerie`, `comprobante_serie`, `comprobante_numero`, `comprobante_estado`) VALUES
(1, 'Boleta', 'B', '01', '00000', 1),
(2, 'Factura', 'F', '01', '00000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `detalleCompra_id` int(11) NOT NULL,
  `detalleCompra_cantidad` int(11) NOT NULL DEFAULT 1,
  `detalleCompra_precioC` decimal(11,2) NOT NULL DEFAULT 0.00,
  `detalleCompra_id_compra` int(11) NOT NULL,
  `detalleCompra_id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `detalleVenta_id` int(11) NOT NULL,
  `detalleVenta_cantidad` int(11) NOT NULL DEFAULT 1,
  `detalleVenta_precioV` decimal(10,2) NOT NULL DEFAULT 0.00,
  `detalleVenta_descuento` decimal(10,2) NOT NULL DEFAULT 0.00,
  `detalleVenta_id_venta` int(11) NOT NULL,
  `detalleVenta_id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(10) NOT NULL,
  `empresa_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_ruc` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_correo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_impuesto` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_impuestoValor` int(11) NOT NULL,
  `empresa_moneda` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_simbolo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `empresa_logo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `empresa_nombre`, `empresa_ruc`, `empresa_celular`, `empresa_direccion`, `empresa_correo`, `empresa_impuesto`, `empresa_impuestoValor`, `empresa_moneda`, `empresa_simbolo`, `empresa_logo`) VALUES
(1, 'CONFIGURAR', '000000000000', '000000000', 'SIN DIRECCÓN', 'corre@example.com', 'IGV', 18, 'SOLES', 'S/.', '../Assets/images/iconos/default-company.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compra`
--

CREATE TABLE `historial_compra` (
  `hc_id` int(100) NOT NULL,
  `hc_id_compra` int(11) NOT NULL,
  `hc_producto` int(11) NOT NULL,
  `hc_id_lote` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `hc_fechaVe` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_venta`
--

CREATE TABLE `historial_venta` (
  `hv_id` int(10) NOT NULL,
  `hv_id_venta` int(11) NOT NULL,
  `hv_cantidad` int(11) NOT NULL,
  `hv_fechaVencimiento` date NOT NULL,
  `hv_id_lote` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `hv_id_proveedor` int(11) NOT NULL,
  `hv_id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `lab_id` int(10) NOT NULL,
  `lab_codigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `lab_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `lote_id` int(10) NOT NULL,
  `lote_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `lote_cantUnitario` int(11) NOT NULL DEFAULT 1,
  `lote_fechaVencimiento` date NOT NULL,
  `lote_id_producto` int(11) NOT NULL,
  `lote_id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `present_id` int(10) NOT NULL,
  `present_codigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `present_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `prod_id` int(10) NOT NULL,
  `prod_codigo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_codigoin` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_concentracion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_adicional` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_imagen` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `prod_precioC` decimal(10,2) NOT NULL DEFAULT 0.00,
  `prod_precioV` decimal(10,2) NOT NULL DEFAULT 0.00,
  `prod_porcentaje` int(5) NOT NULL DEFAULT 0,
  `prod_id_lab` int(11) NOT NULL,
  `prod_id_tipo` int(11) NOT NULL,
  `prod_id_present` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `proved_id` int(10) NOT NULL,
  `proved_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_tipoDocumento` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_numDocumento` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `proved_direccion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `tipo_id` int(10) NOT NULL,
  `tipo_codigo` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(10) NOT NULL,
  `usuario_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_fechanacimiento` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_profesion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_dni` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_celular` varchar(12) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_genero` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_cargo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_login` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_contrasena` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_perfil` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_codigo`, `usuario_nombre`, `usuario_apellido`, `usuario_fechanacimiento`, `usuario_profesion`, `usuario_dni`, `usuario_celular`, `usuario_genero`, `usuario_cargo`, `usuario_descripcion`, `usuario_login`, `usuario_contrasena`, `usuario_perfil`, `usuario_estado`) VALUES
(1, 'USU-8458881', 'Administrador', 'Administrador', '1982-05-05', 'Administrador', '0', '0', 'Masculino', 'Administrador', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout', 'admin', 'STEzZWowVG9UaFZFQU5mMXhVcGx5QT09', '../Assets/images/avatar/masculino.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `venta_id` int(11) NOT NULL,
  `venta_codigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_id_comprobante` int(11) NOT NULL,
  `venta_serie` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_numComprobante` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `venta_fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `venta_impuesto` int(11) NOT NULL,
  `venta_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `venta_id_usuario` int(11) NOT NULL,
  `venta_id_cliente` int(11) NOT NULL,
  `venta_estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`bitacora_id`),
  ADD KEY `bitacora_id_usuario` (`bitacora_id_usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`compra_id`),
  ADD KEY `compra_id_proveedor` (`compra_id_proveedor`),
  ADD KEY `compra_id_usuario` (`compra_id_usuario`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`comprobante_id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`detalleCompra_id`),
  ADD KEY `detalleCompra_id_compra` (`detalleCompra_id_compra`),
  ADD KEY `detalleCompra_id_producto` (`detalleCompra_id_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`detalleVenta_id`),
  ADD KEY `detalleVenta_id_venta` (`detalleVenta_id_venta`),
  ADD KEY `detalleVenta_id_producto` (`detalleVenta_id_producto`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  ADD PRIMARY KEY (`hc_id`),
  ADD KEY `hc_id_compra` (`hc_id_compra`);

--
-- Indices de la tabla `historial_venta`
--
ALTER TABLE `historial_venta`
  ADD PRIMARY KEY (`hv_id`),
  ADD KEY `hv_id_venta` (`hv_id_venta`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`lab_id`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`lote_id`),
  ADD KEY `lote_id_producto` (`lote_id_producto`),
  ADD KEY `lote_id_proveedor` (`lote_id_proveedor`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`present_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `prod_id_lab` (`prod_id_lab`),
  ADD KEY `prod_id_tipo` (`prod_id_tipo`),
  ADD KEY `prod_id_present` (`prod_id_present`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`proved_id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`venta_id`),
  ADD KEY `venta_id_usuario` (`venta_id_usuario`),
  ADD KEY `venta_id_cliente` (`venta_id_cliente`),
  ADD KEY `venta_id_comprobante` (`venta_id_comprobante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `bitacora_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `compra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `comprobante_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `detalleCompra_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `detalleVenta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  MODIFY `hc_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_venta`
--
ALTER TABLE `historial_venta`
  MODIFY `hv_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `lab_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `lote_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `present_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `proved_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `tipo_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `venta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`bitacora_id_usuario`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`compra_id_proveedor`) REFERENCES `proveedor` (`proved_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`compra_id_usuario`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`detalleCompra_id_compra`) REFERENCES `compra` (`compra_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`detalleCompra_id_producto`) REFERENCES `producto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`detalleVenta_id_venta`) REFERENCES `venta` (`venta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`detalleVenta_id_producto`) REFERENCES `producto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_compra`
--
ALTER TABLE `historial_compra`
  ADD CONSTRAINT `historial_compra_ibfk_1` FOREIGN KEY (`hc_id_compra`) REFERENCES `compra` (`compra_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_venta`
--
ALTER TABLE `historial_venta`
  ADD CONSTRAINT `historial_venta_ibfk_1` FOREIGN KEY (`hv_id_venta`) REFERENCES `venta` (`venta_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`lote_id_proveedor`) REFERENCES `proveedor` (`proved_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`lote_id_producto`) REFERENCES `producto` (`prod_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`prod_id_lab`) REFERENCES `laboratorio` (`lab_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`prod_id_tipo`) REFERENCES `tipo_producto` (`tipo_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`prod_id_present`) REFERENCES `presentacion` (`present_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`venta_id_usuario`) REFERENCES `usuario` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`venta_id_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`venta_id_comprobante`) REFERENCES `comprobante` (`comprobante_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
