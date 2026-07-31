-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2026 a las 05:36:18
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
-- Base de datos: `novamart`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_usuario`, `id_producto`, `cantidad`) VALUES
(5, 1, 3, 6),
(6, 1, 13, 4),
(7, 1, 11, 3),
(8, 1, 4, 1),
(9, 1, 6, 1),
(10, 1, 15, 1),
(11, 1, 30, 1),
(12, 1, 17, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Abarrotes', NULL),
(2, 'Lacteos', NULL),
(3, 'Bebidas', NULL),
(4, 'Limpieza', NULL),
(5, 'Botanas', NULL),
(6, 'Enlatados', NULL),
(7, 'Cuidado personal', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 1, 3, 3, 32.00, 96.00),
(2, 1, 11, 1, 28.00, 28.00),
(3, 1, 13, 1, 30.00, 30.00),
(4, 1, 17, 1, 35.00, 35.00),
(5, 2, 3, 2, 32.00, 64.00),
(6, 2, 17, 2, 35.00, 70.00),
(7, 2, 11, 1, 28.00, 28.00),
(8, 2, 13, 1, 30.00, 30.00),
(9, 2, 20, 1, 32.00, 32.00),
(10, 2, 23, 1, 39.00, 39.00),
(11, 2, 9, 1, 10.00, 10.00),
(12, 3, 3, 1, 32.00, 32.00),
(13, 3, 11, 1, 28.00, 28.00),
(14, 4, 3, 1, 32.00, 32.00),
(15, 4, 13, 1, 30.00, 30.00),
(16, 4, 19, 1, 37.00, 37.00),
(17, 4, 17, 1, 35.00, 35.00),
(18, 5, 3, 1, 32.00, 32.00),
(19, 5, 11, 1, 28.00, 28.00),
(20, 6, 18, 1, 89.90, 0.00),
(21, 7, 2, 2, 63.50, 0.00),
(22, 8, 28, 2, 50.00, 0.00),
(23, 9, 19, 2, 37.00, 0.00),
(24, 10, 21, 1, 48.50, 0.00),
(25, 10, 25, 1, 58.00, 0.00),
(26, 11, 3, 1, 32.00, 0.00),
(27, 11, 5, 1, 63.00, 0.00),
(28, 12, 14, 2, 32.00, 0.00),
(29, 13, 29, 1, 45.00, 0.00),
(30, 14, 7, 1, 48.50, 0.00),
(31, 14, 19, 1, 37.00, 0.00),
(32, 15, 26, 1, 14.50, 0.00),
(33, 15, 27, 1, 23.50, 0.00),
(34, 15, 4, 1, 19.00, 0.00),
(35, 15, 10, 2, 25.00, 0.00),
(36, 16, 11, 1, 28.00, 28.00),
(37, 16, 3, 1, 32.00, 32.00),
(38, 16, 13, 1, 30.00, 30.00),
(39, 16, 19, 1, 37.00, 37.00),
(40, 16, 17, 1, 35.00, 35.00),
(41, 16, 14, 1, 32.00, 32.00),
(42, 16, 29, 1, 45.00, 45.00),
(43, 16, 30, 1, 40.00, 40.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `metodo` enum('Tarjeta','Efectivo','Transferencia') DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_pago` datetime DEFAULT current_timestamp(),
  `estado` enum('Pendiente','Aprobado','Rechazado') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` enum('Pendiente','Pagado','Enviado','Entregado','Cancelado') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `fecha`, `total`, `estado`) VALUES
(1, 1, '2026-07-26 01:22:50', 189.00, 'Pendiente'),
(2, 7, '2026-07-26 02:14:44', 273.00, 'Pendiente'),
(3, 6, '2026-07-26 04:22:30', 60.00, 'Pendiente'),
(4, 6, '2026-07-26 04:25:07', 134.00, 'Pendiente'),
(5, 6, '2026-07-26 04:40:12', 110.00, 'Pendiente'),
(6, 1, '2026-07-27 10:15:00', 89.90, 'Pendiente'),
(7, 7, '2026-07-27 11:30:22', 127.00, 'Pendiente'),
(8, 6, '2026-07-28 09:05:10', 100.00, 'Pendiente'),
(9, 1, '2026-07-28 14:20:45', 74.00, 'Pendiente'),
(10, 7, '2026-07-28 18:00:12', 116.00, 'Pendiente'),
(11, 6, '2026-07-29 08:45:30', 97.00, 'Pendiente'),
(12, 1, '2026-07-29 12:10:00', 64.00, 'Pendiente'),
(13, 7, '2026-07-29 16:50:18', 45.00, 'Pendiente'),
(14, 6, '2026-07-30 11:05:40', 85.00, 'Pendiente'),
(15, 1, '2026-07-30 15:30:00', 123.50, 'Pendiente'),
(16, 6, '2026-07-31 02:18:08', 279.00, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `id_categoria`) VALUES
(1, 'Leche Alpura 1L', 'Leche Alpura clásica es fundamental en tu despensa.', 22.00, 100, 'imgleche.png', 2),
(2, 'Queso Panela', ' - Queso en rebanadas - Elaborado con 100% leche de vaca', 63.50, 30, 'QuesoP.webp', 2),
(3, 'Aceite 1L', 'Aceite 100% de Pura Canola', 32.00, 40, 'Aceite.webp', 1),
(4, 'Flemin\'Hot', 'Cheetos Flamin Hot 240g', 19.00, 100, 'Chetos Flamin Hot.webp', 5),
(5, 'Cacahuates Japoneses', 'Karate® Cacahuate Japonés, es una botana de cacahuates que te ofrece un sabor clásico', 63.00, 25, 'CacahuatesJ.webp', 5),
(6, 'Fuze_Tea 600ml', 'Comienza tu día con el delicioso y refrescante sabor del té negro Fuze Tea sabor durazno, libre de conservadores con antioxidantes y teína.', 20.00, 60, 'Fuze Tea.webp', 3),
(7, 'Queso Oaxaca', '¡Haz que tu próxima receta sea aún más rica con el queso oaxaca Alpura!', 48.50, 20, 'QuesoOa.webp', 2),
(8, 'Mantequilla', 'Mantequilla Alpura Pasteurizada sin sal es tu mejor aliado en la cocina para tus recetas', 35.00, 35, 'Mantequilla.webp', 2),
(9, 'Jugo Boing uva 125ml', 'Boing Uva, te ofrece el mejor balance de sabor ya que está elaborado con pulpa de fruta', 10.00, 80, 'BoingUC.webp', 3),
(10, 'Salsa_Valentina 370ml', 'Salsa picante etiqueta amarilla 350 ml', 25.00, 45, 'Salsa Valentina.webp', 5),
(11, 'Catsup 608g', 'Salsa cátsup Clemente Jacques 680 g. Ideal para darle un sabor diferente a tus platillos', 28.00, 30, 'Catsu.webp', 1),
(12, 'Jugo Boing uva 500ml', 'Boing Uva Fortificado con hierro y calcio', 17.00, 50, 'BoingUG.webp', 3),
(13, 'Mayonesa_McCormick 430g', 'Con más del 60% de Aceite de Soya para que sea una Mayonesa auténtica', 30.00, 40, 'mayonesa.webp', 1),
(14, 'Pan_Bimbo_Blanco 680g', 'Pan Blanco Bimbo es una opción ideal para preparar un sándwich en cualquier momento del día', 32.00, 25, 'Pan Bimbo.webp', 1),
(15, 'Jugo Boing Mango 500ml', 'Ideal para acompañar tus comidas\r\nGran sabor\r\nRefrescante\r\nBoing Mango, te ofrece el mejor balance de sabor ya que está elaborado con pulpa de fruta, traído directo de los campos mexicanos, es súper refrescante y delicioso, además cuenta con envasado aséptico que permite mantener su frescura.\r\n- Fortificado con hierro y calcio\r\n- Con vitaminas A, B1 y C Haz tu súper, prográmalo y recíbelo en casa o recógelo en tienda, es seguro y muy sencillo, además contamos con diversas formas de pago para tu comodidad.', 17.00, 50, 'BoingMag.webp', 3),
(16, 'Fanta Lata 500ml', 'Refresco frutal sabor naranja, intenso y divertido Ideal para una tarde con amigos o para acompañar tus snacks favoritos Tómala bien fría', 22.00, 60, 'FantaLat.webp', 3),
(17, 'Pan_Bimbo_Integral 620g', 'Pan Blanco Bimbo es una opción ideal para preparar un sándwich en cualquier momento del día', 35.00, 20, 'Pan Bimbo Integral.webp', 1),
(18, 'Jabon Bold 5k', 'BOLD 3 \"Cariñitos de Mamá\" Es la fórmula completa con Softech con micro agentes que potencializan la suavidad en los tejidos.', 89.90, 15, 'JabonBoltG.webp', 4),
(19, 'Arroz 1kg', 'Consiga un arroz más blanco, entero y esponjadito con el arroz súper extra Verde Valle', 37.00, 50, 'Arroz.webp', 1),
(20, 'Frijol 1kg', 'Verde Valle tiene para ti una bolsa de frijol peruano, ideal para que acompañes tus comidas con esta deliciosa guarnición.', 32.00, 50, 'Frijol V..webp', 1),
(21, 'Jabon Bold 850g', 'BOLD 3 \"Cariñitos de Mamá\" Es la fórmula completa con Softech con micro agentes que potencializan la suavidad en los tejidos.', 48.50, 30, 'JabonBoltC.webp', 4),
(22, 'Spaghuetti 450g', 'Spaghetti La Moderna de 450 g con sémola de trigo durum.', 30.50, 40, 'Spaghuetti.webp', 1),
(23, 'Sal Natural', 'Sal refinada de mesa', 39.00, 50, 'Sal Salada.webp', 1),
(24, 'Jabon ACE 250g', 'PARA TODO TIPO DE ROPA: puedes utilizar el detergente Ace en todos tus lavados.', 38.90, 30, 'JabonACE.webp', 4),
(25, 'Chiles Chipotle 330g', 'Los deliciosos chiles chipotles adobados de La Costeña son el mejor acompañamiento de tus platillos favoritos.', 58.00, 25, 'Chiles Chipotle.webp', 6),
(26, 'Jabon Zote 400g', 'Jabón de lavandería en barra', 14.50, 60, 'Jabon Zote.webp', 4),
(27, 'Cloro 950ml', 'Blanqueador y desinfectante', 23.50, 40, 'Cloro.webp', 4),
(28, 'Zucaritas 500g', 'Cereal de maíz azucarado', 50.00, 20, 'Zucaritas.webp', 1),
(29, 'Cereal Trix 430g', 'Cereal de maíz sabor frutas', 45.00, 20, 'CerealTrix.webp', 1),
(30, 'Cereal Choco 350g', 'Cereal sabor chocolate', 40.00, 20, 'CerealChoco.webp', 1),
(31, 'Atun Dolores', 'Atún en lata', 15.00, 70, 'Atun.webp', 6),
(32, 'Sal Natural', 'En tu despensa básica no puede faltar la sal de mesa, es el ingrediente que te ayudará a resaltar el sabor de tus recetas de comida mexicana', 39.00, 50, 'Sal Salada.webp', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'Administrador'),
(3, 'Cliente'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) DEFAULT NULL,
  `apellido_materno` varchar(100) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo`, `usuario`, `password`, `telefono`, `fecha_registro`, `id_rol`) VALUES
(1, 'REINHARD', 'ARROYO', 'BETANCOURT', 'rei_uri@hotmail.com', 'URIEL', '$2y$10$Lyy.E9LkuAknJuM8liMfLO8U8euQYHtASFaxUoY0NUt9OgYXSct/W', '7775240330', '2026-07-24 02:40:32', 1),
(5, 'pedro', 'gonzales', 'Giles', 'pedro@gmail.com', 'PedroP', '$2y$10$LXk8fhbWW9k8E9nT9WVFo.tWMChcsG2y3gT2XkJWnG6bH0/DxDIry', '67878668687', '2026-07-24 17:24:00', 2),
(6, 'Aldo', 'Martinez', 'Giles', 'martinezgilesuriel@gmail.com', 'Aldo', '$2y$10$j3L5B5tKyBj0QDxHbDkAG.Dez/iXlgsf0ZVmR8BuYQ/gNa/XH18lG', '123456778', '2026-07-24 18:14:32', 1),
(7, 'Naomi', 'Mendez', 'Valdez', 'nm5499366@gmail.com', 'NaomiMV', '$2y$10$rlKcZna98EADoVeuH0Ttp.2p3/VJ.m/ZTozpCHOTB.Dm87VsqgwDC', '7341883657', '2026-07-26 00:07:30', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
