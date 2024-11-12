-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12/11/2024 às 21:25
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro_seguro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `hora_agendamento` time NOT NULL,
  `chassi` varchar(17) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `ano_fabricacao` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `cliente_id`, `data_agendamento`, `hora_agendamento`, `chassi`, `placa`, `ano_fabricacao`) VALUES
(15, 25, '2024-11-16', '17:27:00', 'testando', '1313232A', '2222/2222');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cpf_segurado` varchar(14) NOT NULL,
  `data_nascimento_segurado` date NOT NULL,
  `estado_civil_segurado` varchar(15) NOT NULL,
  `profissao_segurado` varchar(100) NOT NULL,
  `email_segurado` varchar(100) NOT NULL,
  `senha_segurado` varchar(30) NOT NULL,
  `celular_segurado` varchar(15) NOT NULL,
  `reside_com_jovens` varchar(3) DEFAULT NULL,
  `utiliza_veiculo_jovens` varchar(3) DEFAULT NULL,
  `cep_pernoite` varchar(9) DEFAULT NULL,
  `garagem_residencia` tinyint(1) DEFAULT NULL,
  `garagem_trabalho` tinyint(1) DEFAULT NULL,
  `garagem_escola` tinyint(1) DEFAULT NULL,
  `tipo_residencia` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `cpf_segurado`, `data_nascimento_segurado`, `estado_civil_segurado`, `profissao_segurado`, `email_segurado`, `senha_segurado`, `celular_segurado`, `reside_com_jovens`, `utiliza_veiculo_jovens`, `cep_pernoite`, `garagem_residencia`, `garagem_trabalho`, `garagem_escola`, `tipo_residencia`) VALUES
(25, '111.111.111-11', '2024-11-23', 'solteiro', 'ator', 'teste@1', 'teste', '(21) 23343-4343', 'sim', 'Par', '23344-567', 1, 0, 0, 'casa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL,
  `marca_modelo` varchar(100) NOT NULL,
  `ano_fabricacao` varchar(9) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `chassi` varchar(17) NOT NULL,
  `uso_veiculo` varchar(50) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `veiculos`
--

INSERT INTO `veiculos` (`id`, `marca_modelo`, `ano_fabricacao`, `placa`, `chassi`, `uso_veiculo`, `cliente_id`) VALUES
(25, 'ford', '2222/2222', '1313232A', 'testando', 'Particular', 25);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_id` (`cliente_id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `fk_cliente_id` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);

--
-- Restrições para tabelas `veiculos`
--
ALTER TABLE `veiculos`
  ADD CONSTRAINT `veiculos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
