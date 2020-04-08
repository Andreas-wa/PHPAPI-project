-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 08 apr 2020 kl 11:28
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `individuell_uppgift`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `checkout`
--

INSERT INTO `checkout` (`id`, `token`, `product_id`, `date`) VALUES
(37, 'bc6c9d6f4243f066d7549628767e044d', 16, '2020-04-08 11:23:27'),
(39, 'bc6c9d6f4243f066d7549628767e044d', 17, '2020-04-08 11:25:49'),
(40, 'bc6c9d6f4243f066d7549628767e044d', 20, '2020-04-08 11:25:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `orders`
--

INSERT INTO `orders` (`id`, `token`, `product_id`, `date`) VALUES
(37, 'bc6c9d6f4243f066d7549628767e044d', 16, '2020-04-08 11:23:27'),
(39, 'bc6c9d6f4243f066d7549628767e044d', 17, '2020-04-08 11:25:49'),
(40, 'bc6c9d6f4243f066d7549628767e044d', 20, '2020-04-08 11:25:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `size` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `product`, `price`, `size`) VALUES
(14, 'kalsong', 99, 'M'),
(15, 'byxor', 399, '34'),
(16, 'byxor', 399, '34'),
(17, 'hoddie', 1999, 'M'),
(18, 'testar så att allt funkar', 199, 'XS'),
(19, 'test', 99, 'l'),
(21, 'hoddie', 299, 's'),
(28, 'hoddie', 799, 'L'),
(29, 'hoddie', 99, 'XL'),
(30, 'hoddie', 99, 'XL'),
(32, 'test silver', 299, 'M'),
(33, 'silver', 80, 'M'),
(35, 'test', 99, 'L');

-- --------------------------------------------------------

--
-- Tabellstruktur `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_update` int(10) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `date_update`, `token`) VALUES
(64, 9, 1586166111, 'de64410f80cd26dd6f4912d1eeb76c27'),
(66, 10, 1586166255, '53755a5ce970a284b7d64fdc28b3fa65'),
(78, 8, 1586335905, '9fd1e7ef14015fb120ff291601e639b5'),
(79, 11, 1586336963, 'c2828b78ba80a2e3940c1c521d746fbd'),
(80, 15, 1586337976, 'bc6c9d6f4243f066d7549628767e044d'),
(81, 7, 1586338044, 'f2208dd50463e4ecf4746e8000aa6ba5');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `role`) VALUES
(7, 'lisa', 'e9803a706f81a40884b8aeafafb2cfd3', 1),
(8, 'anders', 'dbbe002ab4b6277129f92f0ec354d128', 0),
(9, 'lasse', '63c83c0859953c7c2e8438aded8760d0', 0),
(15, 'stefan', 'e42337a246c9864183d92125eb51d86c', 0);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT för tabell `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
