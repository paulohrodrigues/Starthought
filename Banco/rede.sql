-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Nov-2016 às 20:37
-- Versão do servidor: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rede`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(255) NOT NULL,
  `texto` text NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_escrito` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`id`, `texto`, `id_user`, `id_escrito`) VALUES
(82, ' Gatinha Linda ', 2, 19),
(87, ' oi', 1, 22),
(88, ' ola', 2, 22),
(89, ' oioioi', 2, 22),
(90, ' lailai', 2, 22),
(91, ' lalai', 2, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curtidas`
--

INSERT INTO `curtidas` (`id`, `id_usuario`, `id_publicacao`) VALUES
(858, 2, 18),
(859, 2, 19),
(862, 1, 20),
(863, 1, 19),
(864, 1, 22),
(873, 2, 20),
(874, 2, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `escrito`
--

CREATE TABLE `escrito` (
  `id` int(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `texto` text NOT NULL,
  `tipo` text NOT NULL,
  `like` int(255) NOT NULL,
  `comentarios` int(11) NOT NULL,
  `privacidade` text NOT NULL,
  `titulo` varchar(191) DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escrito`
--

INSERT INTO `escrito` (`id`, `id_user`, `texto`, `tipo`, `like`, `comentarios`, `privacidade`, `titulo`, `data`) VALUES
(19, 2, '<p>Amor da minha vida ,daqui até a enternidade</p>', 'poema', 2, 1, 'publico', 'Amor', '2016-11-16 23:24:28'),
(20, 2, '<p>Lindos &gt;&lt;</p>', 'livro', 2, 0, 'anonimo', 'I love you ', '2016-11-16 23:29:27'),
(22, 1, '<p>Amor Meu&nbsp;</p>', 'poema', 2, 5, 'publico', 'Paulo henrique', '2016-11-16 23:38:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_usuario`, `id_publicacao`) VALUES
(33, 1, 19),
(37, 1, 20),
(38, 1, 22),
(45, 2, 22),
(48, 2, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE `publicacao` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `generoTextual` varchar(255) DEFAULT NULL,
  `texto` varchar(255) DEFAULT NULL,
  `privacidade` varchar(255) DEFAULT NULL,
  `usuario_usuario` tinyint(1) UNSIGNED DEFAULT NULL,
  `genero_textual` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `publicacao`
--

INSERT INTO `publicacao` (`id`, `usuario_id`, `titulo`, `generoTextual`, `texto`, `privacidade`, `usuario_usuario`, `genero_textual`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `nome` text NOT NULL,
  `id` int(255) NOT NULL,
  `foto` text NOT NULL,
  `login` text NOT NULL,
  `email` text NOT NULL,
  `senha` text NOT NULL,
  `id_face` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`nome`, `id`, `foto`, `login`, `email`, `senha`, `id_face`) VALUES
('Paulo Henrique Rodrigues Abreu', 1, '582bb777ebf8a.png', 'admin', 'paulo100games@gmail.com', '123', '1135025429911699'),
('Aline', 2, '582e069291ac8.png', 'alinyaraujos', 'llinyaraujo@gmail.com', '123', '1218255774930032');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrito`
--
ALTER TABLE `escrito`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publicacao`
--
ALTER TABLE `publicacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=876;
--
-- AUTO_INCREMENT for table `escrito`
--
ALTER TABLE `escrito`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
