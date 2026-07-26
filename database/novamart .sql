-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2026 a las 05:38:22
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
(19, 5, 11, 1, 28.00, 28.00);

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
(5, 6, '2026-07-26 04:40:12', 110.00, 'Pendiente');

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
(1, 'Leche Alpura 1L', '-Fuente de proteína\r\n-Ideal para una alimentación balanceada\r\n-Delicioso sabor\r\nLa leche Alpura clásica es fundamental en tu despensa ya que contiene proteína propia de la leche que te da la energía para comenzar tu día y que ayuda al desarrollo de músculos.\r\n-Fuente de calcio \r\n-Contiene vitaminas A y D -100% leche de vaca -Parcialmente descremada y ultrapasteurizada Manténgase en un lugar fresco y seco, no necesita refrigeración hasta abrirse. ', 22.00, 100, 'imgleche.png', 2),
(2, 'Queso Panela', 'Fuente de proteína\r\nIdeal para una comida balanceada\r\nPerfecta para la preparación de Ensaladas, Colaciones y Snacks.\r\nAgrega a tus comidas el queso panela Zwan y disfruta de su sabor.\r\n- Queso en rebanadas - Elaborado con 100% leche de vaca\r\n- Textura cremosa Busca todo lo que necesites para completar la despensa de tu hogar en nuestra tienda en línea y disfruta de hacer tus compras por internet con tan sólo unos cuantos clics. ¡Ya contamos con servicio a domicilio!', 63.50, 30, 'QuesoP.webp', 2),
(3, 'Aceite 1L', 'Aceite 100% de Pura Canola\r\nResiste altas temperaturas\r\nConserva el sabor íntegro de tus alimentos\r\nContiene omegas 6 y 9\r\nBotella hecha con plástico 100% reciclado\r\nSumérgete en la experiencia culinaria definitiva con el Aceite Puro de Canola Capullo. \r\n\r\n', 32.00, 40, 'Aceite.webp', 1),
(4, 'Flemin\'Hot', 'Cheetos Flamin Hot 240g', 19.00, 100, 'Chetos Flamin Hot.webp', 5),
(5, 'Cacahuates Japoneses', 'Textura crujiente\r\nEmpaque abre fácil\r\nIdeal para consumir en el camino\r\nKarate® Cacahuate Japonés, es una botana de cacahuates que te ofrece un sabor clásico, son una opción practica para cualquier momento de día, ideal para saciar el hambre. \r\n- Fuente práctica de energía. \r\n- Disfrútalos solo o comparte con familia y amigos. \r\n- Puedes acompañarlos con salsas o disfrutarlos solos.', 63.00, 25, 'CacahuatesJ.webp', 5),
(6, 'Fuze_Tea 600ml', 'Con ingredientes de origen natural Para beber en cualquier momento Disfruta de su único sabor\r\nDisfrútalo en cualquier ocasión\r\nIdeal para acompañar tus comidas\r\nComienza tu día con el delicioso y refrescante sabor del té negro Fuze Tea sabor durazno, libre de conservadores con antioxidantes y teína.\r\n-Un toque de frutas que le dan ese sabor natural y especial que siempre has buscado. ', 20.00, 60, 'Fuze Tea.webp', 3),
(7, 'Queso Oaxaca', '100% de leche.\r\nPara deshebrar.\r\nQueso que derrite.\r\nFuente de proteína.\r\n-¡Haz que tu próxima receta sea aún más rica con el queso oaxaca Alpura!\r\n-Puedes preparar deliciosos platillos de la gastronomía mexicana, desde unas quesadillas hasta platillos más exquisitos.\r\n-Su textura suave y sabor irresistible son perfectos para deshebrar, derretir, rellenar o gratinar.', 48.50, 20, 'QuesoOa.webp', 2),
(8, 'Mantequilla', 'Hecha con 100% Leche de vaca\r\nCremosidad\r\nFácil de usar\r\nMantequilla Alpura Pasteurizada sin sal es tu mejor aliado en la cocina para tus recetas, gracias a su sabor y cremosidad inigualables llevarán tus platillos a otro nivel.\r\n-Perfecta para acompañar tus desayunos. -Gran consistencia y fácil de untar. ¡Mantequilla Alpura para ese toque especial! Recuerda que todo lo que necesites lo encontrarás disponible en tu tienda en línea donde contamos con servicio a domicilio y ofertas especiales para consentirte.', 35.00, 35, 'Mantequilla.webp', 2),
(9, 'Jugo Boing uva 125ml', 'Un indispensable para tu hogar\r\nRefrescante\r\nDelicioso sabor\r\nBoing Uva, te ofrece el mejor balance de sabor ya que está elaborado con pulpa de fruta, traído directo de los campos mexicanos, es súper refrescante y delicioso, además cuenta con envasado aséptico que permite mantener su frescura.\r\n- Fortificado con hierro y calcio\r\n- Con vitaminas A, B1 y C ', 10.00, 80, 'BoingUC.webp', 3),
(10, 'Salsa_Valentina 370ml', 'Combina con una gran variedad de alimentos para realzar su sabor\r\nIdeal para agregar un toque picosito a tus platillos\r\nElemento esencial en cualquier cocina\r\nSalsa picante etiqueta amarilla 350 ml. ¡Navega por nuestra página de internet y lleva a casa todo lo que necesitas de tu despensa básica! Recuerda que para tu comodidad ya contamos con servicio de entregas a domicilio.', 25.00, 45, 'Salsa Valentina.webp', 5),
(11, 'Catsup 608g', 'Versátil\r\nIdeal para darle un sabor diferente a tus platillos\r\nConsiente a familia y amigos con su sabor\r\nAgrégalos a tu lista del súper\r\nSalsa cátsup Clemente Jacques 680 g. Surte tu despensa básica del hogar en la tienda en línea y disfruta la variedad de productos de nuestro catálogo de abarrotes que te ofrecemos a precios bajos todos los días.', 28.00, 30, 'Catsu.webp', 1),
(12, 'Jugo Boing uva 500ml', 'Un indispensable para tu hogar\r\nRefrescante\r\nDelicioso sabor\r\nBoing Uva, te ofrece el mejor balance de sabor ya que está elaborado con pulpa de fruta, traído directo de los campos mexicanos, es súper refrescante y delicioso, además cuenta con envasado aséptico que permite mantener su frescura.\r\n- Fortificado con hierro y calcio\r\n- Con vitaminas A, B1 y C ', 17.00, 50, 'BoingUG.webp', 3),
(13, 'Mayonesa_McCormick 430g', 'Con más del 60% de Aceite de Soya para que sea una Mayonesa auténtica\r\nAdicionada con Omega 3 y vitamina E\r\nCon jugo de limones para lograr su sabor único\r\n¡Póngale lo sabroso! La favorita de todos gracias a su irresistible sabor, la Mayonesa McCormick es perfecta por su toque exacto de limón. Ponle lo sabroso y dale ese extra de sabor a tus desayunos, comidas y cenas.\r\n- Consistencia cremosa como ninguna otra.\r\n', 30.00, 40, 'mayonesa.webp', 1),
(14, 'Pan_Bimbo_Blanco 680g', 'Delicioso sabor\r\nSuave\r\nPracticidad\r\nPan Blanco Bimbo es una opción ideal para preparar un sándwich en cualquier momento del día, puedes combinarlo con tus ingredientes favoritos y así disfrutar de tus diferentes recetas y creaciones únicas. Ahora con una rebanada más grande y corteza brillada. ', 32.00, 25, 'Pan Bimbo.webp', 1),
(15, 'Jugo Boing Mango 500ml', 'Ideal para acompañar tus comidas\r\nGran sabor\r\nRefrescante\r\nBoing Mango, te ofrece el mejor balance de sabor ya que está elaborado con pulpa de fruta, traído directo de los campos mexicanos, es súper refrescante y delicioso, además cuenta con envasado aséptico que permite mantener su frescura.\r\n- Fortificado con hierro y calcio\r\n- Con vitaminas A, B1 y C Haz tu súper, prográmalo y recíbelo en casa o recógelo en tienda, es seguro y muy sencillo, además contamos con diversas formas de pago para tu comodidad.', 17.00, 50, 'BoingMag.webp', 3),
(16, 'Fanta Lata 500ml', 'Refresco frutal sabor naranja, intenso y divertido Ideal para una tarde con amigos o para acompañar tus snacks favoritos Tómala bien fría\r\nDisfrútala bien fría\r\nIdeal para acompañar tus comidas\r\nEl divertido, intenso y frutal sabor de Fanta que ya conoces en sabor naranja con burbujas que lo hacen una bebida ideal para disfrutar en la comida o en cualquier otro momento. Complementa tu despensa con este refresco si deseas conquistar el paladar de tus invitados en diferentes reuniones.', 22.00, 60, 'FantaLat.webp', 3),
(17, 'Pan_Bimbo_Integral 620g', 'Mejor digestión\r\n23 rebanadas\r\nDelicioso\r\nDelicioso pan integral Bimbo, ahora con una nueva receta, rebandas más grandes y suaves. - Hecho de granos enteros es mas que solo fibra. \r\n- Una opción para consentir a tu familia con un delicioso desayuno o para una practica cena.\r\n', 35.00, 20, 'Pan Bimbo Integral.webp', 1),
(18, 'Jabon Bold 5k', 'Su fórmula en polvo de rápida disolución penetra los hilos removiendo la mugre incrustada.\r\nAyuda a desprender manchas difíciles de grasa y tierra cuidando el tejido textil.\r\nMantiene la vivacidad de los colores y la pureza de los blancos sin dañar las fibras.\r\nBOLD 3 \"Cariñitos de Mamá\" Es la fórmula completa con Softech con micro agentes que potencializan la suavidad en los tejidos.\r\n- La ropa quedará extra suave por mucho más tiempo, con una limpieza profunda y aroma duradero\r\n- BOLD 3 lava la ropa sin dañar el medio ambiente gracias a que no contiene fosfatos \r\n', 89.90, 15, 'JabonBoltG.webp', 4),
(19, 'Arroz 1kg', 'Un básico en tu despensa\r\nIdeal para preparar de diversas maneras\r\nAcompañante perfecto para tus guisados\r\nConsiga un arroz más blanco, entero y esponjadito con el arroz súper extra Verde Valle. Prepárelo como usted prefiera y dele esa sazón especial. Es ideal para cualquier tipo de preparación. Le tomará muy pocos minutos prepararlo y tenerlo listo para deleitar su paladar. \r\n- Ideal para acompañar todo tipo de platillos\r\n', 37.00, 50, 'Arroz.webp', 1),
(20, 'Frijol 1kg', 'Un básico en tu despensa\r\nIdeal para acompañar tus guisados\r\nFuente de fibra\r\nVerde Valle tiene para ti una bolsa de frijol peruano, ideal para que acompañes tus comidas con esta deliciosa guarnición.\r\n-Fuente natural de proteína, fibra y ácido fólico\r\n-Bolsa de 750 g Encuentra la variedad de frijoles que tenemos para que disfrutes en la compañía de tu familia.', 32.00, 50, 'Frijol V..webp', 1),
(21, 'Jabon Bold 850g', 'Su fórmula en polvo de rápida disolución penetra los hilos removiendo la mugre incrustada.\r\nAyuda a desprender manchas difíciles de grasa y tierra cuidando el tejido textil.\r\nMantiene la vivacidad de los colores y la pureza de los blancos sin dañar las fibras.\r\nBOLD 3 \"Cariñitos de Mamá\" Es la fórmula completa con Softech con micro agentes que potencializan la suavidad en los tejidos.\r\n- La ropa quedará extra suave por mucho más tiempo, con una limpieza profunda y aroma duradero\r\n- BOLD 3 lava la ropa sin dañar el medio ambiente gracias a que no contiene fosfatos \r\n', 48.50, 30, 'JabonBoltC.webp', 4),
(22, 'Spaghuetti 450g', 'Spaghetti La Moderna de 450 g con sémola de trigo durum.\r\nAdicionado con vitaminas B1, B2, hierro y ácido fólico.\r\nTamaño ideal para parejas o porciones individuales.\r\nConoce nuestra tradicional pasta elaborada con auténtico trigo durum para crear platillos completos para toda tu familia con toda nuestra línea de productos y diferentes pastas que tenemos para ti. Producto versátil para todas las recetas que desees cocinar.\r\n', 30.50, 40, 'Spaghuetti.webp', 1),
(23, 'Sal Natural', 'Sal refinada de mesa', 39.00, 50, 'Sal Salada.webp', 1),
(24, 'Jabon ACE 250g', 'PARA TODO TIPO DE ROPA: puedes utilizar el detergente Ace en todos tus lavados. Su fórmula actúa en todo tipo de ropa, tanto blanca como de color, y sirve para lavar desde prendas usadas en el día a día hasta las que están más sucias\r\nMEJOR DISOLUCIÓN: Ace detergente ayuda evitar manchas de jabón visibles tras el lavado, esto se debe a su tecnología, que permite un enjuague fácil y sencillo, y una mejor disolución del polvo en contacto con el agua\r\nCUIDA DEL PLANETA: Se trata de un detergente libre de fosfatos añadidos en su fórmula\r\nAROMA LIMPIO Y FRESCO: El perfume del detergente Ace deja tu ropa con un aroma limpio y fresco de recién lavada !Ace lo hace!', 38.90, 30, 'JabonACE.webp', 4),
(25, 'Chiles Chipotle 330g', 'Sin Conservadores\r\nElaborado con una cuidadosa selección de chiles\r\nEl sabor picosito que buscas\r\nLos deliciosos chiles chipotles adobados de La Costeña son el mejor acompañamiento de tus platillos favoritos. ¡Consiente a tu familia y disfruta su rico e inigualable sabor picosito! \r\n- En adobo \r\n- Sin conservadores \r\n- Lata abre fácil ¡Recibe a domicilio todo lo que necesitas para tener en tu casa y consentir a los que más quieres, además elige entre nuestras diferentes formas de pago la que más te convenga! Todo lo que requieres para tener tu despensa siempre completa.', 58.00, 25, 'Chiles Chipotle.webp', 6),
(26, 'Jabon Zote 400g', 'Jabón de lavandería en barra', 14.50, 60, 'Jabon Zote.webp', 4),
(27, 'Cloro 950ml', 'Blanqueador y desinfectante', 23.50, 40, 'Cloro.webp', 4),
(28, 'Zucaritas 500g', 'Cereal de maíz azucarado', 50.00, 20, 'Zucaritas.webp', 1),
(29, 'Cereal Trix 430g', 'Cereal de maíz sabor frutas', 45.00, 20, 'CerealTrix.webp', 1),
(30, 'Cereal Choco 350g', 'Cereal sabor chocolate', 40.00, 20, 'CerealChoco.webp', 1),
(31, 'Atun Dolores', 'Atún en lata', 15.00, 70, 'Atun.webp', 6),
(32, 'Sal Natural', 'Mejora el sabor de tus platillos favoritos\r\nContiene propiedades naturales beneficiosas\r\nAporta nutrientes esenciales\r\nEn tu despensa básica no puede faltar la sal de mesa, es el ingrediente que te ayudará a resaltar el sabor de tus recetas de comida mexicana. Es por eso que tenemos para ti la sal de mesa La Fina refinada fluorada que tenemos en presentación de 1 kilo sal La Fina. Agrega con moderación a las salsas mexicanas que preparas y en esas recetas caseras que tanto le gustan a tu familia. Hacer compras en línea nunca había sido tan sencillo, agrega a tu carrito lo que necesites, ya que, con nuestro servicio de entregas a domicilio, tus productos llegarán hasta la puerta de tu hogar. Contamos con distintas formas de pago para que elijas la que más te convenga.', 39.00, 50, 'Sal Salada.webp', 1);

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
(5, 'pedro', 'gonzales', 'Giles', 'pedro@gmail.com', 'PedroP', '$2y$10$LXk8fhbWW9k8E9nT9WVFo.tWMChcsG2y3gT2XkJWnG6bH0/DxDIry', '67878668687', '2026-07-24 17:24:00', 3),
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
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
