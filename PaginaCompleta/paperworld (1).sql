-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2024 at 03:43 PM
-- Server version: 8.0.39-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paperworld`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL,
  `nombre_c` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_c`, `descripcion`) VALUES
(1, 'Papeleria', 'Productos de Papeleria');

-- --------------------------------------------------------

--
-- Table structure for table `inventariado_proveedor`
--

CREATE TABLE `inventariado_proveedor` (
  `id_inv` int NOT NULL,
  `id_producto` int DEFAULT NULL,
  `id_proveedor` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `cantidad_comprada` int NOT NULL,
  `precio_U` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventariado_proveedor`
--

INSERT INTO `inventariado_proveedor` (`id_inv`, `id_producto`, `id_proveedor`, `id_usuario`, `cantidad_comprada`, `precio_U`) VALUES
(1, 1, 2, 3, 50, 150),
(2, 2, 1, 1, 30, 200),
(3, 3, 4, 2, 100, 50),
(4, 4, 3, 5, 75, 300),
(5, 5, 2, 4, 60, 120),
(6, 6, 1, 6, 90, 80),
(7, 7, 3, 7, 200, 500),
(8, 8, 4, 9, 40, 75),
(9, 9, 2, 10, 110, 250),
(10, 10, 1, 8, 25, 60);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int NOT NULL,
  `nombre_p` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_p` int NOT NULL,
  `precio_p` decimal(15,2) NOT NULL,
  `porcentaje_iva` decimal(15,2) DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  `estado` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_p`, `cantidad_p`, `precio_p`, `porcentaje_iva`, `id_categoria`, `estado`) VALUES
(1, 'Lápiz', 100, 5.00, 0.16, 1, 'Activo'),
(2, 'Cuaderno', 12, 20.00, 0.16, 1, 'Activo'),
(3, 'Teclado', 30, 150.00, 0.16, 2, 'Activo'),
(4, 'Silla', 20, 300.00, 0.16, 6, 'Activo'),
(5, 'Mouse', 45, 80.00, 0.16, 7, 'Activo'),
(6, 'Impresora', 10, 500.00, 0.16, 7, 'Activo'),
(7, 'Escritorio', 25, 1000.00, 0.16, 6, 'Activo'),
(8, 'Botella de Agua', 60, 15.00, 0.16, 8, 'Activo'),
(9, 'Agenda', 40, 50.00, 0.16, 1, 'Activo'),
(10, 'Marcador', 70, 10.00, 0.16, 1, 'Activo');

-- --------------------------------------------------------

--
-- Table structure for table `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int NOT NULL,
  `nombre_proveedor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion_proveedor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_proveedor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_proveedor` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `direccion_proveedor`, `telefono_proveedor`, `correo_proveedor`) VALUES
(1, 'ProveePapeleria', 'Calle A, Edificio 1', '555-1010', 'proveedor1@ej.com'),
(2, 'TechSupply', 'Calle B, Edificio 2', '555-2020', 'proveedor2@ej.com'),
(3, 'OfficePlus', 'Calle C, Edificio 3', '555-3030', 'proveedor3@ej.com'),
(4, 'EscolarMania', 'Calle D, Edificio 4', '555-4040', 'proveedor4@ej.com'),
(5, 'CleanCo', 'Calle E, Edificio 5', '555-5050', 'proveedor5@ej.com'),
(6, 'MobiMart', 'Calle F, Edificio 6', '555-6060', 'proveedor6@ej.com'),
(7, 'CompAcces', 'Calle G, Edificio 7', '555-7070', 'proveedor7@ej.com'),
(8, 'SnackWorld', 'Calle H, Edificio 8', '555-8080', 'proveedor8@ej.com'),
(9, 'DecoraHome', 'Calle I, Edificio 9', '555-9090', 'proveedor9@ej.com'),
(10, 'ExtraServices', 'Calle J, Edificio 10', '555-1111', 'proveedor10@ej.com');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `Username_U` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nombre_U` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Apellidos_U` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contraseña` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Direccion_U` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Telefono_U` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Correo` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Rol` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `Username_U`, `Nombre_U`, `Apellidos_U`, `Contraseña`, `Direccion_U`, `Telefono_U`, `Correo`, `Rol`) VALUES
(1, 'aldop', 'Alfredo', 'Petul', 'Aldo590', 'Calle 1', '+52 986 107 7365', 'aldopetul@gmail.com', 'admin'),
(2, 'asmith', 'Anna', 'Smith', 'pass5678', 'Calle 2', '555-5678', 'anna@example.com', 'empleado'),
(3, 'bmiller', 'Bob', 'Miller', 'pass9101', 'Calle 3', '555-9101', 'bob@example.com', 'usuario'),
(4, 'cwhite', 'Carol', 'White', 'pass1123', 'Calle 4', '555-1123', 'carol@example.com', 'admin'),
(5, 'dgreen', 'Dan', 'Green', 'pass1415', 'Calle 5', '555-1415', 'dan@example.com', 'empleado'),
(6, 'eblack', 'Eve', 'Black', 'pass1617', 'Calle 6', '555-1617', 'eve@example.com', 'usuario'),
(7, 'fstone', 'Frank', 'Stone', 'pass1819', 'Calle 7', '555-1819', 'frank@example.com', 'admin'),
(8, 'gonzalez', 'Grace', 'Gonzalez', 'pass2021', 'Calle 8', '555-2021', 'grace@example.com', 'empleado'),
(12, 'joshz', 'jose', 'perez', 'joseper1', '10 X 9 Y 7 S/N', '5928916181', 'joseperez@gmail.com', 'usuario'),
(16, 'josehr', 'jose', 'perez', 'josepe12', '10 X 9 Y 7 S/N', '5928916181', 'joseperez@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id_venta` int NOT NULL,
  `id_producto` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `cantidad` int NOT NULL,
  `precio_U` decimal(15,2) NOT NULL,
  `descuento` decimal(15,2) DEFAULT NULL,
  `total_pago` decimal(15,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `venta`
--

INSERT INTO `venta` (`id_venta`, `id_producto`, `id_usuario`, `cantidad`, `precio_U`, `descuento`, `total_pago`) VALUES
(1, 1, 3, 5, 150.00, 0.00, 750.00),
(2, 2, 4, 10, 200.00, 10.00, 1900.00),
(3, 3, 1, 3, 50.00, 5.00, 140.00),
(4, 4, 2, 8, 300.00, 15.00, 2285.00),
(5, 5, 5, 7, 120.00, 0.00, 840.00),
(6, 6, 6, 12, 80.00, 2.00, 946.00),
(7, 7, 7, 6, 500.00, 20.00, 2980.00),
(8, 8, 8, 4, 75.00, 0.00, 300.00),
(9, 9, 9, 9, 250.00, 25.00, 2200.00),
(10, 10, 10, 2, 60.00, 0.00, 120.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `inventariado_proveedor`
--
ALTER TABLE `inventariado_proveedor`
  ADD PRIMARY KEY (`id_inv`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventariado_proveedor`
--
ALTER TABLE `inventariado_proveedor`
  MODIFY `id_inv` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
