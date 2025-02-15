-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Jan-2023 às 23:42
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
-- Banco de dados: `stand`
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
('admin', '1', 1673199644, NULL, NULL),
('customer', '13', 1673520192, NULL, NULL),
('customer', '14', 1673642420, NULL, NULL),
('customer', '15', 1673642537, NULL, NULL),
('customer', '16', 1673642565, NULL, NULL),
('customer', '17', 1673882180, NULL, NULL),
('customer', '18', 1673882330, NULL, NULL),
('customer', '19', 1673884605, NULL, NULL),
('customer', '20', 1673884891, NULL, NULL),
('customer', '21', 1674221762, NULL, NULL),
('customer', '23', 1674222306, NULL, NULL),
('customer', '24', 1674222339, NULL, NULL),
('customer', '6', 1673200116, NULL, NULL),
('employee', '4', 1673199874, NULL, NULL),
('manager', '2', 1673199728, NULL, NULL);

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
(9, 'Admin', 'admin@gmail.com', 'test drive cancelado', 'Gostaria de saber pqq o meu teste drive foi cancelado.');

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` text NOT NULL,
  `idVehicle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `image`
--

INSERT INTO `image` (`id`, `path`, `idVehicle`) VALUES
(19, '/vehicles/yDXL1Rt68yUd1uH71AFw7CXUDpW3mhjG/bmw_lado.JPG', 13),
(20, '/vehicles/mpyXV73Xt7IMKYbEYtBNk3AOJxnl8mNJ/bmw_tras.JPG', 13),
(21, '/vehicles/Wse0DmmqM67asIU84scNlqbl65VkFm_t/bmw_dentro.JPG', 13);

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
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserve`
--

CREATE TABLE `reserve` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idVehicle` int(11) NOT NULL,
  `number` varchar(9) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `morada` varchar(30) NOT NULL,
  `cc` text NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `idAssigned_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(67, '23-01-2023', '15:00', 'Tenho interesse em comprar o veiculo.', 1, 5, 'Por ver'),
(69, '23-01-2023', '12:00', 'Novo teste', 6, 5, 'Por ver');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isEmployee` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `name`, `isEmployee`) VALUES
(1, 'admin', 'rb-cvxfdpZajPt0ngy16Ld3mqTxDmOaP', '$2y$13$yl.EHTbbUmKd2oMxLdJBdepS7SBOp.nDJSso0DBE2Rhz.IrhFb6lm', NULL, 'admin@gmail.com', 10, 1673199644, 1673650089, 'fFPI_OsUTJO1a0eaPphlSdnfY7401JgY_1673199644', 'Admin', 0),
(2, 'manager1', 'ceB2M3Asm6X9tQjNUSrV9oHuoIqj-b1z', '$2y$13$fM9GaCvBIBgBKRbwe1ieiurtyIa9JnEPDOCQtm1P..EZSCVyE1T8G', NULL, 'manager1@gmail.com', 10, 1673199728, 1673199768, 'EonKTWr4itqJINCeOuSzOSe_lzzkbwqW_1673199727', 'Manager1', 1),
(4, 'funcionario1', 'PL7VDO6TkaFP2J0R39YoKk7ZMjHZv_Jn', '$2y$13$jttmmuuIchjkhP.Y6w7zteCK.HaBXOhUgSpwMP8sBm7OGcza6gLJ.', NULL, 'func1@gmail.com', 10, 1673199874, 1673360830, 'PfeAC7eST1a20q8m1m1uKXHeGNDsdkqO_1673199874', 'Funcionário1', 1),
(6, 'User1', '0zwEXTda5fuwc5ZEZo18E5K5eNgJuPZT', '$2y$13$U1yYqvXD8NlNOyWtcKVnuuzKXazNmZGImPZ9SQeWwSls86yukty26', NULL, 'user1@gmail.com', 10, 1673200116, 1673204596, 'p3kHyQMKfvSidVdHkEZLk3sR56FjiGg8_1673200116', 'User', 0);

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
(5, NULL, NULL, '', 'Cabrio', 'Diesel', '100000', 2000, 'Verde', '<p>Novo <strong>Audi A5 ao melhor pre&ccedil;o</strong></p>\r\n', 2022, 5, 'Automático', 55000, '/vehicles/cMSg-1wevSc7qQ_f8tqSDfMoyFT0U_dp/audi_5.JPG', 1, 'Novo Audi A5', 'AU-55-BO', 180, 4, 6, 'Disponível'),
(6, NULL, NULL, '', 'Utilitário', 'Diesel', '60000', 2000, 'Preto', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci. Donec pellentesque egestas eros. Integer cursus, augue in cursus faucibus, eros pede bibendum sem, in tempus tellus justo quis ligula. Etiam eget tortor. Vestibulum rutrum, est ut placerat elementum, lectus nisl aliquam velit, tempor aliquam eros nunc nonummy metus. In eros metus, gravida a, gravida sed, lobortis id, turpis. Ut ultrices, ipsum at venenatis fringilla, sem nulla lacinia tellus, eget aliquet turpis mauris non enim. Nam turpis. Suspendisse lacinia. Curabitur ac tortor ut ipsum egestas elementum. Nunc imperdiet gravida mauris.</p>\r\n', 2010, 5, 'Manual', 45000, '/vehicles/g9y2rLnyeRID9wD0ZdAGYmclTzn-3j2I/mercedes.JPG', 0, 'Mercedes Classe A', 'ME-22-BO', 180, 16, 23, 'Vendido'),
(8, NULL, NULL, '', 'Desportivo', 'Gasolina', '60000', 2000, 'Azul', '<p>Audi A3Audi A3Audi A3Audi A3Audi A3Audi A3Audi A3Audi A3</p>\r\n', 2018, 4, 'Manual', 35000, '/vehicles/I40vgVyfBeqoZWSinHZRZUE29XqKN7nN/audi_a3.JPG', 1, 'Audi A3', 'AD-33-BO', 170, 4, 5, 'Disponível'),
(13, NULL, NULL, '', 'Desportivo', 'Gasolina', '5000', 2000, 'Branco', '<p>Novo bmw&nbsp;</p>\r\n', 2022, 4, 'Automático', 70000, '/vehicles/5lj1HKUh5xfqzDZHuce-7W94ZluKaxe4/bmw.JPG', 1, 'BMW Série 3', 'BM-22-AA', 180, 7, 14, 'Disponível');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `idUser_seller` int(11) NOT NULL,
  `idUser_buyer` int(11) DEFAULT NULL,
  `idVehicle` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `number` varchar(11) NOT NULL,
  `nif` varchar(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id`, `idUser_seller`, `idUser_buyer`, `idVehicle`, `price`, `comment`, `number`, `nif`, `address`, `name`) VALUES
(8, 1, 1, 6, '40000', '', '910000000', '999999999', 'Estrada de torres, nº20', 'José Ramos');

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
-- Índices para tabela `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_vehicle` (`idVehicle`);

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
-- Índices para tabela `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `testdrive`
--
ALTER TABLE `testdrive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `vendauser`
--
ALTER TABLE `vendauser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Limitadores para a tabela `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `id_vehicle` FOREIGN KEY (`idVehicle`) REFERENCES `vehicle` (`id`);

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
