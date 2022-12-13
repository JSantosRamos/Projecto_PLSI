-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Dez-2022 às 15:43
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `yii2teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`, `name`, `email`) VALUES
('admin', '25', 1668009515, NULL, NULL),
('customer', '33', 1669042157, NULL, NULL),
('customer', '37', 1670233363, NULL, NULL),
('customer', '38', 1670233522, NULL, NULL),
('employee', '35', 1669042785, NULL, NULL),
('employee', '36', 1669726711, NULL, NULL),
('manager', '34', 1669042692, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'RoleAdmin', NULL, NULL, 1667990526, 1667990526),
('canAccessBackOffice', 2, 'Have permission to access BackOffice', NULL, NULL, 1667990525, 1667990525),
('canCreateAllUsers', 2, 'Have permission to create all users types', NULL, NULL, 1667990525, 1667990525),
('canCreateCustomer', 2, 'Have permission to create user with customer permissions', NULL, NULL, 1667990525, 1667990525),
('canCreateEmployee', 2, 'Have permission to create user with employee permissions', NULL, NULL, 1667990525, 1667990525),
('customer', 1, 'Role', NULL, NULL, 1667990525, 1667990525),
('employee', 1, 'Role', NULL, NULL, 1667990525, 1667990525),
('manager', 1, 'Role', NULL, NULL, 1667990525, 1667990525);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'canCreateAllUsers'),
('admin', 'manager'),
('employee', 'canAccessBackOffice'),
('employee', 'canCreateCustomer'),
('employee', 'customer'),
('manager', 'canCreateEmployee'),
('manager', 'employee');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(3, 'Alfa Romeo'),
(4, 'Audi'),
(5, 'Abarth'),
(6, 'Aston Martin'),
(7, 'BMW'),
(8, 'Citroen'),
(9, 'Cupra'),
(10, 'Volvo'),
(11, 'Fiat'),
(12, 'Kia'),
(13, 'Lexus'),
(14, 'Land Rover'),
(15, 'Opel'),
(16, 'Mercedes'),
(17, 'SEAT');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contactuser`
--

CREATE TABLE `contactuser` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contactuser`
--

INSERT INTO `contactuser` (`id`, `name`, `email`, `subject`, `body`) VALUES
(1, 'aaaaa', 'aaaa@gmail.com', 'dqdq', 'qdqdqdqdq'),
(2, 'gwgwgw', 'gwgwgw@gmail.com', 'fafafa', 'fafafa'),
(3, 'gwgwgw', 'gwgwgw@gmail.com', 'fafafa', 'fafafa'),
(4, 'fafafafa', 'fafafaf@gmailcom', 'fafafa', 'fafafa'),
(5, 'ddada', 'fafafaf@gmailcom', 'dada', 'dada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cost`
--

CREATE TABLE `cost` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `valor` double NOT NULL,
  `file` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cost`
--

INSERT INTO `cost` (`id`, `idUser`, `title`, `valor`, `file`) VALUES
(3, 25, 'Fatura ', 100, '/costs/UXw_imZih-3XJd-PbS3yqVTo_TCQ1u6M/IPL-TeSP-PSI-MDS-2223-Proposta_José Ramos.pdf'),
(4, 25, 'Fatira', 100, '/costs/OOvqUEXxhXqxaLmMGalACUHuKhkuzHnd/IPL-TeSP-PSI-MDS-2223-Proposta_José Ramos (2).pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1667386735),
('m130524_201442_init', 1667386744),
('m140506_102106_rbac_init', 1667389516),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1667389516),
('m180523_151638_rbac_updates_indexes_without_prefix', 1667389517),
('m190124_110200_add_verification_token_column_to_user_table', 1667386744),
('m200409_110543_rbac_update_mssql_trigger', 1667389517);

-- --------------------------------------------------------

--
-- Estrutura da tabela `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `idBrand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `model`
--

INSERT INTO `model` (`id`, `name`, `idBrand`) VALUES
(3, 'Mito', 3),
(4, 'Giulia', 3),
(5, 'A3', 4),
(6, 'A5', 4),
(9, '500C', 5),
(10, '595', 5),
(11, 'Cygnet', 6),
(12, 'Série 1', 7),
(13, 'Série 2', 7),
(14, 'Série 3', 7),
(15, '2CV', 8),
(16, 'Leon', 9),
(17, 'V50', 10),
(18, '124', 11),
(19, 'Ceed', 12),
(20, 'NX', 13),
(21, 'Discovery', 14),
(22, 'Astra', 15),
(23, 'Classe A', 16),
(24, 'Classe C', 16),
(25, 'Ibiza', 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTask` int(11) DEFAULT NULL,
  `idproposta_venda` int(11) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `status` enum('Por iniciar','Em Processo','Finalizado') NOT NULL,
  `idCreated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idAssigned_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `task`
--

INSERT INTO `task` (`id`, `type`, `date`, `description`, `status`, `idCreated_by`, `created_at`, `idAssigned_to`) VALUES
(17, 'Testedrive', '01-Dec-2022 14:10', 'jfjjsfsfsfs', 'Em Processo', 34, '2022-12-05 15:03:51', 36),
(18, 'Dia1', '01-Dec-2022 17:10', 'Dia1', 'Por iniciar', 34, '2022-12-05 15:03:34', 35),
(19, 'Tes', '30-Nov-2022 11:20', 'fwfwgw', 'Por iniciar', 25, '2022-12-05 14:52:41', 36);

-- --------------------------------------------------------

--
-- Estrutura da tabela `testdrive`
--

CREATE TABLE `testdrive` (
  `id` int(11) NOT NULL,
  `date` varchar(12) NOT NULL,
  `time` enum('08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00') NOT NULL,
  `description` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idVehicle` int(11) NOT NULL,
  `status` enum('Por ver','Aceite','Recusado','Aguardando Resposta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `testdrive`
--

INSERT INTO `testdrive` (`id`, `date`, `time`, `description`, `idUser`, `idVehicle`, `status`) VALUES
(41, '12/12/2022', '10:00', 'Gosto muito', 25, 13, 'Aceite'),
(42, '14-12-2022', '12:00', 'dwdwdwdw', 25, 14, 'Recusado'),
(43, '22-12-2022', '12:00', 'cscvscsvsvsv', 25, 14, 'Por ver');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nif` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isEmployee` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `name`, `nif`, `number`, `isEmployee`) VALUES
(25, 'admin', 'UfbsiYCY7jReKod0nEc_efANrzuW6BTV', '$2y$13$VF3xZ4fjUF5ah6w7ktVEJew.YriRywqyI/HuMKRFvlJJ53S0yW7B2', NULL, 'admin@gmail.com', 10, 1668009515, 1670771457, 'QoUV1UPBevCKmuYk8dwtcilfSoJzpQWc_1668009515', 'Admin', '000564586', '921987564', 1),
(33, 'PauloSantos', 'aT-ZhEMzsscFC742i7G5NXBQPrTiTPU8', '$2y$13$0OmBTh9fom8WykcpyHPmyeG3GdhfWa3GxcclDzWk8cziEGlQHPN12', NULL, 'paulosantos@gmail.com', 10, 1669042157, 1669042157, 'ZP4jvrfDgmQfU149WQwOq6TVkeAwG-Sc_1669042156', 'Paulo Santos', '999888444', '915303789', 0),
(34, 'manager', 'Bt9pOn0v530ayWfwnct0nMXLoOB2r0wc', '$2y$13$w3oh4glXZLPft7i1hLHmROXqQxdx5Y9Lal5.T.KLVwEylyVmT2lSu', NULL, 'manager@gmail.com', 10, 1669042692, 1669914662, 'VCZGH2EexQErr1iiT6u_DJAYTINUOdnV_1669042692', 'Manager', '111222333', '912788544', 1),
(35, 'RuiFerreira', 'FRGlroqvsakiaZ6geeOB4Nk4Lnazp2Ls', '$2y$13$WLB0OwXjMdBnrjDeZhX8IeYibq1Jb1SJc03A17a9pcaYt19lui.g.', NULL, 'ruiferreira@gmail.com', 10, 1669042785, 1669905221, 'j5aeW6v4_iC0tJPOcSTgfnYH240l33_v_1669042784', 'Rui Ferreira', '098776563', '923455888', 1),
(36, 'RGomes', 'GyMVZ1a8Mjd3RBpXiLvY9S7VW-K08zOo', '$2y$13$VAwtoyNLqMJ.bSe9Zoxi2OgjtLSvnomRU1dbdLDnkuriYwRjkjkJa', NULL, 'RGomes@gmail.com', 10, 1669726711, 1669726711, '0vN-BCG4VN41Cx1FGmEmjiwOv8N003Tz_1669726710', 'Rodrigo Gomes', '097777777', '910567776', 1),
(37, 'adminteste123', 'TZymdHj37VbcRxfVpKmRxfK3YyVH6MLT', '$2y$13$HtdMljEEVTgCt3YsXbJ6ieOYo87njVoBkIyOQ38tLyOVfhJXr9wp2', NULL, 'adminaa@gmail.com', 10, 1670233363, 1670233363, 'tZWJ8DepA5Dv6H2YVzCqwr5EwVt81vNK_1670233363', 'Admin', NULL, NULL, 0),
(38, 'admin9999', 'oGr6QtOAYjc1lp8Ny-X4PjHZd7XB2yRX', '$2y$13$FeWy6rAx9RaCYNl7w4Lt9.8c0uftvOwWWvl0LsM88S7SVy4v23iZa', NULL, 'admin9999@gmail.com', 10, 1670233522, 1670233522, 'F_Mbf2fPDkxkHo-unc82koegRQhSoWC2_1670233522', 'admin9', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `type` enum('Cabrio','Carrinha','Desportivo','SUV','Utilitário') NOT NULL,
  `fuel` enum('Diesel','Gasolina','Elétrico','GPL','Híbrido') NOT NULL,
  `mileage` varchar(50) NOT NULL,
  `engine` int(11) NOT NULL,
  `color` enum('Branco','Preto','Cinzento','Vermelho','Laranja','Amarelo','Verde','Azul','Castanho') NOT NULL,
  `description` text NOT NULL,
  `year` int(11) NOT NULL,
  `doorNumber` int(11) NOT NULL,
  `transmission` enum('Manual','Automático') NOT NULL,
  `price` double NOT NULL,
  `image` varchar(2000) DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `plate` varchar(8) NOT NULL,
  `cv` int(11) NOT NULL,
  `idBrand` int(11) NOT NULL,
  `idModel` int(11) NOT NULL,
  `status` enum('Vendido','Reservado','Disponível') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `vehicle`
--

INSERT INTO `vehicle` (`id`, `brand`, `model`, `serie`, `type`, `fuel`, `mileage`, `engine`, `color`, `description`, `year`, `doorNumber`, `transmission`, `price`, `image`, `isActive`, `title`, `plate`, `cv`, `idBrand`, `idModel`, `status`) VALUES
(13, NULL, NULL, '', 'Carrinha', 'Diesel', '5000', 2000, 'Preto', '<p>jrjrjr</p>\r\n', 2020, 4, 'Manual', 34000, '/vehicles/cYB05NcajaJTfHrD27A011hnNdgjfmRY/Audi-A3-30tdi-17_925x520_acf_cropped.jpg', 1, 'Audiiiii', '55-CA-67', 33, 4, 5, 'Vendido'),
(14, NULL, NULL, '', 'Utilitário', 'Diesel', '5000', 2000, 'Azul', '<p>Muito Bom estado</p>\r\n', 2023, 4, 'Automático', 60000, '/vehicles/D2GV7IUUsAaJ1L0jq8xf4Z_dDZCI82UN/bmw-m-series-m2-coupe-lci-modelfinder.png', 1, 'BMW Serie 2', '55-CR-65', 180, 7, 13, 'Disponível');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `idUser_seller` int(11) NOT NULL,
  `idUser_buyer` int(11) NOT NULL,
  `idVehicle` int(11) NOT NULL,
  `Price` double NOT NULL,
  `comment` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `idUser_seller`, `idUser_buyer`, `idVehicle`, `Price`, `comment`) VALUES
(11, 25, 33, 13, 10000, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendauser`
--

CREATE TABLE `vendauser` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `price` double NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `plate` varchar(8) NOT NULL,
  `mileage` int(11) NOT NULL,
  `fuel` enum('Diesel','Gasolina','Elétrico','GPL','Híbrido') NOT NULL,
  `year` varchar(10) NOT NULL,
  `brand` varchar(20) NOT NULL,
  `model` varchar(20) NOT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `status` enum('Por ver','Em Análise','Aceite','Recusado','Aguardando Resposta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Índices para tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Índices para tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Índices para tabela `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Índices para tabela `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contactuser`
--
ALTER TABLE `contactuser`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Índices para tabela `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`idBrand`);

--
-- Índices para tabela `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `note_idTask` (`idTask`),
  ADD KEY `note_idUser` (`idUser`),
  ADD KEY `note_idPropostaVenda` (`idproposta_venda`);

--
-- Índices para tabela `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser_CreatedBy` (`idCreated_by`),
  ADD KEY `idUser_AssignedTo` (`idAssigned_to`);

--
-- Índices para tabela `testdrive`
--
ALTER TABLE `testdrive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`idUser`),
  ADD KEY `vehicle_id` (`idVehicle`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Índices para tabela `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plate` (`plate`),
  ADD KEY `id_VehicleBrand` (`idBrand`),
  ADD KEY `id_VehicleModel` (`idModel`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venda_iduser_buyer` (`idUser_buyer`),
  ADD KEY `venda_iduser_seller` (`idUser_seller`),
  ADD KEY `venda_idVehicle` (`idVehicle`);

--
-- Índices para tabela `vendauser`
--
ALTER TABLE `vendauser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid_vendauser` (`idUser`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `contactuser`
--
ALTER TABLE `contactuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `testdrive`
--
ALTER TABLE `testdrive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `vendauser`
--
ALTER TABLE `vendauser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `id_brand` FOREIGN KEY (`idBrand`) REFERENCES `brand` (`id`);

--
-- Limitadores para a tabela `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_idPropostaVenda` FOREIGN KEY (`idproposta_venda`) REFERENCES `vendauser` (`id`),
  ADD CONSTRAINT `note_idTask` FOREIGN KEY (`idTask`) REFERENCES `task` (`id`),
  ADD CONSTRAINT `note_idUser` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `idUser_AssignedTo` FOREIGN KEY (`idAssigned_to`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `idUser_CreatedBy` FOREIGN KEY (`idCreated_by`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `testdrive`
--
ALTER TABLE `testdrive`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `vehicle_id` FOREIGN KEY (`idVehicle`) REFERENCES `vehicle` (`id`);

--
-- Limitadores para a tabela `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `id_VehicleBrand` FOREIGN KEY (`idBrand`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `id_VehicleModel` FOREIGN KEY (`idModel`) REFERENCES `model` (`id`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_idVehicle` FOREIGN KEY (`idVehicle`) REFERENCES `vehicle` (`id`),
  ADD CONSTRAINT `venda_iduser_buyer` FOREIGN KEY (`idUser_buyer`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `venda_iduser_seller` FOREIGN KEY (`idUser_seller`) REFERENCES `user` (`id`);

--
-- Limitadores para a tabela `vendauser`
--
ALTER TABLE `vendauser`
  ADD CONSTRAINT `userid_vendauser` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
