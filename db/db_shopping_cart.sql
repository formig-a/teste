SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




-- banco de dados: `db_shopping_cart`

CREATE DATABASE IF NOT EXISTS `db_shopping_cart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_shopping_cart`;

-- --------------------------------------------------------

--
-- Tabela de compras
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ORDER_NO` varchar(45) NOT NULL DEFAULT '',
  `UID` int(10) unsigned NOT NULL DEFAULT '0',
  `TOTAL_AMT` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabela de produtos comprados
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `OID` int(10) unsigned NOT NULL DEFAULT '0',
  `PID` int(10) unsigned NOT NULL DEFAULT '0',
  `PNAME` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `QTY` int(10) unsigned NOT NULL DEFAULT '0',
  `TOTAL` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabela de produtos
--

CREATE TABLE IF NOT EXISTS `products` (
  `PID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PRODUCT` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `IMAGE` varchar(45) NOT NULL DEFAULT '',
  `DESCRIPTION` text,
  `QUANTITY` varchar(5),
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Inserindo os produtos
--

INSERT INTO `products` (`PID`, `PRODUCT`, `PRICE`, `IMAGE`, `DESCRIPTION`, `QUANTITY`) VALUES
(2, 'Produto 1', 100.00, '2.jpg', 'Descrição teste',80),
(3, 'Produto 2', 75.00, '3.jpg', 'Descrição teste',50),
(4, 'Produto 3', 45.00, '4.jpg', 'Descrição teste',45),
(5, 'Produto 4', 85.00, '5.jpg', 'Descrição teste',0);

-- --------------------------------------------------------

--
-- Tabela para os usuários
--

CREATE TABLE IF NOT EXISTS `users` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(150) NOT NULL DEFAULT '',
  `CONTACT` varchar(150) NOT NULL DEFAULT '',
  `ADDRESS` text,
  `CITY` varchar(45) NOT NULL DEFAULT '',
  `PINCODE` varchar(45) NOT NULL DEFAULT '',
  `EMAIL` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Tabela para cadastro
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  id_usuario int AUTO_INCREMENT PRIMARY KEY,
  nome varchar(30),
  cidade varchar(50),
  telefone varchar (20),
  endereco varchar (100),
  cep varchar (15)
);