-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Jun-2019 às 23:24
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wizards`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `amizades`
--

CREATE TABLE `amizades` (
  `id_bruxo_1` int(11) NOT NULL,
  `id_bruxo_2` int(11) NOT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `amizades`
--

INSERT INTO `amizades` (`id_bruxo_1`, `id_bruxo_2`, `status`) VALUES
(1, 2, 'amigo'),
(2, 3, 'pendente'),
(9, 8, 'amigo'),
(9, 4, 'pendente'),
(1, 9, 'pendente'),
(16, 17, 'amigo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bruxos`
--

CREATE TABLE `bruxos` (
  `id_bruxo` int(11) NOT NULL,
  `nome_bruxo` varchar(100) NOT NULL,
  `nm_bruxo` varchar(45) NOT NULL,
  `ds_email` varchar(45) NOT NULL,
  `ds_senha` varchar(45) NOT NULL,
  `ft_bruxo` varchar(200) NOT NULL,
  `id_casa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bruxos`
--

INSERT INTO `bruxos` (`id_bruxo`, `nome_bruxo`, `nm_bruxo`, `ds_email`, `ds_senha`, `ft_bruxo`, `id_casa`) VALUES
(15, 'Cesar Amorim', 'cesar', 'cesar@cesar', '81dc9bdb52d04dc20036dbd8313ed055', 'http://images.virgula.com.br/2016/06/procurando-dory.jpg', 3),
(16, 'Jamile', 'jamile', 'ja@ja', '202cb962ac59075b964b07152d234b70', 'https://querotrabalharsite.files.wordpress.com/2017/01/11.jpg?w=1200', 4),
(17, 'Daniel', 'daniel', 'da@da', '202cb962ac59075b964b07152d234b70', 'https://querotrabalharsite.files.wordpress.com/2017/01/11.jpg?w=1200', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `casas`
--

CREATE TABLE `casas` (
  `id_casa` int(11) NOT NULL,
  `nm_casa` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `casas`
--

INSERT INTO `casas` (`id_casa`, `nm_casa`) VALUES
(1, 'Grifinoria'),
(2, 'Sonserina'),
(3, 'Lufa-Lufa'),
(4, 'Corvinal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_post` int(11) NOT NULL,
  `id_bruxo` int(11) NOT NULL,
  `desc_coment` varchar(200) NOT NULL,
  `data_coment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id_post`, `id_bruxo`, `desc_coment`, `data_coment`) VALUES
(41, 15, 'oimnlk\r\n', '2019-06-03'),
(44, 15, 'deadea', '2019-06-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id_post` int(11) NOT NULL,
  `id_bruxo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `desc_post` varchar(500) NOT NULL,
  `ft_post` varchar(200) NOT NULL,
  `data_post` date NOT NULL,
  `like_post` int(255) NOT NULL,
  `coment_post` int(255) NOT NULL,
  `cod_bruxo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bruxos`
--
ALTER TABLE `bruxos`
  ADD PRIMARY KEY (`id_bruxo`);

--
-- Indexes for table `casas`
--
ALTER TABLE `casas`
  ADD PRIMARY KEY (`id_casa`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bruxos`
--
ALTER TABLE `bruxos`
  MODIFY `id_bruxo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `casas`
--
ALTER TABLE `casas`
  MODIFY `id_casa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
