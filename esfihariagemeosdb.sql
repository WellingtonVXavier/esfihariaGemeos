
CREATE DATABASE esfihariagemeosdb;


CREATE TABLE `cargo`
(
  `Id` int
(11) NOT NULL,
  `NomeCargo` varchar
(50) DEFAULT NULL,
  `Descricao` varchar
(150) DEFAULT NULL,
  `Ativo` bit
(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cargo` (`
Id`,
`NomeCargo
`, `Descricao`, `Ativo`) VALUES
(1, 'Gerente', 'Responsável pela gerência', b'1'),
(2, 'Caixa', 'Responsável pelo Caixa', b'1');

CREATE TABLE `cliente`
(
  `Id` int
(11) NOT NULL,
  `ContadorBloqueio` int
(11) NOT NULL,
  `NomeCompleto` varchar
(150) DEFAULT NULL,
  `DataNascimento` date DEFAULT NULL,
  `CPF` varchar
(14) DEFAULT NULL,
  `Telefone` varchar
(11) DEFAULT NULL,
  `Ativo` bit
(1) DEFAULT NULL,
  `Senha` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cliente` (`
Id`,
`ContadorBloqueio
`, `NomeCompleto`, `DataNascimento`, `CPF`, `Telefone`, `Ativo`, `Senha`) VALUES
(1, 0, 'Fabio Correia', '1989-10-17', '123', '91234-5678', b'1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(2, 0, 'Enzo', '2004-11-01', '123.4', '(11) 91234-', b'1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(3, 0, 'Guilherme', '2002-01-28', '517.987.145-63', '(11) 99023-', b'1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(4, 0, 'Sarah', '1996-09-09', '450.198.788-54', '(11) 95168-', b'1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

CREATE TABLE `funcionario`
(
  `Id` int
(11) NOT NULL,
  `IdCargo` int
(11) NOT NULL,
  `ContadorBloqueio` int
(11) NOT NULL,
  `NomeCompleto` varchar
(150) DEFAULT NULL,
  `CPF` varchar
(14) DEFAULT NULL,
  `Ativo` bit
(1) DEFAULT NULL,
  `Senha` varchar
(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `funcionario` (`
Id`,
`IdCargo
`, `ContadorBloqueio`, `NomeCompleto`, `CPF`, `Ativo`, `Senha`) VALUES
(1, 1, 0, 'João Franscisco de Sales', '123.4', b'1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3'),
(2, 2, 0, 'admin', '123', b'1', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3');

CREATE TABLE `itempedido`
(
  `Id` int
(11) NOT NULL,
  `IdPedido` int
(11) NOT NULL,
  `IdProduto` int
(11) NOT NULL,
  `QuantidadeProduto` int
(11) NOT NULL,
  `ValorItem` decimal
(10,0) DEFAULT NULL,
  `FlgCancelado` bit
(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `itempedido` (`
Id`,
`IdPedido
`, `IdProduto`, `QuantidadeProduto`, `ValorItem`, `FlgCancelado`) VALUES
(1, 1, 1, 2, '7', b'0'),
(2, 1, 2, 1, '8', b'0'),
(3, 2, 2, 1, '8', b'0'),
(4, 2, 2, 1, '8', b'1'),
(5, 2, 1, 1, '7', b'1'),
(6, 2, 1, 1, '7', b'1'),
(7, 2, 1, 2, '14', b'0'),
(8, 2, 2, 2, '16', b'0'),
(9, 1, 1, 2, '14', b'0'),
(10, 1, 1, 5, '35', b'0'),
(11, 1, 2, 5, '40', b'0'),
(12, 1, 2, 5, '40', b'1');

CREATE TABLE `pedido`
(
  `Id` int
(11) NOT NULL,
  `IdFuncionario` int
(11) NOT NULL,
  `IdCliente` int
(11) NOT NULL,
  `IdStatus` int
(11) NOT NULL,
  `Data` date DEFAULT NULL,
  `ValorTotal` decimal
(10,2) DEFAULT NULL,
  `FlgAbertoFechado` bit
(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pedido` (`
Id`,
`IdFuncionario
`, `IdCliente`, `IdStatus`, `Data`, `ValorTotal`, `FlgAbertoFechado`) VALUES
(1, 1, 1, 1, '2023-10-19', '104.00', b'0'),
(2, 1, 1, 2, '2023-10-19', '38.00', b'0'),
(3, 1, 1, 1, '2023-11-07', '21.00', b'0'),
(4, 1, 1, 1, '2023-11-07', '45.00', b'0'),
(5, 1, 1, 1, '2023-11-07', '15.00', b'0'),
(6, 1, 1, 1, '2023-11-07', NULL, b'0'),
(7, 1, 1, 1, '2023-11-07', '28.00', b'0'),
(8, 1, 1, 1, '2023-11-07', NULL, b'0'),
(9, 1, 1, 1, '2023-11-07', '35.00', b'0'),
(10, 1, 1, 1, '2023-11-07', '28.00', b'0'),
(11, 1, 1, 1, '2023-11-07', '28.00', b'0'),
(12, 1, 1, 1, '2023-11-07', '28.00', b'0'),
(13, 1, 1, 1, '2023-11-07', '35.00', b'0'),
(14, 1, 1, 1, '2023-11-07', '28.00', b'0'),
(15, 1, 1, 1, '2023-11-07', '24.00', b'0'),
(16, 1, 3, 1, '2023-11-07', '14.00', b'0');

CREATE TABLE `produto`
(
  `Id` int
(11) NOT NULL,
  `Nome` varchar
(150) DEFAULT NULL,
  `Descricao` varchar
(150) DEFAULT NULL,
  `Valor` decimal
(10,2) DEFAULT NULL,
  `Ativo` bit
(1) DEFAULT NULL,
  `imagem` varchar
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `produto` (`
Id`,
`Nome
`, `Descricao`, `Valor`, `Ativo`, `imagem`) VALUES
(1, 'Mussarela', 'Esfiha de Mussarela', '7.00', b'1', 'esfiha-de-queijo_receita.jpg'),
(2, 'Carne e Queijo', 'Esfiha de Carne com Mussarela', '8.00', b'1', 'esfirra-de-carne.jpg'),
(3, 'aaaa', 'aaaa', NULL, b'1', 'esfiha-frango.jpg'),
(4, 'Calabresa', 'Esfiha de Calabresa', '8.00', b'1', 'calabresa.jpg');


CREATE TABLE `status`
(
  `Id` int
(11) NOT NULL,
  `Descricao` varchar
(150) DEFAULT NULL,
  `FlgAbertoFechado` bit
(1) NOT NULL,
  `Ativo` bit
(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `status` (`
Id`,
`Descricao
`, `FlgAbertoFechado`, `Ativo`) VALUES
(1, 'Em Aberto', b'0', b'1'),
(2, 'Preparando', b'0', b'1'),
(3, 'Pronto', b'0', b'1'),
(4, 'Entregue', b'1', b'1'),
(5, 'Cancelado', b'1', b'1');
