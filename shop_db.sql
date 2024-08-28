-- phpMyAdmin SQL Dump
-- version 4.9.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 16, 2022 at 12:09 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Muskarci'),
(2, 'Zene'),
(3, 'Sport'),
(4, 'Majice'),
(5, 'Duksevi'),
(6, 'Jakne'),
(7, 'LifeStyle Patike'),
(8, 'Sportske Patike'),
(9, 'Ranac'),
(10, 'Teretana'),
(11, 'Lopte'),
(12, 'Nike'),
(13, 'Adidas'),
(14, 'Reebok'),
(15, 'Puma'),
(16, 'Trenerke');


-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 2, 'Mihajlo Varga', 'mihajlo@cnt.rs', '0628438016', 'Test Poruka');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `category` int(11) NOT NULL,
  `sub_cat` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `meta_tag` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `sub_cat`, `brand`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `meta_tag`) VALUES
(20,3,10,12, 'Fitnes Flašica', 'Flašica za trening', 500, 'fitnes_1_1.png', 'fitnes_1_2.png', '', 'flašica,sport,trening,flasica,fitnes'),
(21,3,10,12, 'Fitnes Znojnica', 'Fitnes znojnica, trening', 200, 'fitnes_2_1.png', '', '', 'znojnica,sport,trening,fitnes'),
(22,3,10,0, 'Pilates lopta', 'Pilates lopta za trening', 400, 'fitnes_3_1.png', 'fitnes_3_2.png', '', 'pilates,sport,trening,fitnes,teretana'),
(23,3,10,0, 'Teg 2.5KG', 'Teg za trening 2.5kg', 300, 'fitnes_4_1.png', '', '', 'teg,sport,trening,tegovi,fitnes,teretana'),
(24,3,11,13, 'Adidas Lopta za fudbal', 'Lopta za fudbal, adidas.', 1200, 'lopta_adidas_2.png', 'lopta_adidas__2_2.png', '', 'lopta,sport,adidas,lopte'),
(25,3,11,13, 'Adidas Lopta za fudbal', 'Lopta za fudbal, adidas.', 1200, 'lopta_adidas_1.png', 'lopta_adidas_1_2.png', '', 'lopta,sport,adidas,lopte'),
(27,1,7,13, 'Muške Adidas Patike', 'Muške adidas patike, lifestyle patike', 6500, 'muske_adidas_lifestyle_1_1.png', 'muske_adidas_lifestyle_1_2.png', 'muske_adidas_lifestyle_1_3.png', 'patike,adidas,lifestyle,muske, muske patike, muške patike, muškarci,muskarci, muske lifestyle'),
(28,1,7,0, 'Muške Converse Patike', 'Muške Converse Patike, lifestyle', 7000, 'muske_converse_lifestyle_1_1.png', 'muske_converse_lifestyle_1_2.png', 'muske_converse_lifestyle_1_3.png', 'muske lifestyle,patike,converse,lifestyle,muske, muske patike, muške patike, muškarci,muskarci'),
(29,1,7,12, 'Muške Nike Patike', 'Muške Nike patike, lifestyle', 11300, 'muske_nike_lifestyle_1_1.png', 'muske_nike_lifestyle_1_2.png', 'muske_nike_lifestyle_1_3.png', 'muske lifestyle,patike,nike,lifestyle,muske, muske patike, muške patike, muškarci,muskarci'),
(30,2,7,13, 'Ženske Adidas Patike', 'Ženske Adidas Patike, lifestyle.', 9000, 'zenske_adidas_lifestyle_1_1.png', 'zenske_adidas_lifestyle_1_2.png', 'zenske_adidas_lifestyle_1_3.png', 'zenske lifestyle,patike,adidas,lifestyle,zenske, zenske patike, ženske patike, žene,zene'),
(31,2,7,12, 'Ženske Nike Patike', 'Ženske Nike Patike, lifestyle.', 11999, 'zenske_nike_lifestyle_1_1.png', 'zenske_nike_lifestyle_1_2.png', '', 'zenske lifestyle,patike,nike,lifestyle,ženske, zenske patike, ženske patike, žene,zene'),
(32,2,7,14, 'Ženske Reebok Patike', 'Ženske Reebok patike, lifestyle', 6700, 'zenske_reebok_lifestyle_1_1.jpg', 'zenske_reebok_lifestyle_1_3.jpg', 'zenske_reebok_lifestyle_1_5.jpg', 'zenske lifestyle,patike,reebok,lifestyle,ženske, zenske patike, ženske patike, žene,zene'),
(33,1,8,13, 'Muške Adidas Sport Patike', 'Muške Adidas patike ža trčanje, sport.', 12000, 'muske_adidas_trcanje_1_1.png', 'muske_adidas_trcanje_1_2.png', 'muske_adidas_trcanje_1_3.png', 'muske sport patike,patike,adidas,sport,muske,muske patike, muške patike, muškarci,muskarci'),
(34,1,8,12, 'Muške Nike Sport Patike', 'Muške Nike patike za trčanje, sport.', 11299, 'muske_nike_trcanje_1_1.png', 'muske_nike_trcanje_1_2.png', 'muske_nike_trcanje_1_3.png', 'muske sport patike,patike,nike,sport,muske,muske patike, muške patike, muškarci,muskarci'),
(35,1,8,14, 'Muške Reebok Sport Patike', 'Muške Reebok patike za trčanje, sport.', 8400, 'muske_reebok_trcanje_1_1.png', 'muske_reebok_trcanje_1_2.png', 'muske_reebok_trcanje_1_3.png', 'muske sport patike,patike,reebok,sport,muske,muske patike, muške patike, muškarci,muskarci'),
(36,2,8,13, 'Ženske Adidas Sport Patike', 'Ženske patike za trčanje, sport', 12000, 'zenske_adidas_trcanje_1_1.png', 'zenske_adidas_trcanje_1_2.png', 'zenske_adidas_trcanje_1_3.png', 'zenske sport patike,patike,adidas,sport,zenske,zenske patike, ženske patike,žene,zene'),
(37,2,8,12, 'Ženske Nike Sport Patike', 'Ženske Nike patike za trčanje, sport.', 11699, 'zenske_nike_trcanje_1_1.png', 'zenske_nike_trcanje_1_2.png', 'zenske_nike_trcanje_1_3.png', 'zenske sport patike,patike,nike,sport,zenske,zenske patike, ženske patike,žene,zene'),
(38,2,8,14, 'Ženske Reebok Sport Patike', 'Ženske Reebok patike za trčanje, sport.', 8000, 'zenske_reebok_trcanje_1_1.jpg', 'zenske_reebok_trcanje_1_2.jpg', 'zenske_reebok_trcanje_1_3.jpg', 'zenske sport patike,patike,reebok,sport,zenske,zenske patike, ženske patike,žene,zene'),
(39,1,6,13, 'Muška Adidas Jakna', 'Adidas muška jakna', 16000, 'muske_jakne_adidas_13.png', 'muske_jakne_adidas_14.png', 'muske_jakne_adidas_15.png', 'jakna,jakne,adidas,jakne za zimu,muske,muške,muske jakne, muške jakne, muškarci,muskarci'),
(40,1,6,13, 'Muška Adidas Jakna', 'Muška Adidas Jakna', 15000, 'muske_jakne_adidas_23.png', 'muske_jakne_adidas_24.png', 'muske_jakne_adidas_25.png', 'jakna,jakne,adidas,jakne za zimu,muske,muške,muske jakne, muške jakne, muškarci,muskarci'),
(41,1,6,12, 'Muška Nike Jakna', 'Muška Nike Jakna.', 18000, 'muske_jakne_nike_10.png', 'muske_jakne_nike_11.png', 'muske_jakne_nike_12.png', 'jakna,jakne,nike,jakne za zimu,muske,muške,muske jakne, muške jakne, muškarci,muskarci'),
(42,1,6,12, 'Muška Nike Jakne', 'Muška Nike Jakna', 17500, 'muske_jakne_nike_13.png', 'muske_jakne_nike_14.png', 'muske_jakne_nike_15.png', 'jakna,jakne,nike,jakne za zimu,muske,muške,muske jakne, muške jakne, muškarci,muskarci'),
(43,1,6,14, 'Muška Reebok Jakna', 'Muška Reebok Jakna', 14000, 'muske_jakne_reebok_3.png', 'muske_jakne_reebok_4.png', 'muske_jakne_reebok_5.png', 'jakna,jakne,reebok,jakne za zimu,muske,muške,muske jakne, muške jakne, muškarci,muskarci'),
(44,1,4,13, 'Muška Adidas Majica', 'Muška Adidas Majica', 3500, 'muske_majice_adidas_7.png', 'muske_majice_adidas_8.png', 'muske_majice_adidas_9.png', 'majica,majice,adidas,muske,muške,muske majice, muške majice, muškarci,muskarci'),
(45,1,4,13, 'Muška Adidas Majica', 'Muška Adidas Majica', 3500, 'muske_majice_adidas_10.png', 'muske_majice_adidas_11.png', 'muske_majice_adidas_12.png', 'majica,majice,adidas,muske,muške,muske majice, muške majice, muškarci,muskarci'),
(46,1,4,12, 'Muška Nike Majica', 'Muška Nike Majica', 4000, 'muske_majice_nike_1_6.png', 'muske_majice_nike_1_7.png', 'muske_majice_nike_1_8.png', 'majica,majice,nike,muske,muške,muske majice, muške majice, muškarci,muskarci'),
(47,1,4,12, 'Muška Nike Majica', 'Muška Nike Majica.', 4200, 'muske_majice_nike_1_9.png', 'muske_majice_nike_1_10.png', 'muske_majice_nike_1_11.png', 'majica,majice,nike,muske,muške,muske majice, muške majice, muškarci,muskarci'),
(48,1,4,15, 'Muška Puma Majica', 'Muška Reebok Majica', 2800, 'muske_majice_puma_1_2.png', 'muske_majice_puma_1_3.png', '', 'majica,majice,puma,muske,muške,muske majice, muške majice, muškarci,muskarci'),
(49,1,4,14, 'Muška Reebok Majica', 'Muška Reebok Majica', 3200, 'muske_majice_reebok_1_2.png', 'muske_majice_reebok_1_3.png', 'muske_majice_reebok_1_4.png', 'majica,majice,reebok,muske,muške,muske majice, muške majice, muškarci,muskarci'),
(50,1,4,14, 'Muška Reebok Majica', 'Muška Reebok Majica', 3200, 'muske_majice_reebok_1_5.png', 'muske_majice_reebok_1_6.png', 'muske_majice_reebok_1_7.png', 'majica,majice,reebok,muske,muške,muske majice, muške majice, muškarci,muskarci'),
(51,1,16,13, 'Muška Adidas Trenerka', 'Muška Adidas Trenerka - komplet', 8500, 'muske_trenerke_adidas_11.png', 'muske_trenerke_adidas_12.png', 'muske_trenerke_adidas_13.png', 'trenerka,trenerke,adidas,muske,muške,muske trenerke, muške trenerke, muškarci,muskarci'),
(52,1,16,13, 'Muška Adidas Trenerka', 'Muška Adidas Trenerka - komplet', 8000, 'muske_trenerke_adidas_14.png', 'muske_trenerke_adidas_15.png', 'muske_trenerke_adidas_16.png', 'trenerka,trenerke,adidas,muske,muške,muske trenerke, muške trenerke, muškarci,muskarci'),
(53,1,16,12, 'Muška Nike Trenerka', 'Muška Nike Trenerka - komplet', 11000, 'muske_trenerke_nike_1_2.png', 'muske_trenerke_nike_1_3.png', 'muske_trenerke_nike_1_4.png', 'trenerka,trenerke,nike,muske,muške,muske trenerke, muške trenerke, muškarci,muskarci'),
(54,1,16,12, 'Muška Nike Trenerka', 'Muška Nike Trenerka - komplet', 11000, 'muske_trenerke_nike_1_5.png', 'muske_trenerke_nike_1_6.png', '', 'trenerka,trenerke,nike,muske,muške,muske trenerke, muške trenerke, muškarci,muskarci'),
(55,1,5,13, 'Muški Adidas Duks', 'Muška Dukserica Adidas', 4000, 'muski_duks_adidas_1_5.png', 'muski_duks_adidas_1_6.png', 'muski_duks_adidas_1_7.png', 'duks,dukserica,adidas,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(56,1,5,13, 'Muški Adidas Duks', 'Muška Dukserica Adidas', 4000, 'muski_duks_adidas_1_8.png', 'muski_duks_adidas_1_9.png', 'muski_duks_adidas_1_10.png', 'duks,dukserica,adidas,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(57,1,5,13, 'Muški Adidas Duks', 'Muška Dukserica Adidas', 4000, 'muski_duks_adidas_1_11.png', 'muski_duks_adidas_1_12.png', 'muski_duks_adidas_1_13.png', 'duks,dukserica,adidas,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(58,1,5,12, 'Muški Nike Duks', 'Muška Dukserica Nike', 5000, 'muski_duks_nike_1_5.png', 'muski_duks_nike_1_6.png', 'muski_duks_nike_1_7.png', 'muski nike duks,duks,dukserica,nike,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(59,1,5,12, 'Muški Nike Duks', 'Muška Dukserica Nike', 5500, 'muski_duks_nike_1_8.png', 'muski_duks_nike_1_9.png', 'muski_duks_nike_1_10.png', 'muski nike duks,duks,dukserica,nike,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(60,1,5,12, 'Muški Nike Duks', 'Muška Dukserica Nike', 4700, 'muski_duks_nike_1_12.png', 'muski_duks_nike_1_13.jpg', 'muski_duks_nike_1_15.png', 'muski nike duks,duks,dukserica,nike,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(61,1,5,12, 'Muški Nike Duks', 'Muška Dukserica Nike', 5000, 'muski_duks_nike_1_16.png', 'muski_duks_nike_1_17.png', 'muski_duks_nike_1_18.png', 'muski nike duks,duks,dukserica,nike,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(62,1,5,12, 'Muški Nike Duks', 'Muška Dukserica Nike', 6000, 'muski_duks_nike_1_19.png', 'muski_duks_nike_1_20.png', 'muski_duks_nike_1_21.png', 'muski nike duks,duks,dukserica,nike,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(63,1,5,15, 'Muški Puma Duks', 'Muška Dukserica Puma', 4000, 'muski_duks_puma_11.png', 'muski_duks_puma_12.png', '', 'duks,dukserica,puma,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(64,1,5,15, 'Muški Puma Duks', 'Muška Dukserica Puma', 4000, 'muski_duks_puma_13.png', 'muski_duks_puma_14.png', '', 'duks,dukserica,puma,muske,muške,muski duks, muški duks, muškarci,muskarci'),
(65,2,4,13, 'Ženska Adidas Majica', 'Ženska Adidas Majica', 3500, 'zenske_majice_adidas_1_1.png', 'zenske_majice_adidas_1_2.png', 'zenske_majice_adidas_1_3.png', 'majica,majice,adidas,zenske,ženske,zenske majice, ženske majice, žene,zene'),
(66,2,4,13, 'Ženska Adidas Majica', 'Ženska Adidas Majica', 3500, 'zenske_majice_adidas_1_4.png', 'zenske_majice_adidas_1_5.png', 'zenske_majice_adidas_1_6.png', 'majica,majice,adidas,zenske,ženske,zenske majice, ženske majice, žene,zene'),
(67,2,4,12, 'Ženska Nike Majica', 'Ženska Nike Majica', 4200, 'zenske_majice_nike_1_1.png', 'zenske_majice_nike_1_2.png', 'zenske_majice_nike_1_3.png', 'majica,majice,nike,zenske,ženske,zenske majice, ženske majice, žene,zene'),
(68,2,4,12, 'Ženska Nike Majica', 'Ženska Nike Majica', 4000, 'zenske_majice_nike_1_4.png', 'zenske_majice_nike_1_5.png', 'zenske_majice_nike_1_6.png', 'majica,majice,nike,zenske,ženske,zenske majice, ženske majice, žene,zene'),
(69,2,4,14, 'Ženska Reebok Majica', 'Ženska Reebok Majica ', 3400, 'zenske_majice_reebok_1_1.png', 'zenske_majice_reebok_1_2.png', 'zenske_majice_reebok_1_3.png', 'majica,majice,reebok,zenske,ženske,zenske majice, ženske majice, žene,zene'),
(70,2,4,14, 'Ženska Reebok Majica', 'Ženska Reebok Majica', 3500, 'zenske_majice_reebok_1_4.png', 'zenske_majice_reebok_1_5.png', 'zenske_majice_reebok_1_6.png', 'majica,majice,reebok,zenske,ženske,zenske majice, ženske majice, žene,zene'),
(71,2,16,13, 'Ženska Adidas Trenerka ', 'Ženska Adidas Trenerka ', 8000, 'zenske_trenerke_adidas_1_1.png', 'zenske_trenerke_adidas_1_2.png', 'zenske_trenerke_adidas_1_3.png', 'trenerka,trenerke,adidas,ženske,zenske trenerke, ženske trenerke, žene,zene'),
(72,2,16,13, 'Ženska Adidas Trenerka', 'Ženska Adidas Trenerka ', 9000, 'zenske_trenerke_adidas_1_4.png', 'zenske_trenerke_adidas_1_5.png', 'zenske_trenerke_adidas_1_6.png', 'trenerka,trenerke,adidas,ženske,zenske trenerke, ženske trenerke, žene,zene'),
(73,2,16,12, 'Ženska Nike Trenerka', 'Ženska Nike Trenerka', 10000, 'zenske_trenerke_nike_1_1.png', 'zenske_trenerke_nike_1_2.png', '', 'trenerka,trenerke,nike,ženske,zenske trenerke, ženske trenerke, žene,zene'),
(74,2,16,12, 'Ženska Nike Trenerka', 'Ženska Nike Trenerka', 11000, 'zenske_trenerke_nike_1_3.png', 'zenske_trenerke_nike_1_4.png', 'zenske_trenerke_nike_1_5.png', 'trenerka,trenerke,nike,ženske,zenske trenerke, ženske trenerke, žene,zene'),
(75,2,16,12, 'Ženska Nike Trenerka', 'Ženska Nike Trenerka', 12000, 'zenske_trenerke_nike_1_6.png', 'zenske_trenerke_nike_1_7.png', 'zenske_trenerke_nike_1_8.png', 'trenerka,trenerke,nike,ženske,zenske trenerke, ženske trenerke, žene,zene'),
(76,2,16,14, 'Ženska Reebok Trenerka', 'Ženska Reebok Trenerka', 7500, 'zenske_trenerke_reebok_1_1.png', 'zenske_trenerke_reebok_1_2.png', '', 'trenerka,trenerke,reebok,ženske,zenske trenerke, ženske trenerke, žene,zene'),
(77,3,9,13, 'Ranac Adidas', 'Ranac Adidas', 3000, 'ranac_adidas_1_1.png', 'ranac_adidas_1_2.png', 'ranac_adidas_1_3.png', 'ranac,sport,trening,rancevi,fitnes,teretana'),
(78,3,9,12, 'Ranac Nike', 'Ranac Nike', 4000, 'ranac_nike_1_1.jpg', 'ranac_nike_1_2.png', 'ranac_nike_1_3.png', 'ranac,sport,trening,rancevi,fitnes,teretana,nike');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(2, 'Mihajlo', 'mihajlo@cnt.rs', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
