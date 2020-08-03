-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-08-2020 a las 06:43:20
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `treda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_08_03_015545_create_store_table', 1),
(4, '2020_08_03_015559_create_product_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `sku`, `user_id`, `store_id`, `name`, `description`, `value`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'KYZEHOBL', 1, 1, 'Mariano', 'Duchess replied, in a tone of great relief.', 8495853, 'https://lorempixel.com/60/48/cats/?64032', NULL, '2020-08-03 07:36:35', NULL),
(2, 'YEVODKNV', 1, 1, 'Francesco', 'Alice, flinging the baby was howling so much.', 64727806, 'https://lorempixel.com/60/48/cats/?81733', NULL, '2020-08-03 07:36:35', NULL),
(3, 'DJTOHEH9', 1, 1, 'Odell', 'Duchess?\' \'Hush! Hush!\' said the Mock Turtle.', 97014539, 'https://lorempixel.com/60/48/cats/?35192', NULL, '2020-08-03 07:36:35', NULL),
(4, 'ASUKWMVYP63', 1, 1, 'Joey', 'Duchess; \'I never saw one, or heard of one,\'.', 9362413, 'https://lorempixel.com/60/48/cats/?99815', NULL, '2020-08-03 07:36:35', NULL),
(5, 'DIVSGITI', 1, 1, 'Hugh', 'I should like to show you! A little bright-eyed.', 2109329, 'https://lorempixel.com/60/48/cats/?38419', NULL, '2020-08-03 07:36:35', NULL),
(6, 'COPCA999', 11, 151, 'MOGA2', 'Esto es una MOGA2.', 5000000, 'http://www.treda.local.com/public/img/product/5f27883d38307select all.png', NULL, '2020-08-03 08:42:45', '2020-08-03 08:45:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `store`
--

CREATE TABLE `store` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_date` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `store`
--

INSERT INTO `store` (`id`, `user_id`, `name`, `opening_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'O\'Kon, Spencer and Hagenes', '1977-09-04', NULL, '2020-08-03 07:36:21', NULL),
(2, 1, 'Mann, Kuhn and Gutkowski', '2013-05-15', NULL, '2020-08-03 07:36:21', NULL),
(3, 1, 'Berge Group', '1981-01-11', NULL, '2020-08-03 07:36:21', NULL),
(4, 1, 'Paucek-Prohaska', '2011-03-15', NULL, '2020-08-03 07:36:21', NULL),
(5, 1, 'Conroy PLC', '1981-08-14', NULL, '2020-08-03 07:36:21', NULL),
(6, 1, 'Langworth, Jaskolski and Oberbrunner', '1972-10-23', NULL, '2020-08-03 07:36:21', NULL),
(7, 1, 'Fahey, Stokes and Kovacek', '1977-05-17', NULL, '2020-08-03 07:36:21', NULL),
(8, 1, 'Bins-Dare', '2002-02-10', NULL, '2020-08-03 07:36:21', NULL),
(9, 1, 'Gislason-Beatty', '2015-10-16', NULL, '2020-08-03 07:36:21', NULL),
(10, 1, 'Mayert Ltd', '1988-05-22', NULL, '2020-08-03 07:36:21', NULL),
(11, 1, 'Nolan PLC', '1979-01-19', NULL, '2020-08-03 07:36:21', NULL),
(12, 1, 'Hackett-Hagenes', '1999-04-07', NULL, '2020-08-03 07:36:21', NULL),
(13, 1, 'Rippin Ltd', '1972-01-17', NULL, '2020-08-03 07:36:21', NULL),
(14, 1, 'Dooley-Beatty', '2007-10-13', NULL, '2020-08-03 07:36:21', NULL),
(15, 1, 'Beier-Schuppe', '1999-12-02', NULL, '2020-08-03 07:36:21', NULL),
(16, 1, 'Kris-Halvorson', '1971-12-22', NULL, '2020-08-03 07:36:21', NULL),
(17, 1, 'Kuhic, Ferry and Shanahan', '1994-03-17', NULL, '2020-08-03 07:36:21', NULL),
(18, 1, 'Rodriguez, Ernser and Davis', '2010-04-24', NULL, '2020-08-03 07:36:21', NULL),
(19, 1, 'Langosh-Mosciski', '1996-02-12', NULL, '2020-08-03 07:36:21', NULL),
(20, 1, 'Jast-Dach', '2005-12-16', NULL, '2020-08-03 07:36:21', NULL),
(21, 1, 'Gulgowski-Ledner', '1990-06-24', NULL, '2020-08-03 07:36:21', NULL),
(22, 1, 'Collins-Macejkovic', '2001-11-11', NULL, '2020-08-03 07:36:21', NULL),
(23, 1, 'Oberbrunner, Franecki and Haley', '2019-09-22', NULL, '2020-08-03 07:36:21', NULL),
(24, 1, 'Gutkowski LLC', '1996-02-27', NULL, '2020-08-03 07:36:21', NULL),
(25, 1, 'Wisozk, Grady and Kuhlman', '2019-04-26', NULL, '2020-08-03 07:36:21', NULL),
(26, 1, 'Rutherford-Ward', '2003-11-22', NULL, '2020-08-03 07:36:21', NULL),
(27, 1, 'Ruecker-Boyer', '2014-11-24', NULL, '2020-08-03 07:36:21', NULL),
(28, 1, 'Runte-Greenholt', '1977-10-24', NULL, '2020-08-03 07:36:21', NULL),
(29, 1, 'DuBuque LLC', '1974-02-09', NULL, '2020-08-03 07:36:21', NULL),
(30, 1, 'Kunze-Schmitt', '2008-01-09', NULL, '2020-08-03 07:36:21', NULL),
(31, 1, 'Kovacek, Brekke and Mitchell', '2012-02-22', NULL, '2020-08-03 07:36:21', NULL),
(32, 1, 'Halvorson, Nikolaus and Bailey', '1973-12-28', NULL, '2020-08-03 07:36:21', NULL),
(33, 1, 'Breitenberg, Jacobson and Schmeler', '2011-06-26', NULL, '2020-08-03 07:36:21', NULL),
(34, 1, 'Ferry, Osinski and Huels', '1972-10-30', NULL, '2020-08-03 07:36:21', NULL),
(35, 1, 'Franecki-Harris', '2001-12-24', NULL, '2020-08-03 07:36:21', NULL),
(36, 1, 'Heaney Ltd', '2001-06-19', NULL, '2020-08-03 07:36:21', NULL),
(37, 1, 'Nader, Satterfield and Johnson', '2013-07-31', NULL, '2020-08-03 07:36:21', NULL),
(38, 1, 'Shields-Morar', '2009-10-17', NULL, '2020-08-03 07:36:21', NULL),
(39, 1, 'Quigley, Lind and Heathcote', '1982-08-04', NULL, '2020-08-03 07:36:21', NULL),
(40, 1, 'Friesen-Senger', '1996-04-28', NULL, '2020-08-03 07:36:21', NULL),
(41, 1, 'Hodkiewicz, Labadie and Trantow', '2017-07-04', NULL, '2020-08-03 07:36:21', NULL),
(42, 1, 'Okuneva, Quitzon and Crona', '1979-02-20', NULL, '2020-08-03 07:36:21', NULL),
(43, 1, 'Hand Ltd', '1984-06-16', NULL, '2020-08-03 07:36:21', NULL),
(44, 1, 'Cruickshank Ltd', '2016-04-13', NULL, '2020-08-03 07:36:21', NULL),
(45, 1, 'Kemmer-Fadel', '2017-11-04', NULL, '2020-08-03 07:36:21', NULL),
(46, 1, 'Bergnaum-Swift', '1988-10-05', NULL, '2020-08-03 07:36:21', NULL),
(47, 1, 'Hermann-Stokes', '1996-05-12', NULL, '2020-08-03 07:36:21', NULL),
(48, 1, 'Terry Inc', '1997-11-14', NULL, '2020-08-03 07:36:21', NULL),
(49, 1, 'Lebsack Inc', '1982-11-12', NULL, '2020-08-03 07:36:21', NULL),
(50, 1, 'Powlowski-O\'Kon', '1990-12-18', NULL, '2020-08-03 07:36:21', NULL),
(51, 1, 'Kautzer, Ondricka and Waelchi', '1975-12-01', NULL, '2020-08-03 07:36:21', NULL),
(52, 1, 'Farrell-Bosco', '2019-01-23', NULL, '2020-08-03 07:36:21', NULL),
(53, 1, 'Franecki-Gottlieb', '1977-01-16', NULL, '2020-08-03 07:36:21', NULL),
(54, 1, 'Walter LLC', '1988-10-30', NULL, '2020-08-03 07:36:21', NULL),
(55, 1, 'Aufderhar Ltd', '1988-08-27', NULL, '2020-08-03 07:36:21', NULL),
(56, 1, 'Frami and Sons', '1992-03-10', NULL, '2020-08-03 07:36:21', NULL),
(57, 1, 'Kuphal-Watsica', '1984-03-14', NULL, '2020-08-03 07:36:21', NULL),
(58, 1, 'Ruecker, Collins and Bartoletti', '1987-06-05', NULL, '2020-08-03 07:36:21', NULL),
(59, 1, 'Koelpin, Block and Moen', '2008-12-22', NULL, '2020-08-03 07:36:21', NULL),
(60, 1, 'Braun, Yost and Veum', '1993-01-21', NULL, '2020-08-03 07:36:21', NULL),
(61, 1, 'Rippin-Ernser', '1985-09-09', NULL, '2020-08-03 07:36:21', NULL),
(62, 1, 'Nikolaus Group', '2006-10-01', NULL, '2020-08-03 07:36:21', NULL),
(63, 1, 'Schroeder, Ruecker and Fahey', '1971-09-15', NULL, '2020-08-03 07:36:21', NULL),
(64, 1, 'Kessler, VonRueden and Erdman', '1986-03-18', NULL, '2020-08-03 07:36:21', NULL),
(65, 1, 'Huel-Jast', '2014-07-03', NULL, '2020-08-03 07:36:21', NULL),
(66, 1, 'Hayes-Romaguera', '1982-05-16', NULL, '2020-08-03 07:36:21', NULL),
(67, 1, 'Walsh-Wintheiser', '1996-07-02', NULL, '2020-08-03 07:36:21', NULL),
(68, 1, 'Jacobs, Hane and Dickinson', '2014-11-28', NULL, '2020-08-03 07:36:21', NULL),
(69, 1, 'Cummerata Ltd', '1985-02-02', NULL, '2020-08-03 07:36:21', NULL),
(70, 1, 'Hane, Lueilwitz and Braun', '1984-11-18', NULL, '2020-08-03 07:36:21', NULL),
(71, 1, 'Purdy, Nikolaus and Bode', '1988-09-02', NULL, '2020-08-03 07:36:21', NULL),
(72, 1, 'Renner-Labadie', '1977-06-17', NULL, '2020-08-03 07:36:21', NULL),
(73, 1, 'Pouros, Towne and Padberg', '1978-09-30', NULL, '2020-08-03 07:36:21', NULL),
(74, 1, 'Predovic-Muller', '2017-10-16', NULL, '2020-08-03 07:36:21', NULL),
(75, 1, 'Ziemann, Kilback and Muller', '1999-03-08', NULL, '2020-08-03 07:36:21', NULL),
(76, 1, 'Kris, Abernathy and Schuppe', '1995-05-18', NULL, '2020-08-03 07:36:21', NULL),
(77, 1, 'Strosin Inc', '2017-06-20', NULL, '2020-08-03 07:36:21', NULL),
(78, 1, 'Klocko PLC', '2007-06-24', NULL, '2020-08-03 07:36:21', NULL),
(79, 1, 'Bednar and Sons', '1998-05-08', NULL, '2020-08-03 07:36:21', NULL),
(80, 1, 'Klocko, Walsh and Braun', '2011-10-19', NULL, '2020-08-03 07:36:21', NULL),
(81, 1, 'Gutmann-Schowalter', '2011-02-16', NULL, '2020-08-03 07:36:21', NULL),
(82, 1, 'Little Group', '2014-08-09', NULL, '2020-08-03 07:36:21', NULL),
(83, 1, 'Metz Group', '2015-11-22', NULL, '2020-08-03 07:36:21', NULL),
(84, 1, 'Cormier, Cartwright and Ratke', '2019-06-16', NULL, '2020-08-03 07:36:21', NULL),
(85, 1, 'O\'Hara-Mann', '2015-11-21', NULL, '2020-08-03 07:36:21', NULL),
(86, 1, 'Krajcik, Braun and Lockman', '2020-04-29', NULL, '2020-08-03 07:36:21', NULL),
(87, 1, 'Jenkins and Sons', '1993-06-19', NULL, '2020-08-03 07:36:21', NULL),
(88, 1, 'Marvin LLC', '2007-08-02', NULL, '2020-08-03 07:36:21', NULL),
(89, 1, 'Bechtelar-Hagenes', '2015-05-07', NULL, '2020-08-03 07:36:21', NULL),
(90, 1, 'Hettinger, Donnelly and Douglas', '1986-09-17', NULL, '2020-08-03 07:36:21', NULL),
(91, 1, 'Reinger, McLaughlin and Cormier', '2015-02-13', NULL, '2020-08-03 07:36:21', NULL),
(92, 1, 'Prohaska, Barton and Moen', '2005-03-31', NULL, '2020-08-03 07:36:21', NULL),
(93, 1, 'Kulas-Gottlieb', '1993-01-17', NULL, '2020-08-03 07:36:21', NULL),
(94, 1, 'Dietrich, Hyatt and Quitzon', '2003-02-04', NULL, '2020-08-03 07:36:21', NULL),
(95, 1, 'Bahringer PLC', '2004-07-19', NULL, '2020-08-03 07:36:21', NULL),
(96, 1, 'Kirlin, Bahringer and Walter', '1981-08-09', NULL, '2020-08-03 07:36:21', NULL),
(97, 1, 'Bechtelar Group', '2018-06-14', NULL, '2020-08-03 07:36:21', NULL),
(98, 1, 'Hagenes-Zulauf', '1977-08-13', NULL, '2020-08-03 07:36:21', NULL),
(99, 1, 'Harber-Bogisich', '1975-07-30', NULL, '2020-08-03 07:36:21', NULL),
(100, 1, 'Schroeder, Tillman and Goodwin', '1986-09-20', NULL, '2020-08-03 07:36:21', NULL),
(101, 1, 'Bauch-Marquardt', '1972-08-01', NULL, '2020-08-03 07:36:21', NULL),
(102, 1, 'Lang, Connelly and Ernser', '2000-04-21', NULL, '2020-08-03 07:36:21', NULL),
(103, 1, 'Christiansen Ltd', '1983-10-31', NULL, '2020-08-03 07:36:21', NULL),
(104, 1, 'Bayer Group', '1993-09-02', NULL, '2020-08-03 07:36:21', NULL),
(105, 1, 'Wisoky, Pouros and Lueilwitz', '1974-09-30', NULL, '2020-08-03 07:36:21', NULL),
(106, 1, 'Wehner-Weissnat', '1989-05-11', NULL, '2020-08-03 07:36:21', NULL),
(107, 1, 'Feest Inc', '2001-06-18', NULL, '2020-08-03 07:36:21', NULL),
(108, 1, 'Von, Waelchi and Hagenes', '2009-06-05', NULL, '2020-08-03 07:36:21', NULL),
(109, 1, 'Hickle, Stracke and Considine', '1997-03-21', NULL, '2020-08-03 07:36:21', NULL),
(110, 1, 'Champlin, Shields and Hermiston', '1977-01-06', NULL, '2020-08-03 07:36:21', NULL),
(111, 1, 'Robel Inc', '1997-09-03', NULL, '2020-08-03 07:36:21', NULL),
(112, 1, 'Boyle, Schamberger and Murray', '2001-11-15', NULL, '2020-08-03 07:36:21', NULL),
(113, 1, 'Rutherford Group', '2007-05-07', NULL, '2020-08-03 07:36:21', NULL),
(114, 1, 'Beahan, Dibbert and Rogahn', '1977-11-12', NULL, '2020-08-03 07:36:21', NULL),
(115, 1, 'O\'Reilly LLC', '1997-01-01', NULL, '2020-08-03 07:36:21', NULL),
(116, 1, 'Corwin, Willms and Kuhlman', '2017-06-14', NULL, '2020-08-03 07:36:21', NULL),
(117, 1, 'Bednar-Leffler', '2004-10-11', NULL, '2020-08-03 07:36:21', NULL),
(118, 1, 'Parker Group', '2015-03-15', NULL, '2020-08-03 07:36:21', NULL),
(119, 1, 'Christiansen, Block and Ondricka', '1978-05-24', NULL, '2020-08-03 07:36:21', NULL),
(120, 1, 'Schuster, Jaskolski and Greenholt', '1992-04-16', NULL, '2020-08-03 07:36:21', NULL),
(121, 1, 'Sauer, McCullough and Brown', '2006-03-30', NULL, '2020-08-03 07:36:21', NULL),
(122, 1, 'Schmeler, Moen and Kohler', '1974-05-06', NULL, '2020-08-03 07:36:21', NULL),
(123, 1, 'Trantow Inc', '1988-09-16', NULL, '2020-08-03 07:36:21', NULL),
(124, 1, 'Ferry Group', '2012-08-06', NULL, '2020-08-03 07:36:21', NULL),
(125, 1, 'Bartell, Lynch and Herman', '1991-06-29', NULL, '2020-08-03 07:36:21', NULL),
(126, 1, 'Hackett, Emmerich and Orn', '1986-06-12', NULL, '2020-08-03 07:36:21', NULL),
(127, 1, 'Stehr-Morissette', '2005-02-23', NULL, '2020-08-03 07:36:21', NULL),
(128, 1, 'Lebsack, Kuphal and Powlowski', '1979-05-04', NULL, '2020-08-03 07:36:21', NULL),
(129, 1, 'Runolfsdottir, Franecki and Becker', '2019-04-04', NULL, '2020-08-03 07:36:21', NULL),
(130, 1, 'Wolff-Kassulke', '2007-03-12', NULL, '2020-08-03 07:36:21', NULL),
(131, 1, 'Kohler Inc', '2008-11-09', NULL, '2020-08-03 07:36:21', NULL),
(132, 1, 'Sipes-Grady', '1999-10-29', NULL, '2020-08-03 07:36:21', NULL),
(133, 1, 'Klocko LLC', '1973-03-31', NULL, '2020-08-03 07:36:21', NULL),
(134, 1, 'Ullrich, Daugherty and Smith', '2002-02-25', NULL, '2020-08-03 07:36:21', NULL),
(135, 1, 'Will LLC', '1980-11-05', NULL, '2020-08-03 07:36:21', NULL),
(136, 1, 'Quitzon, Sanford and Runolfsdottir', '1986-07-03', NULL, '2020-08-03 07:36:21', NULL),
(137, 1, 'Lakin-Bailey', '1970-07-22', NULL, '2020-08-03 07:36:21', NULL),
(138, 1, 'Bartoletti-Hackett', '2012-06-15', NULL, '2020-08-03 07:36:21', NULL),
(139, 1, 'Crooks Ltd', '2004-10-02', NULL, '2020-08-03 07:36:21', NULL),
(140, 1, 'Bradtke LLC', '1980-01-19', NULL, '2020-08-03 07:36:21', NULL),
(141, 1, 'Medhurst Group', '1986-11-23', NULL, '2020-08-03 07:36:21', NULL),
(142, 1, 'Jakubowski Inc', '2008-08-20', NULL, '2020-08-03 07:36:21', NULL),
(143, 1, 'Becker PLC', '1971-02-02', NULL, '2020-08-03 07:36:21', NULL),
(144, 1, 'Mraz, Cronin and Feil', '2018-07-15', NULL, '2020-08-03 07:36:21', NULL),
(145, 1, 'Murphy LLC', '1995-04-14', NULL, '2020-08-03 07:36:21', NULL),
(146, 1, 'Rosenbaum, Windler and Schmitt', '2011-11-30', NULL, '2020-08-03 07:36:21', NULL),
(147, 1, 'Leuschke LLC', '2016-05-25', NULL, '2020-08-03 07:36:21', NULL),
(148, 1, 'Schulist, Towne and Leannon', '2007-04-24', NULL, '2020-08-03 07:36:21', NULL),
(149, 1, 'Williamson PLC', '1982-07-12', NULL, '2020-08-03 07:36:21', NULL),
(150, 1, 'Lakin-Willms', '1992-08-14', NULL, '2020-08-03 07:36:21', NULL),
(151, 11, 'TEXA2', '2020-08-02', NULL, '2020-08-03 08:39:44', '2020-08-03 08:40:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Godfrey Rolfson', 'deckow.sonya@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'hi1Sa1nDZc', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(2, 'Dr. Linwood Steuber', 'barry.powlowski@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '4xYrvB0DDe', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(3, 'Miss Lavonne Stracke Sr.', 'vbergnaum@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'LEYojM93XH', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(4, 'Prof. Maude Nitzsche', 'lambert81@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'QBqCUMqADX', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(5, 'Prof. Emerald Nitzsche', 'hermann.noble@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'ulsbH9OPwp', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(6, 'Leanna Crist', 'beau.jaskolski@example.net', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'dkVLE08keB', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(7, 'Ethel Parisian Sr.', 'hayley.gutkowski@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'neW8Wat4Qj', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(8, 'Darrion Moen', 'cartwright.carolanne@example.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'pexlcfYikH', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(9, 'Sim Lehner', 'toy.anika@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '8MOxjsLiAT', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(10, 'Zula Gaylord', 'qwuckert@example.org', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'gKSOExGcHS', '2020-08-03 07:30:08', '2020-08-03 07:30:08'),
(11, 'test', 'test@gmail.com', '$2y$10$4LuP8AfS9ImsT.Nzhh.1juk8meUiJqt2PLsV29EqW6JlxkTEvR/y.', NULL, '2020-08-03 07:40:53', '2020-08-03 07:40:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_sku_unique` (`sku`),
  ADD KEY `product_user_id_foreign` (`user_id`),
  ADD KEY `product_store_id_foreign` (`store_id`);

--
-- Indices de la tabla `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `store`
--
ALTER TABLE `store`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
