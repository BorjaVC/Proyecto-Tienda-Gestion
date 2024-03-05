-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2023 a las 21:38:54
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_administrador`, `username`, `email`) VALUES
(1, 'BorAdmin', 'brainwash.bv@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nombre` varchar(50) NOT NULL,
  `categoria_ubicacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_nombre`, `categoria_ubicacion`) VALUES
(1, 'Anillo', ''),
(2, 'Collar', ''),
(3, 'Pendientes', ''),
(4, 'Pulsera', ''),
(6, 'Gemelos', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `username`, `email`) VALUES
(22, 'peter', 'pedro@gmail.com'),
(24, 'amaya', 'braopop.bv@gmail.com'),
(25, 'borja', 'brainwash23.bv@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Realizado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `customer_id`, `total_price`, `payment_method`, `created`, `modified`, `status`) VALUES
(61, 29, 145.00, '', '2023-05-14 13:35:40', '2023-05-14 13:37:43', 'Entregado'),
(62, 29, 150.00, '', '2023-05-14 13:35:47', '2023-05-14 13:37:53', 'Enviado'),
(70, 34, 75.00, '', '2023-05-16 09:50:51', '2023-05-16 09:50:51', 'Realizado'),
(79, 29, 75.00, '', '2023-05-16 11:23:33', '2023-05-16 11:23:33', 'Realizado'),
(81, 29, 145.00, '', '2023-05-16 12:30:43', '2023-05-16 12:30:43', 'Realizado'),
(82, 29, 80.00, '', '2023-05-16 12:30:48', '2023-05-16 12:30:48', 'Realizado'),
(83, 29, 145.00, '', '2023-05-16 12:30:53', '2023-05-16 12:30:53', 'Realizado'),
(84, 29, 90.00, '', '2023-05-16 12:30:58', '2023-05-16 12:30:58', 'Realizado'),
(85, 29, 95.00, '', '2023-05-16 12:31:02', '2023-05-16 12:31:02', 'Realizado'),
(86, 29, 145.00, '', '2023-05-16 12:31:15', '2023-05-16 12:31:15', 'Realizado'),
(87, 29, 90.00, '', '2023-05-16 12:31:37', '2023-05-16 12:31:37', 'Realizado'),
(88, 29, 145.00, '', '2023-05-16 12:32:25', '2023-05-16 12:32:25', 'Realizado'),
(89, 29, 80.00, '', '2023-05-16 12:32:31', '2023-05-16 12:32:31', 'Realizado'),
(90, 29, 125.00, '', '2023-05-16 12:32:37', '2023-05-16 12:32:37', 'Realizado'),
(91, 29, 80.00, '', '2023-05-16 12:32:42', '2023-05-16 12:32:42', 'Realizado'),
(92, 29, 75.00, '', '2023-05-16 12:32:48', '2023-05-16 12:32:48', 'Realizado'),
(93, 34, 145.00, '', '2023-05-16 14:58:07', '2023-05-16 14:58:07', 'Realizado'),
(94, 34, 78.00, '', '2023-05-16 14:58:32', '2023-05-16 14:58:32', 'Realizado'),
(95, 34, 78.00, '', '2023-05-16 15:45:52', '2023-05-16 15:45:52', 'Realizado'),
(96, 34, 15.00, '', '2023-05-16 15:45:57', '2023-05-16 15:45:57', 'Realizado'),
(97, 34, 15.00, '', '2023-05-16 15:46:03', '2023-05-16 15:46:03', 'Realizado'),
(98, 34, 15.00, '', '2023-05-16 15:46:08', '2023-05-16 15:46:08', 'Realizado'),
(99, 34, 78.00, '', '2023-05-16 15:46:13', '2023-05-16 15:46:13', 'Realizado'),
(100, 34, 78.00, '', '2023-05-16 15:46:18', '2023-05-16 15:46:18', 'Realizado'),
(101, 34, 78.00, '', '2023-05-16 15:46:23', '2023-05-16 15:46:23', 'Realizado'),
(102, 34, 78.00, '', '2023-05-16 15:46:32', '2023-05-16 15:46:32', 'Realizado'),
(103, 34, 95.00, '', '2023-05-16 15:46:39', '2023-05-16 15:46:39', 'Realizado'),
(104, 34, 125.00, '', '2023-05-16 15:46:55', '2023-05-16 15:46:55', 'Realizado'),
(105, 34, 75.00, '', '2023-05-16 15:47:03', '2023-05-16 15:47:03', 'Realizado'),
(106, 34, 80.00, '', '2023-05-16 15:47:12', '2023-05-16 15:47:12', 'Realizado'),
(107, 34, 832.00, '', '2023-05-16 15:48:36', '2023-05-16 15:48:36', 'Realizado'),
(108, 33, 150.00, '', '2023-05-22 20:38:38', '2023-05-22 20:38:38', 'Realizado'),
(109, 33, 300.00, '', '2023-05-22 20:39:14', '2023-05-22 20:39:14', 'Realizado'),
(110, 33, 350.00, '', '2023-05-22 20:45:15', '2023-05-22 20:45:15', 'Realizado'),
(111, 33, 235.00, '', '2023-05-23 12:32:53', '2023-05-23 12:32:53', 'Realizado'),
(112, 33, 325.00, '', '2023-05-23 12:42:57', '2023-05-23 12:42:57', 'Realizado'),
(113, 29, 75.00, '', '2023-05-28 21:32:22', '2023-05-28 21:32:22', 'Realizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `producto_id` int(11) NOT NULL,
  `producto_nombre` varchar(70) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `producto_talla` varchar(30) NOT NULL,
  `producto_color` varchar(30) DEFAULT NULL,
  `producto_precio` float(10,2) NOT NULL,
  `producto_cantidad` int(11) NOT NULL,
  `producto_sold` int(7) NOT NULL,
  `producto_stock` int(25) NOT NULL,
  `producto_descripcion` varchar(500) NOT NULL,
  `producto_foto` varchar(500) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `created` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `producto_nombre`, `categoria_id`, `producto_talla`, `producto_color`, `producto_precio`, `producto_cantidad`, `producto_sold`, `producto_stock`, `producto_descripcion`, `producto_foto`, `usuario_id`, `created`) VALUES
(14, 'Anillo Cahchi', 1, 'M', 'Oro', 80.00, 10, 8, 2, 'Anillo de Oro en 24 Kilates', 'Anillo_Cahchi_38.png', 2, '2023-05-12 16:15:05'),
(15, 'Anillo Piramide', 1, 'L', 'Oro', 75.00, 10, 11, -1, 'Anillo de Oro en 24 Kilates', 'Anillo_Piramide_33.png', 2, '2023-05-12 16:16:03'),
(16, 'Anillo Canal', 1, 'M', 'Oro', 125.00, 10, 8, 2, 'Anillo de Oro en 24 Kilates con diamantes', 'Anillo_Canal_96.png', 2, '2023-05-12 16:16:51'),
(17, 'Collar Granos', 2, 'L', 'Oro', 150.00, 10, 7, 3, 'Collar chapado en Oro en 24 Kilates', 'Collar_Granos_8.jpg', 2, '2023-05-12 16:18:00'),
(18, 'Collar Cilindros', 2, 'L', 'Oro', 145.00, 10, 13, -3, 'Collar chapado en Oro en 24 Kilates', 'Collar_Cilindros_86.png', 2, '2023-05-12 16:18:32'),
(19, 'Collar Módulos', 2, 'M', 'Oro', 145.00, 10, 4, 6, 'Collar en Oro en 24 Kilates', 'Collar_Módulos_12.png', 2, '2023-05-12 16:19:05'),
(20, 'Pendientes Plumas', 3, 'M', 'Oro', 90.00, 10, 15, -5, 'Collar en Oro en 24 Kilates', 'Pendientes_Plumas_87.png', 2, '2023-05-12 16:19:56'),
(21, 'Pendientes Cangrejo', 3, 'M', 'Oro', 75.00, 10, 13, -3, 'Collar en Oro en 24 Kilates', 'Pendientes_Cangrejo_54.png', 2, '2023-05-12 16:20:28'),
(22, 'Pulsera Mecano', 4, 'M', 'Oro', 95.00, 10, 12, -2, 'Pulsera en Oro en 24 Kilates', 'Pulsera_Mecano_5.png', 2, '2023-05-12 16:21:39'),
(32, 'Pulsera Cesar', 4, 'M', 'Oro Amarillo', 235.00, 10, 1, 9, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Cesar_56.jpg', 2, '2023-05-17 18:55:59'),
(33, 'Pulsera Roma', 4, 'M', 'Oro Amarillo', 175.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Roma_48.jpg', 2, '2023-05-17 18:57:44'),
(34, 'Pulsera Enjambre', 4, 'M', 'Oro Rosa', 300.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Enjambre_11.jpg', 2, '2023-05-17 18:58:17'),
(35, 'Pulsera Dragón', 4, 'M', 'Oro Amarillo', 250.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Dragón_97.jpg', 2, '2023-05-17 18:58:54'),
(36, 'Pulsera Pepitas', 4, 'M', 'Oro Amarillo', 325.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Pepitas_57.jpg', 2, '2023-05-17 18:59:21'),
(37, 'Pulsera Módulo', 4, 'M', 'Oro Amarillo', 275.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Módulo_34.jpg', 2, '2023-05-17 18:59:43'),
(38, 'Pulsera Cebra', 4, 'M', 'Oro Blanco', 275.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Cebra_4.jpg', 2, '2023-05-17 19:00:08'),
(39, 'Pulsera Esposas', 4, 'M', 'Oro Blanco', 200.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Esposas_12.jpg', 2, '2023-05-17 19:00:30'),
(40, 'Pulsera Wonder', 4, 'M', 'Plata', 200.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Wonder_91.jpg', 2, '2023-05-17 19:01:02'),
(41, 'Pulsera Encuentro', 4, 'M', 'Plata', 200.00, 10, 0, 0, 'Pulsera de Oro de 24 Kilates', 'Pulsera_Encuentro_25.jpg', 2, '2023-05-17 19:01:22'),
(42, 'Pulsera Pomellato', 4, 'L', 'Oro Amarillo', 225.00, 10, 0, 0, 'Pulsera 24 Kilates', 'Pulsera_Pomellato_95.jpg', 2, '2023-05-17 19:03:09'),
(43, 'Anillo Geométrico', 1, 'L', 'Oro Amarillo', 120.00, 10, 0, 0, 'Anillo Oro Blanco', 'Anillo_Geométrico_85.png', 2, '2023-05-17 19:36:58'),
(44, 'Anillo Lapilázuri', 1, 'M', 'Oro Amarillo', 150.00, 10, 1, 9, 'Anillo Oro 24 Kilates', 'Anillo_Lapilázuri_72.png', 2, '2023-05-17 19:38:12'),
(45, 'Anillo Abanicos', 1, 'M', 'Oro Amarillo', 120.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Abanicos_98.png', 2, '2023-05-17 19:38:51'),
(46, 'Anillo Montaña', 1, 'L', 'Oro Amarillo', 175.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Montaña_61.png', 2, '2023-05-17 19:39:37'),
(47, 'Anillo Colmana', 1, 'L', 'Oro Amarillo', 225.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Colmana_22.jpg', 2, '2023-05-17 19:40:02'),
(48, 'Anillo Concha', 1, 'M', 'Oro Amarillo', 195.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Concha_52.jpg', 2, '2023-05-17 19:40:40'),
(49, 'Anillo Pomelano', 1, 'L', 'Oro Amarillo', 250.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Pomelano_59.jpg', 2, '2023-05-17 19:41:09'),
(50, 'Anillo Vintage', 1, 'L', 'Oro Amarillo', 300.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Vintage_77.jpg', 2, '2023-05-17 19:41:24'),
(51, 'Anillo Angels', 1, 'M', 'Oro Amarillo', 175.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Angels_26.png', 2, '2023-05-17 19:41:48'),
(52, 'Anillo Triangulo', 1, 'M', 'Oro Verde', 550.00, 10, 0, 0, 'Anillo de Oro de 24 Kilates', 'Anillo_Triangulo_10.png', 2, '2023-05-17 19:44:38'),
(53, 'Anillo Cesar', 1, 'L', 'Oro Amarillo', 175.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Cesar_82.png', 2, '2023-05-17 19:47:05'),
(54, 'Anillo Boucheron', 1, 'L', 'Oro Blanco', 250.00, 10, 0, 0, 'Anillo Oro 24 Kilates', 'Anillo_Boucheron_88.jpg', 2, '2023-05-17 19:49:29'),
(55, 'Pendientes Phoenix', 3, 'S', 'Oro Rosa', 150.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Phoenix_31.png', 2, '2023-05-17 19:51:10'),
(56, 'Pendientes Sara', 3, 'S', 'Oro Amarillo', 225.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Sara_78.jpg', 2, '2023-05-17 19:52:58'),
(57, 'Pendientes Espiga', 3, 'S', 'Oro Amarillo', 225.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Espiga_61.jpg', 2, '2023-05-17 19:53:17'),
(58, 'Pendientes Calados', 3, 'S', 'Oro Amarillo', 200.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Calados_55.jpg', 2, '2023-05-17 19:54:07'),
(59, 'Pendientes Greek', 3, 'S', 'Oro Amarillo', 250.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Greek_95.jpg', 2, '2023-05-17 19:55:31'),
(60, 'Pendientes Medusa', 3, 'S', 'Oro Amarillo', 225.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Medusa_94.jpg', 2, '2023-05-17 19:57:16'),
(61, 'Pendientes Kromo', 3, 'S', 'Oro Amarillo', 300.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Kromo_62.jpg', 2, '2023-05-17 19:57:43'),
(62, 'Pendientes Erizo', 3, 'S', 'Oro Amarillo', 315.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Erizo_78.jpg', 2, '2023-05-17 19:58:09'),
(63, 'Pendientes Flecha', 3, 'S', 'Oro Amarillo', 200.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Flecha_67.jpg', 2, '2023-05-17 19:58:39'),
(64, 'Pendientes Martelé', 3, 'S', 'Oro Amarillo', 200.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Martelé_3.jpg', 2, '2023-05-17 19:58:56'),
(65, 'Pendientes Pan de Oro', 3, 'S', 'Oro Amarillo', 225.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Pan_de_Oro_4.jpg', 2, '2023-05-17 20:01:45'),
(66, 'Pendientes Pétalos', 3, 'S', 'Oro Amarillo', 325.00, 10, 1, 9, 'Pendientes Oro 24 Kilates', 'Pendientes_Pétalos_32.jpg', 2, '2023-05-17 20:04:31'),
(67, 'Pendientes Retazos', 3, 'S', 'Oro Amarillo', 250.00, 10, 0, 0, 'Pendientes Oro 24 Kilates', 'Pendientes_Retazos_47.jpg', 2, '2023-05-17 20:05:00'),
(68, 'Collar Lagarto', 2, 'L', 'Oro Amarillo', 350.00, 10, 1, 9, 'Collar de Oro de 24 Kilate', 'Collar_Lagarto_25.jpg', 2, '2023-05-18 19:52:12'),
(69, 'Collar Estela', 2, 'L', 'Oro Amarillo', 300.00, 10, 0, 0, 'Collar de Oro de 24 Kilate', 'Collar_Estela_88.jpg', 2, '2023-05-18 19:52:39'),
(70, 'Collar Vinitage', 2, 'L', 'Oro Amarillo', 325.00, 10, 0, 0, 'Collar de Oro de 24 Kilate', 'Collar_Vinitage_17.jpg', 2, '2023-05-18 19:53:06'),
(71, 'Collar Fruto', 2, 'L', 'Oro Amarillo', 500.00, 10, 0, 0, 'Collar de Oro de 24 Kilate', 'Collar_Fruto_98.jpg', 2, '2023-05-18 19:53:44'),
(72, 'Collar Egipto', 2, 'L', 'Oro Amarillo', 300.00, 10, 1, 9, 'Collar de Oro de 24 Kilate', 'Collar_Cadena_47.jpg', 2, '2023-05-18 19:54:14'),
(73, 'Collar Cadena', 2, 'M', 'Oro Amarillo', 300.00, 10, 0, 0, 'Collar de oro de 24 Kilates', 'Collar_Cadena_41.jpg', 2, '2023-05-18 19:58:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedido`
--

CREATE TABLE `productos_pedido` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `size` varchar(30) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos_pedido`
--

INSERT INTO `productos_pedido` (`id`, `order_id`, `product_id`, `name`, `size`, `color`, `quantity`) VALUES
(71, 61, 18, 'Collar Cilindros', 'L', 'Oro', 1),
(72, 62, 17, 'Collar Granos', 'L', 'Oro', 1),
(82, 70, 21, 'Pendientes Cangrejo', 'M', 'Oro', 1),
(91, 79, 15, 'Anillo Piramide', 'L', 'Oro', 1),
(93, 81, 18, 'Collar Cilindros', 'L', 'Oro', 1),
(94, 82, 14, 'Anillo Cahchi', 'M', 'Oro', 1),
(95, 83, 19, 'Collar Módulos', 'M', 'Oro', 1),
(96, 84, 20, 'Pendientes Plumas', 'M', 'Oro', 1),
(97, 85, 22, 'Pulsera Mecano', 'M', 'Oro', 1),
(98, 86, 18, 'Collar Cilindros', 'L', 'Oro', 1),
(99, 87, 20, 'Pendientes Plumas', 'M', 'Oro', 1),
(100, 88, 18, 'Collar Cilindros', 'L', 'Oro', 1),
(101, 89, 14, 'Anillo Cahchi', 'M', 'Oro', 1),
(102, 90, 16, 'Anillo Canal', 'M', 'Oro', 1),
(103, 91, 14, 'Anillo Cahchi', 'M', 'Oro', 1),
(104, 92, 15, 'Anillo Piramide', 'L', 'Oro', 1),
(105, 93, 19, 'Collar Módulos', 'M', 'Oro', 1),
(115, 103, 22, 'Pulsera Mecano', 'M', 'Oro', 1),
(116, 104, 16, 'Anillo Canal', 'M', 'Oro', 1),
(117, 105, 15, 'Anillo Piramide', 'L', 'Oro', 1),
(118, 106, 14, 'Anillo Cahchi', 'M', 'Oro', 1),
(119, 107, 20, 'Pendientes Plumas', 'M', 'Oro', 1),
(120, 107, 15, 'Anillo Piramide', 'L', 'Oro', 2),
(121, 107, 16, 'Anillo Canal', 'M', 'Oro', 1),
(122, 107, 22, 'Pulsera Mecano', 'M', 'Oro', 1),
(131, 108, 44, 'Anillo Lapilázuri', 'M', 'Oro Amarillo', 1),
(132, 109, 72, 'Collar Egipto', 'L', 'Oro Amarillo', 1),
(133, 110, 68, 'Collar Lagarto', 'L', 'Oro Amarillo', 1),
(134, 111, 32, 'Pulsera Cesar', 'M', 'Oro Amarillo', 1),
(135, 112, 66, 'Pendientes Pétalos', 'S', 'Oro Amarillo', 1),
(136, 113, 21, 'Pendientes Cangrejo', 'M', 'Oro', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `lastname2` varchar(30) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `username`, `email`, `password`, `role`, `firstname`, `lastname`, `lastname2`, `phone`, `address`, `created_at`) VALUES
(2, 'BorAdmin', 'brainwash.bv@gmail.com', '$2y$10$vCcXYx9a0AE.Sc1u1RxODOvLxmxgPiS1mIPkMV.7ASwxGJcX2bbTi', 'Administrador', 'Borja', 'Vidal', 'Cormenzana', '677886699', 'C/Gardenias, 3', '2023-05-10 16:15:22'),
(29, 'peter', 'pedro@gmail.com', '$2y$10$/Ducrpa3hngWAV9r.Yn/4eAyjgDBiaOFXnquy/RAGA6styT2YfV3i', 'Cliente', 'Pedro', 'Lopez', 'Sanz', '687659978', 'C/Gardenias, 19', '2023-05-12 18:15:29'),
(33, 'amaya', 'braopop.bv@gmail.com', '$2y$10$PLldm05n.ihaX2LfEt2hR.nsEUZ5VxiZDJjNZDNMd.27c.9aM0.wu', 'Cliente', 'Sanchez', 'Vidal', 'Marquez', '679865632', 'C/Petunias,Móstoles', '2023-05-14 22:27:17'),
(34, 'borja', 'brainwash23.bv@gmail.com', '$2y$10$Mr9E90QV6gR/MdS7COlNTeqqiWTZFr4R/LsyAjAOyU4UjV.nrfxM.', 'Cliente', 'Borja', 'Vidal', 'Cormenzana', '678560697', 'C/Camelias, 3', '2023-05-16 09:49:10');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_administrador`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`),
  ADD UNIQUE KEY `categoria_nombre` (`categoria_nombre`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `productos_pedido`
--
ALTER TABLE `productos_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `productos_pedido`
--
ALTER TABLE `productos_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos_pedido`
--
ALTER TABLE `productos_pedido`
  ADD CONSTRAINT `productos_pedido_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
