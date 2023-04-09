-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2023 a las 20:14:47
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbproyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `estado`, `id_usuario`) VALUES
(2, 'aceites', '1', 1),
(6, 'jabones', '1', 1),
(7, 'harinas', '1', 1),
(8, 'aceites', '1', 1),
(9, 'jabones', '1', 1),
(10, 'harinas', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(20) NOT NULL,
  `dni_cliente` int(20) NOT NULL,
  `nombre_cliente` varchar(100) NOT NULL,
  `apellido_cliente` varchar(100) NOT NULL,
  `telefono_cliente` varchar(100) NOT NULL,
  `direccion_cliente` varchar(100) NOT NULL,
  `fecha_alta` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `dni_cliente`, `nombre_cliente`, `apellido_cliente`, `telefono_cliente`, `direccion_cliente`, `fecha_alta`, `estado`, `id_usuario`) VALUES
(5, 159966666, 'Jorge', 'Rodriguez', '459966666', 'california', '2018-02-05', '1', 1),
(6, 45, 'karla', 'rodriguez', '789', 'chicago', '2018-02-13', '1', 1),
(7, 159966666, 'Jorge', 'Rodriguez', '459966666', 'california', '2018-02-05', '1', 1),
(8, 45, 'karla', 'rodriguez', '789', 'chicago', '2018-02-13', '1', 1),
(57, 44011633, 'belen', 'sosa', '3764121314', 'sdf', '2023-03-30', '1', 1),
(58, 13999222, 'Martin', 'kasjd', '213', 'sklajdljsadlasf.', '2023-04-07', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compras` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `numero_compra` varchar(100) NOT NULL,
  `proveedor` varchar(100) NOT NULL,
  `cuit_proveedor` varchar(100) NOT NULL,
  `comprador` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compras`, `fecha_compra`, `numero_compra`, `proveedor`, `cuit_proveedor`, `comprador`, `moneda`, `total`, `tipo_pago`, `estado`, `id_usuario`, `id_proveedor`) VALUES
(1, '2018-01-31', 'F000001', 'luis lopez', '14789', 'eyter', 'USD$', '120', 'CHEQUE', '1', 1, 3),
(2, '2018-02-06', 'F000002', 'luis lopez', '14789', 'eyter', 'USD$', '480', 'CHEQUE', '0', 1, 3),
(3, '2018-02-07', 'F000003', 'luis lopez', '14789', 'eyter', 'USD$', '480', 'EFECTIVO', '1', 1, 3),
(4, '2018-02-07', 'F000004', 'luis lopez', '14789', 'eyter', 'USD$', '192', 'EFECTIVO', '1', 1, 3),
(7, '2018-10-26', 'F000005', 'roberto perez', '45965', 'eyter', 'USD$', '336', 'CHEQUE', '0', 1, 4),
(8, '2018-01-31', 'F000001', 'luis lopez', '14789', 'eyter', 'USD$', '120', 'CHEQUE', '0', 1, 3),
(9, '2018-02-06', 'F000002', 'luis lopez', '14789', 'eyter', 'USD$', '480', 'CHEQUE', '0', 1, 3),
(10, '2018-02-07', 'F000003', 'luis lopez', '14789', 'eyter', 'USD$', '480', 'EFECTIVO', '1', 1, 3),
(11, '2018-02-07', 'F000004', 'luis lopez', '14789', 'eyter', 'USD$', '192', 'EFECTIVO', '1', 1, 3),
(12, '2023-03-12', 'F000007', 'roberto perez', '45965', 'eyter', 'USD$', 'USD$ 96', 'EFECTIVO', '1', 1, 4),
(13, '2023-03-12', 'F000008', 'roberto perez', '45965', 'eyter', 'USD$', '160', 'CHEQUE', '1', 1, 4),
(14, '2023-03-12', 'F000009', 'roberto perez', '45965', 'eyter', 'USD$', '100', 'EFECTIVO', '1', 1, 4),
(15, '2023-03-13', 'F000010', 'luis lopez', '14789', 'eyter', 'USD$', '400', 'EFECTIVO', '1', 1, 3),
(16, '2018-01-31', 'F000001', 'luis lopez', '14789', 'eyter', 'USD$', '120', 'CHEQUE', '0', 1, 3),
(17, '2018-02-06', 'F000002', 'luis lopez', '14789', 'eyter', 'USD$', '480', 'CHEQUE', '0', 1, 3),
(18, '2018-02-07', 'F000003', 'luis lopez', '14789', 'eyter', 'USD$', '480', 'EFECTIVO', '1', 1, 3),
(19, '2018-02-07', 'F000004', 'luis lopez', '14789', 'eyter', 'USD$', '192', 'EFECTIVO', '1', 1, 3),
(20, '2023-03-12', 'F000007', 'roberto perez', '45965', 'eyter', 'USD$', 'USD$ 96', 'EFECTIVO', '1', 1, 4),
(21, '2023-03-12', 'F000008', 'roberto perez', '45965', 'eyter', 'USD$', '160', 'CHEQUE', '1', 1, 4),
(22, '2023-03-12', 'F000009', 'roberto perez', '45965', 'eyter', 'USD$', '100', 'EFECTIVO', '1', 1, 4),
(23, '2023-03-13', 'F000010', 'luis lopez', '14789', 'eyter', 'USD$', '400', 'EFECTIVO', '1', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_corrientes`
--

CREATE TABLE `cuentas_corrientes` (
  `id_cuentas_corrientes` int(20) NOT NULL,
  `id_cliente` int(20) NOT NULL,
  `saldo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuentas_corrientes`
--

INSERT INTO `cuentas_corrientes` (`id_cuentas_corrientes`, `id_cliente`, `saldo`) VALUES
(29, 57, '81'),
(30, 58, '162');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

CREATE TABLE `detalle_compras` (
  `id_detalle_compras` int(11) NOT NULL,
  `numero_compra` varchar(100) NOT NULL,
  `cuit_proveedor` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `precio_compra` varchar(100) NOT NULL,
  `cantidad_compra` varchar(100) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `fecha_compra` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compras`
--

INSERT INTO `detalle_compras` (`id_detalle_compras`, `numero_compra`, `cuit_proveedor`, `id_producto`, `producto`, `moneda`, `precio_compra`, `cantidad_compra`, `descuento`, `importe`, `fecha_compra`, `id_usuario`, `id_proveedor`, `estado`, `id_categoria`) VALUES
(1, 'F000001', '14789', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2018-01-31', 1, 3, '1', 6),
(2, 'F000002', '14789', 9, 'jabon casa', 'USD$', '80', '5', '0', '400', '2018-02-06', 1, 3, '0', 6),
(3, 'F000003', '14789', 4, 'jabon ACE', 'USD$', '100', '4', '0', '400', '2018-02-07', 1, 3, '1', 6),
(4, 'F000004', '14789', 7, 'harina pan', 'USD$', '60', '1', '0', '60', '2018-02-07', 1, 3, '1', 7),
(5, 'F000004', '14789', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2018-02-07', 1, 3, '1', 6),
(9, 'F000005', '45965', 4, 'jabon ACE', 'USD$', '100', '2', '0', '200', '2018-10-26', 1, 4, '0', 6),
(10, 'F000005', '45965', 9, 'jabon casa', 'USD$', '80', '1', '0', '80', '2018-10-26', 1, 4, '0', 6),
(11, 'F000001', '14789', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2018-01-31', 1, 3, '1', 6),
(12, 'F000002', '14789', 9, 'jabon casa', 'USD$', '80', '5', '0', '400', '2018-02-06', 1, 3, '0', 6),
(13, 'F000003', '14789', 4, 'jabon ACE', 'USD$', '100', '4', '0', '400', '2018-02-07', 1, 3, '1', 6),
(14, 'F000004', '14789', 7, 'harina pan', 'USD$', '60', '1', '0', '60', '2018-02-07', 1, 3, '1', 7),
(15, 'F000004', '14789', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2018-02-07', 1, 3, '1', 6),
(16, 'F000005', '45965', 9, 'jabon casa', 'USD$', '80', '1', '0', '80', '2023-03-12', 1, 4, '1', 6),
(17, 'F000006', '45965', 9, 'jabon casa', 'USD$', '80', '1', '0', '80', '2023-03-12', 1, 4, '1', 6),
(18, 'F000007', '45965', 9, 'jabon casa', 'USD$', '80', '1', '0', '80', '2023-03-12', 1, 4, '1', 6),
(19, 'F000008', '45965', 9, 'jabon casa', 'USD$', '80', '1', '0', '80', '2023-03-12', 1, 4, '1', 6),
(20, 'F000008', '45965', 9, 'jabon casa', 'USD$', '80', '1', '0', '80', '2023-03-12', 1, 4, '1', 6),
(21, 'F000009', '45965', 4, 'jabon ACE', 'USD$', '100', '1', '0', '100', '2023-03-12', 1, 4, '1', 6),
(22, 'F000010', '14789', 4, 'jabon ACE', 'USD$', '100', '4', '0', '400', '2023-03-13', 1, 3, '1', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cuentas_corrientes`
--

CREATE TABLE `detalle_cuentas_corrientes` (
  `id_detalle_cc` int(11) NOT NULL,
  `id_cuenta_corriente` int(11) NOT NULL,
  `id_ventas` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `monto` varchar(100) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_cuentas_corrientes`
--

INSERT INTO `detalle_cuentas_corrientes` (`id_detalle_cc`, `id_cuenta_corriente`, `id_ventas`, `fecha`, `monto`, `id_cliente`, `id_usuario`) VALUES
(5, 29, 43, '2023-04-07 16:30:20', '200', 57, 1),
(6, 29, 47, '2023-04-07 16:48:22', '81', 57, 1),
(7, 29, 48, '2023-04-07 16:49:18', '81', 57, 1),
(8, 30, 49, '2023-04-09 14:40:35', '90', 58, 1),
(9, 30, 50, '2023-04-09 14:40:58', '90', 58, 1),
(10, 30, 51, '2023-04-09 14:47:11', '90', 58, 1),
(11, 30, 52, '2023-04-09 14:48:44', '90', 58, 1),
(12, 30, 53, '2023-04-09 14:50:38', '90', 58, 1),
(13, 30, 54, '2023-04-09 14:52:11', '81', 58, 1),
(14, 30, 55, '2023-04-09 14:56:47', '81', 58, 1),
(15, 30, 56, '2023-04-09 14:57:47', '81', 58, 1),
(16, 30, 57, '2023-04-09 14:58:31', '81', 58, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id_detalle_ventas` int(11) NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `dni_cliente` varchar(100) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `precio_venta` varchar(100) NOT NULL,
  `cantidad_venta` varchar(100) NOT NULL,
  `descuento` varchar(100) NOT NULL,
  `importe` varchar(100) NOT NULL,
  `fecha_venta` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id_detalle_ventas`, `numero_venta`, `dni_cliente`, `id_producto`, `producto`, `moneda`, `precio_venta`, `cantidad_venta`, `descuento`, `importe`, `fecha_venta`, `id_usuario`, `id_cliente`, `estado`) VALUES
(2, 'F000001', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(3, 'F000002', '159966666', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(4, 'F000002', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(5, 'F000002', '159966666', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2018-02-07', 1, 5, '1'),
(12, 'F000003', '159966666', 4, 'jabon ACE', 'USD$', '200', '2', '0', '400', '2018-10-26', 1, 5, '0'),
(13, 'F000003', '159966666', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2018-10-26', 1, 5, '0'),
(14, 'F000001', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(15, 'F000002', '159966666', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(16, 'F000002', '159966666', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2018-02-07', 1, 5, '1'),
(17, 'F000002', '159966666', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2018-02-07', 1, 5, '1'),
(18, 'F000003', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(19, 'F000004', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(20, 'F000005', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(21, 'F000006', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(22, 'F000007', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(23, 'F000008', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(24, 'F000009', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(25, 'F000010', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(26, 'F000011', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(27, 'F000012', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(28, 'F000013', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(29, 'F000014', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(30, 'F000015', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(31, 'F000016', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(32, 'F000017', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(33, 'F000018', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(34, 'F000019', '44011633', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-05', 1, 57, '1'),
(35, 'F000020', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(36, 'F000021', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(37, 'F000022', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(38, 'F000023', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(39, 'F000023', '45', 10, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 6, '1'),
(40, 'F000024', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(41, 'F000025', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(42, 'F000026', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(43, 'F000027', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-05', 1, 57, '1'),
(44, 'F000028', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(45, 'F000029', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(46, 'F000030', '44011633', 4, 'jabon ACE', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(47, 'F000031', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(48, 'F000032', '44011633', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-07', 1, 57, '1'),
(49, 'F000033', '44011633', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-07', 1, 57, '1'),
(50, 'F000034', '44011633', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2023-04-07', 1, 57, '1'),
(51, 'F000035', '44011633', 14, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(52, 'F000036', '44011633', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-07', 1, 57, '1'),
(53, 'F000037', '44011633', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-07', 1, 57, '1'),
(54, 'F000038', '44011633', 9, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(55, 'F000039', '44011633', 14, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(56, 'F000040', '44011633', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-07', 1, 57, '1'),
(57, 'F000041', '44011633', 14, 'jabon casa', 'USD$', '200', '1', '0', '200', '2023-04-07', 1, 57, '1'),
(58, 'F000042', '44011633', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2023-04-07', 1, 57, '1'),
(59, 'F000043', '44011633', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2023-04-07', 1, 57, '1'),
(60, 'F000044', '13999222', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-09', 1, 58, '1'),
(61, 'F000045', '13999222', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-09', 1, 58, '1'),
(62, 'F000046', '13999222', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-09', 1, 58, '1'),
(63, 'F000047', '13999222', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-09', 1, 58, '1'),
(64, 'F000048', '13999222', 7, 'harina pan', 'USD$', '90', '1', '0', '90', '2023-04-09', 1, 58, '1'),
(65, 'F000049', '13999222', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2023-04-09', 1, 58, '1'),
(66, 'F000050', '13999222', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2023-04-09', 1, 58, '1'),
(67, 'F000051', '13999222', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2023-04-09', 1, 58, '1'),
(68, 'F000052', '13999222', 8, 'pan ', 'USD$', '81', '1', '0', '81', '2023-04-09', 1, 58, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `cedula_empresa` varchar(100) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion_empresa` varchar(100) NOT NULL,
  `correo_empresa` varchar(100) NOT NULL,
  `telefono_empresa` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `cedula_empresa`, `nombre_empresa`, `direccion_empresa`, `correo_empresa`, `telefono_empresa`, `id_usuario`) VALUES
(1, '1223459988', 'eyter', 'california san jose', 'eyterdaniel@gmail.com', '12899665588', 1),
(2, '1223459988', 'eyter', 'california san jose', 'eyterdaniel@gmail.com', '12899665588', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre`) VALUES
(1, 'Categoria'),
(2, 'Productos'),
(3, 'Proveedores'),
(4, 'Compras'),
(5, 'Clientes'),
(6, 'Ventas'),
(7, 'Reporte de Compras'),
(8, 'Reporte de Ventas'),
(9, 'Usuarios'),
(10, 'Empresa'),
(11, 'Categoria'),
(12, 'Productos'),
(13, 'Proveedores'),
(14, 'Compras'),
(15, 'Clientes'),
(16, 'Ventas'),
(17, 'Reporte de Compras'),
(18, 'Reporte de Ventas'),
(19, 'Usuarios'),
(20, 'Empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `moneda` varchar(45) NOT NULL,
  `precio_compra` varchar(45) NOT NULL,
  `precio_venta` varchar(45) NOT NULL,
  `stock` varchar(45) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `id_categoria`, `producto`, `moneda`, `precio_compra`, `precio_venta`, `stock`, `estado`, `imagen`, `fecha_vencimiento`, `id_usuario`) VALUES
(4, 6, 'jabon ACE', 'USD$', '100', '200', '0', '1', '1982969361.jpg', '2018-01-31', 1),
(6, 2, 'aceite carro', 'USD$', '100', '300', '20', '0', '216717336.jpg', '2018-01-25', 1),
(7, 7, 'harina pan', 'USD$', '60', '90', '9', '1', '234611002.jpg', '2018-01-30', 1),
(8, 7, 'pan ', 'USD$', '60', '81', '13', '1', '1407078505.jpg', '2018-01-24', 1),
(9, 6, 'jabon casa', 'USD$', '80', '200', '11', '1', '1121250455.jpg', '2018-01-29', 1),
(10, 6, 'jabon ACE', 'USD$', '100', '200', '0', '1', '1982969361.jpg', '2018-01-31', 1),
(11, 2, 'aceite carro', 'USD$', '100', '300', '0', '0', '216717336.jpg', '2018-01-25', 1),
(12, 7, 'harina pan', 'USD$', '60', '90', '0', '1', '234611002.jpg', '2018-01-30', 1),
(13, 7, 'pan ', 'USD$', '60', '81', '0', '1', '1407078505.jpg', '2018-01-24', 1),
(14, 6, 'jabon casa', 'USD$', '80', '200', '0', '1', '1121250455.jpg', '2018-01-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `cuit` varchar(45) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `cuit`, `razon_social`, `telefono`, `correo`, `direccion`, `fecha`, `estado`, `id_usuario`) VALUES
(3, '14789', 'luis lopez', '12399888', 'luis@gmail.com', 'california', '2018-01-29', '1', 1),
(4, '45965', 'roberto perez', '48859', 'roberto@gmail.com', 'texas', '2018-02-13', '1', 1),
(5, '234243', 'sdfsfd', '23424', 'sosabelen597@gmail.com', 'sdfsdf', '2023-03-29', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `dni_usuario` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cargo` enum('0','1') NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password2` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombres`, `apellidos`, `dni_usuario`, `telefono`, `correo`, `direccion`, `cargo`, `usuario`, `password`, `password2`, `fecha_ingreso`, `estado`) VALUES
(1, 'eyter', 'higuera', '1', '123456', 'eyter@gmail.com', 'san jose', '1', 'daniel', 'Qw/*12345678', 'Qw/*12345678', '2017-12-26', '1'),
(2, 'alejandro', 'perez', '12', '12968566', 'alejandro@gmail.com', 'california', '0', 'alejandro', 'Qw/*12345678', 'Qw/*12345678', '2018-02-13', '1'),
(3, 'eyter', 'higuera', '1', '123456', 'eyter@gmail.com', 'san jose', '1', 'daniel', 'Qw/*12345678', 'Qw/*12345678', '2017-12-26', '1'),
(4, 'alejandro', 'perez', '12', '12968566', 'alejandro@gmail.com', 'california', '0', 'alejandro', 'Qw/*12345678', 'Qw/*12345678', '2018-02-13', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `id_usuario_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`id_usuario_permiso`, `id_usuario`, `id_permiso`) VALUES
(32, 2, 1),
(33, 2, 2),
(110, 1, 1),
(111, 1, 2),
(112, 1, 3),
(113, 1, 4),
(114, 1, 5),
(115, 1, 6),
(116, 1, 7),
(117, 1, 8),
(118, 1, 9),
(119, 1, 10),
(120, 2, 1),
(121, 2, 2),
(122, 1, 2),
(123, 1, 3),
(124, 1, 4),
(125, 1, 5),
(126, 1, 6),
(127, 1, 7),
(128, 1, 8),
(129, 1, 9),
(130, 1, 10),
(131, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `numero_venta` varchar(100) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `cedula_cliente` varchar(100) NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `tipo_pago` varchar(100) NOT NULL,
  `estado` enum('0','1') NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha_venta`, `numero_venta`, `cliente`, `cedula_cliente`, `vendedor`, `moneda`, `total`, `tipo_pago`, `estado`, `id_usuario`, `id_cliente`) VALUES
(2, '2018-02-07', 'F000001', 'Jorge', '159966666', 'eyter', 'USD$', '240', 'EFECTIVO', '1', 1, 5),
(3, '2018-02-07', 'F000002', 'Jorge', '159966666', 'eyter', 'USD$', '588', 'EFECTIVO', '1', 1, 5),
(7, '2018-10-26', 'F000003', 'Jorge', '159966666', 'eyter', 'USD$', '577', 'CHEQUE', '0', 1, 5),
(8, '2023-04-05', 'F000003', 'belen', '44011633', 'eyter', 'USD$', '681', 'CUENTA CORRIENTE', '1', 1, 57),
(9, '2023-04-05', 'F000004', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(10, '2023-04-05', 'F000005', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(11, '2023-04-05', 'F000006', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(12, '2023-04-05', 'F000007', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(13, '2023-04-05', 'F000008', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(14, '2023-04-05', 'F000009', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(15, '2023-04-05', 'F000010', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(16, '2023-04-05', 'F000011', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(17, '2023-04-05', 'F000012', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(18, '2023-04-05', 'F000013', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(19, '2023-04-05', 'F000014', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(20, '2023-04-05', 'F000015', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(21, '2023-04-05', 'F000016', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(22, '2023-04-05', 'F000017', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(23, '2023-04-05', 'F000018', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(24, '2023-04-05', 'F000019', 'belen', '44011633', 'eyter', 'USD$', '90', 'TRANSFERENCIA', '1', 1, 57),
(25, '2023-04-05', 'F000020', 'belen', '44011633', 'eyter', 'USD$', '200', 'TRANSFERENCIA', '1', 1, 57),
(26, '2023-04-05', 'F000021', 'belen', '44011633', 'eyter', 'USD$', '200', 'TRANSFERENCIA', '1', 1, 57),
(27, '2023-04-05', 'F000022', 'belen', '44011633', 'eyter', 'USD$', '200', 'EFECTIVO', '1', 1, 57),
(28, '2023-04-05', 'F000023', 'belen', '44011633', 'eyter', 'USD$', '200', 'EFECTIVO', '1', 1, 57),
(29, '2023-04-05', 'F000023', 'karla', '45', 'eyter', 'USD$', '400', 'TRANSFERENCIA', '1', 1, 6),
(30, '2023-04-05', 'F000024', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(31, '2023-04-05', 'F000025', 'belen', '44011633', 'eyter', 'USD$', '200', 'EFECTIVO', '1', 1, 57),
(32, '2023-04-05', 'F000026', 'belen', '44011633', 'eyter', 'USD$', '200', 'CHEQUE', '1', 1, 57),
(33, '2023-04-07', 'F000028', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(34, '2023-04-07', 'F000029', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(35, '2023-04-07', 'F000030', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(36, '2023-04-07', 'F000031', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(37, '2023-04-07', 'F000032', 'belen', '44011633', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 57),
(38, '2023-04-07', 'F000033', 'belen', '44011633', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 57),
(39, '2023-04-07', 'F000034', 'belen', '44011633', 'eyter', 'USD$', '81', 'CUENTA CORRIENTE', '1', 1, 57),
(40, '2023-04-07', 'F000035', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(41, '2023-04-07', 'F000036', 'belen', '44011633', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 57),
(42, '2023-04-07', 'F000037', 'belen', '44011633', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 57),
(43, '2023-04-07', 'F000038', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(44, '2023-04-07', 'F000039', 'belen', '44011633', 'eyter', 'USD$', '200', 'EFECTIVO', '1', 1, 57),
(45, '2023-04-07', 'F000040', 'belen', '44011633', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 57),
(46, '2023-04-07', 'F000041', 'belen', '44011633', 'eyter', 'USD$', '200', 'CUENTA CORRIENTE', '1', 1, 57),
(47, '2023-04-07', 'F000042', 'belen', '44011633', 'eyter', 'USD$', '81', 'CUENTA CORRIENTE', '1', 1, 57),
(48, '2023-04-07', 'F000043', 'belen', '44011633', 'eyter', 'USD$', '81', 'CUENTA CORRIENTE', '1', 1, 57),
(49, '2023-04-09', 'F000044', 'Martin', '13999222', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 58),
(50, '2023-04-09', 'F000045', 'Martin', '13999222', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 58),
(51, '2023-04-09', 'F000046', 'Martin', '13999222', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 58),
(52, '2023-04-09', 'F000047', 'Martin', '13999222', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 58),
(53, '2023-04-09', 'F000048', 'Martin', '13999222', 'eyter', 'USD$', '90', 'CUENTA CORRIENTE', '1', 1, 58),
(54, '2023-04-09', 'F000049', 'Martin', '13999222', 'eyter', 'USD$', '81', 'CUENTA CORRIENTE', '1', 1, 58),
(55, '2023-04-09', 'F000050', 'Martin', '13999222', 'eyter', 'USD$', '81', 'CUENTA CORRIENTE', '1', 1, 58),
(56, '2023-04-09', 'F000051', 'Martin', '13999222', 'eyter', 'USD$', '81', 'CUENTA CORRIENTE', '1', 1, 58),
(57, '2023-04-09', 'F000052', 'Martin', '13999222', 'eyter', 'USD$', '81', 'CUENTA CORRIENTE', '1', 1, 58);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `fk_categoria_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_clientes_usuario_idx` (`id_usuario`),
  ADD KEY `dni_cc` (`dni_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `fk_compras_usuario_idx` (`id_usuario`),
  ADD KEY `fk_compras_proveedor_idx` (`id_proveedor`);

--
-- Indices de la tabla `cuentas_corrientes`
--
ALTER TABLE `cuentas_corrientes`
  ADD PRIMARY KEY (`id_cuentas_corrientes`),
  ADD KEY `id_cliente_ccfk_idx` (`id_cliente`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id_detalle_compras`),
  ADD KEY `fk_detalle_compras_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_compras_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_compras_proveedor_idx` (`id_proveedor`),
  ADD KEY `fk_detalle_compras_categoria_idx` (`id_categoria`);

--
-- Indices de la tabla `detalle_cuentas_corrientes`
--
ALTER TABLE `detalle_cuentas_corrientes`
  ADD PRIMARY KEY (`id_detalle_cc`),
  ADD KEY `id_ventas_dcfk_idx` (`id_ventas`),
  ADD KEY `id_usuario_dcfk_idx` (`id_usuario`),
  ADD KEY `id_cliente_dcfk_idx` (`id_cliente`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id_detalle_ventas`),
  ADD KEY `fk_detalle_ventas_producto_idx` (`id_producto`),
  ADD KEY `fk_detalle_ventas_usuario_idx` (`id_usuario`),
  ADD KEY `fk_detalle_ventas_clientes_idx` (`id_cliente`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `fk_empresa_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_categoria_idx` (`id_categoria`),
  ADD KEY `fk_producto_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD KEY `fk_proveedor_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id_usuario_permiso`),
  ADD KEY `fk_usuario_permiso_usuario_idx` (`id_usuario`),
  ADD KEY `fk_usuario_permiso_permiso_idx` (`id_permiso`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`),
  ADD KEY `fk_ventas_usuario_idx` (`id_usuario`),
  ADD KEY `fk_ventas_cliente_idx` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `cuentas_corrientes`
--
ALTER TABLE `cuentas_corrientes`
  MODIFY `id_cuentas_corrientes` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id_detalle_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `detalle_cuentas_corrientes`
--
ALTER TABLE `detalle_cuentas_corrientes`
  MODIFY `id_detalle_cc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id_detalle_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `fk_categoria_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compras_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuentas_corrientes`
--
ALTER TABLE `cuentas_corrientes`
  ADD CONSTRAINT `id_cliente_ccfk` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD CONSTRAINT `fk_detalle_compras_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compras_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compras_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compras_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_cuentas_corrientes`
--
ALTER TABLE `detalle_cuentas_corrientes`
  ADD CONSTRAINT `id_cliente_dcfk` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usuario_dcfk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_ventas_dcfk` FOREIGN KEY (`id_ventas`) REFERENCES `ventas` (`id_ventas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `fk_detalle_ventas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ventas_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_ventas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `fk_empresa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_proveedor_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_ventas_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
