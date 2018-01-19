-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 19-Jan-2018 às 14:41
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ziit-database`
--

--
-- Extraindo dados da tabela `precos`
--

INSERT INTO `precos` (`id`, `quantidade_recs`, `preco`, `created_at`, `updated_at`) VALUES
(1, 3, '99.90', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(2, 4, '103.90', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(3, 5, '108.12', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(4, 6, '112.36', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(5, 7, '116.63', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(6, 8, '120.93', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(7, 9, '125.26', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(8, 10, '129.63', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(9, 11, '134.02', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(10, 12, '138.45', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(11, 13, '142.92', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(12, 14, '147.43', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(13, 15, '151.97', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(14, 16, '156.55', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(15, 17, '161.17', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(16, 18, '165.83', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(17, 19, '170.54', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(18, 20, '175.29', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(19, 21, '180.08', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(20, 22, '184.92', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(21, 23, '189.81', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(22, 24, '194.75', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(23, 25, '199.74', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(24, 26, '204.78', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(25, 27, '209.87', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(26, 28, '215.01', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(27, 29, '220.21', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(28, 30, '225.47', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(29, 31, '230.78', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(30, 32, '236.15', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(31, 33, '241.58', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(32, 34, '247.07', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(33, 35, '252.63', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(34, 36, '258.24', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(35, 37, '263.92', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(36, 38, '269.67', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(37, 39, '275.49', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(38, 40, '281.37', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(39, 41, '287.32', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(40, 42, '293.34', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(41, 43, '299.43', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(42, 44, '305.60', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(43, 45, '311.84', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(44, 46, '318.15', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(45, 47, '324.54', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(46, 48, '331.01', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(47, 49, '337.56', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(48, 50, '344.18', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(49, 51, '350.89', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(50, 52, '357.68', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(51, 53, '364.56', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(52, 54, '371.52', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(53, 55, '378.56', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(54, 56, '385.70', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(55, 57, '392.92', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(56, 58, '400.23', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(57, 59, '407.63', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(58, 60, '415.12', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(59, 61, '422.71', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(60, 62, '430.39', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(61, 63, '438.17', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(62, 64, '446.04', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(63, 65, '454.01', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(64, 66, '462.08', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(65, 67, '470.25', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(66, 68, '478.52', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(67, 69, '486.90', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(68, 70, '495.38', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(69, 71, '503.96', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(70, 72, '512.65', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(71, 73, '521.45', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(72, 74, '530.36', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(73, 75, '539.37', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(74, 76, '548.50', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(75, 77, '557.74', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(76, 78, '567.10', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(77, 79, '576.57', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(78, 80, '586.15', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(79, 81, '595.85', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(80, 82, '605.68', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(81, 83, '615.62', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(82, 84, '625.68', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(83, 85, '635.86', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(84, 86, '646.17', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(85, 87, '656.60', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(86, 88, '667.15', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(87, 89, '677.84', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(88, 90, '688.65', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(89, 91, '699.59', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(90, 92, '710.66', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(91, 93, '721.86', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(92, 94, '733.19', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(93, 95, '744.66', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(94, 96, '756.27', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(95, 97, '768.01', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(96, 98, '779.89', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(97, 99, '791.90', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(98, 100, '804.06', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(99, 101, '816.36', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(100, 102, '828.80', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(101, 103, '841.38', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(102, 104, '854.11', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(103, 105, '866.99', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(104, 106, '880.01', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(105, 107, '893.18', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(106, 108, '906.50', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(107, 109, '919.97', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(108, 110, '933.59', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(109, 111, '947.37', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(110, 112, '961.30', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(111, 113, '975.38', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(112, 114, '989.63', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(113, 115, '1004.03', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(114, 116, '1018.59', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(115, 117, '1033.31', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(116, 118, '1048.19', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(117, 119, '1063.23', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(118, 120, '1078.44', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(119, 121, '1093.82', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(120, 122, '1109.36', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(121, 123, '1125.06', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(122, 124, '1140.94', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(123, 125, '1156.99', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(124, 126, '1173.20', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(125, 127, '1189.60', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(126, 128, '1206.16', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(127, 129, '1222.90', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(128, 130, '1239.81', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(129, 131, '1256.90', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(130, 132, '1274.17', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(131, 133, '1291.62', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(132, 134, '1309.25', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(133, 135, '1327.07', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(134, 136, '1345.06', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(135, 137, '1363.24', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(136, 138, '1381.61', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(137, 139, '1400.16', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(138, 140, '1418.90', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(139, 141, '1437.83', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(140, 142, '1456.95', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(141, 143, '1476.26', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(142, 144, '1495.77', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(143, 145, '1515.47', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(144, 146, '1535.36', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(145, 147, '1555.45', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(146, 148, '1575.74', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(147, 149, '1596.22', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(148, 150, '1616.91', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(149, 151, '1637.80', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(150, 152, '1658.89', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(151, 153, '1680.18', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(152, 154, '1701.68', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(153, 155, '1723.38', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(154, 156, '1745.29', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(155, 157, '1767.41', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(156, 158, '1789.74', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(157, 159, '1812.28', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(158, 160, '1835.04', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(159, 161, '1858.00', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(160, 162, '1881.18', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(161, 163, '1904.58', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(162, 164, '1928.19', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(163, 165, '1952.02', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(164, 166, '1976.07', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(165, 167, '2000.34', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(166, 168, '2024.83', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(167, 169, '2049.54', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(168, 170, '2074.48', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(169, 171, '2099.65', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(170, 172, '2125.03', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(171, 173, '2150.65', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(172, 174, '2176.50', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(173, 175, '2202.57', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(174, 176, '2228.88', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(175, 177, '2255.42', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(176, 178, '2282.19', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(177, 179, '2309.20', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(178, 180, '2336.45', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(179, 181, '2363.93', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(180, 182, '2391.65', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(181, 183, '2419.61', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(182, 184, '2447.81', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(183, 185, '2476.25', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(184, 186, '2504.93', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(185, 187, '2533.86', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(186, 188, '2563.04', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(187, 189, '2592.46', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(188, 190, '2622.13', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(189, 191, '2652.05', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(190, 192, '2682.22', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(191, 193, '2712.64', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(192, 194, '2743.31', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(193, 195, '2774.24', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(194, 196, '2805.43', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(195, 197, '2836.86', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(196, 198, '2868.56', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(197, 199, '2900.52', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(198, 200, '2932.73', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(199, 201, '2965.21', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(200, 202, '2997.95', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(201, 203, '3030.95', '2017-07-13 01:15:20', '2017-07-13 01:15:20'),
(202, 204, '3064.22', '2017-07-13 01:15:20', '2017-07-13 01:15:20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;