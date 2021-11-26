-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Nov-2021 às 20:59
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `twitter_clone`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tweets`
--

CREATE TABLE `tweets` (
  `id_tweet` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tweet` varchar(140) NOT NULL,
  `data_inclusao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tweets`
--

INSERT INTO `tweets` (`id_tweet`, `id_usuario`, `tweet`, `data_inclusao`) VALUES
(10, 7, 'Meu primeiro tweet', '2021-11-26 12:47:49'),
(11, 7, 'O segundo tweet de todos.', '2021-11-26 12:48:02'),
(12, 7, 'O melhor tweet', '2021-11-26 12:48:21'),
(13, 7, 'Foda-se', '2021-11-26 12:48:42'),
(14, 7, 'oi', '2021-11-26 13:10:42'),
(15, 9, 'Meu primeiro tweet', '2021-11-26 13:12:48'),
(16, 7, 'olar', '2021-11-26 13:18:04'),
(17, 12, 'oi eu sou o kayo', '2021-11-26 15:41:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(125) DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `senha` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `senha`) VALUES
(7, 'gabriele', 'gabriele@teste.com.br', '38f629170ac3ab74b9d6d2cc411c2f3c'),
(9, 'gabi', 'naogabe@gmail.com', '38f629170ac3ab74b9d6d2cc411c2f3c'),
(11, 'pedro', 'eros@gmail.com', '38f629170ac3ab74b9d6d2cc411c2f3c'),
(12, 'kayo', 'kayo@gmail.com', '38f629170ac3ab74b9d6d2cc411c2f3c');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_seguidores`
--

CREATE TABLE `usuarios_seguidores` (
  `id_usuario_seguidor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `seguindo_id_usuario` int(11) NOT NULL,
  `data_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios_seguidores`
--

INSERT INTO `usuarios_seguidores` (`id_usuario_seguidor`, `id_usuario`, `seguindo_id_usuario`, `data_registro`) VALUES
(9, 7, 9, '2021-11-26 15:26:55'),
(10, 7, 12, '2021-11-26 15:40:56');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id_tweet`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios_seguidores`
--
ALTER TABLE `usuarios_seguidores`
  ADD PRIMARY KEY (`id_usuario_seguidor`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios_seguidores`
--
ALTER TABLE `usuarios_seguidores`
  MODIFY `id_usuario_seguidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
