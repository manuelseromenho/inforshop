-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Máquina: sql300.byethost7.com
-- Data de Criação: 12-Dez-2015 às 06:38
-- Versão do servidor: 5.6.25-73.1
-- versão do PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `b7_15612799_inforshop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) DEFAULT NULL,
  `pass` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `assistencias`
--

CREATE TABLE IF NOT EXISTS `assistencias` (
  `id_Assistencia` int(4) NOT NULL AUTO_INCREMENT,
  `descricaoAssistencia` varchar(200) DEFAULT NULL,
  `descricaoEquipamento` varchar(200) DEFAULT NULL,
  `dataEntrada` date DEFAULT NULL,
  `dataSaida` date DEFAULT NULL,
  `quantidade` int(10) DEFAULT NULL,
  `valorTotal` float DEFAULT NULL,
  `id_Cliente` int(4) DEFAULT NULL,
  `id_Func` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_Assistencia`),
  KEY `id_Cliente` (`id_Cliente`),
  KEY `id_Func` (`id_Func`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `assistencias`
--

INSERT INTO `assistencias` (`id_Assistencia`, `descricaoAssistencia`, `descricaoEquipamento`, `dataEntrada`, `dataSaida`, `quantidade`, `valorTotal`, `id_Cliente`, `id_Func`) VALUES
(1, 'Limpeza de Disco', 'PC HP', '0000-00-00', NULL, 4, 25.99, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_Categoria` int(4) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_Categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_Categoria`, `categoria`) VALUES
(1, 'Acessórios'),
(2, 'Componentes'),
(3, 'Discos Rigidos'),
(4, 'Portáteis'),
(5, 'Impressora'),
(6, 'Periféricos'),
(7, 'Armazenamento'),
(8, 'Processadores'),
(9, 'Software'),
(10, 'Tablets');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id_Cliente` int(4) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(50) DEFAULT NULL,
  `moradaCliente` varchar(100) DEFAULT NULL,
  `telefoneCliente` int(9) DEFAULT NULL,
  `emailCliente` varchar(100) DEFAULT NULL,
  `nifCliente` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id_Cliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_Cliente`, `nomeCliente`, `moradaCliente`, `telefoneCliente`, `emailCliente`, `nifCliente`) VALUES
(1, 'Pedro Ribeiro', 'Rua do Girassol', 912144525, 'pedroRibeiro@gmail.com', '165445212'),
(2, 'Vanda Miranda', 'Rua das Garças', 965548485, 'vmiranda@gmail.com', '175423522'),
(3, 'Vasco Palmeirim', 'Avenida de Ceuta', 911452368, 'palmeirim2011@hotmail.com', '133547212'),
(4, 'Nuno Markl', 'Avenida 25 Abril', 935442145, 'marklnuno@gmail.com', '122110123'),
(5, 'Pedro Miranda', 'Rua Pernas Longas', 912525445, 'pedroMiranda@gmail.com', '123456789'),
(6, 'Rita Ratatui', 'Rua dos Poetas', 914152525, 'rita_ratatui@outlook.com', '198765432'),
(7, 'Diogo Martins', 'Rua das Gaivotas', 912345678, 'dmartins@gmail.com', '19874324'),
(8, 'Patricia Bentes', 'Avenida Lisboa', 919030971, 'patriciabentes@hotmail.com', '144752532'),
(9, 'Mariana Martins', 'Avenida Lisboa', 911954433, 'mmartins@gmail.com', '144752465'),
(10, 'Filipe Pinto', 'Rua dos Poetas', 964454544, 'filipePinto@gmail.com', '121441236'),
(11, 'Hugo Santos', 'Rua Luis Camões', 913508356, 'hsantos@gmail.com', '145544658');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comprar`
--

CREATE TABLE IF NOT EXISTS `comprar` (
  `id_Compra` int(4) NOT NULL AUTO_INCREMENT,
  `id_Produto` int(4) DEFAULT NULL,
  `id_Cliente` int(4) DEFAULT NULL,
  `dataCompra` varchar(10) DEFAULT NULL,
  `quantidade` int(5) DEFAULT NULL,
  `precoTotal` float DEFAULT NULL,
  PRIMARY KEY (`id_Compra`),
  KEY `id_Produto` (`id_Produto`),
  KEY `id_Cliente` (`id_Cliente`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `efetuarServico`
--

CREATE TABLE IF NOT EXISTS `efetuarServico` (
  `id_EfetuaServico` int(4) NOT NULL AUTO_INCREMENT,
  `id_Assistencia` int(4) DEFAULT NULL,
  `id_Servico` int(4) DEFAULT NULL,
  `id_Func` int(4) DEFAULT NULL,
  `estado` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_EfetuaServico`),
  KEY `id_Assistencia` (`id_Assistencia`),
  KEY `id_Servico` (`id_Servico`),
  KEY `id_Func` (`id_Func`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `func`
--

CREATE TABLE IF NOT EXISTS `func` (
  `id_Func` int(4) NOT NULL AUTO_INCREMENT,
  `nomeFunc` varchar(50) DEFAULT NULL,
  `moradaFunc` varchar(100) DEFAULT NULL,
  `telefoneFunc` int(9) DEFAULT NULL,
  `emailFunc` varchar(50) DEFAULT NULL,
  `nifFunc` varchar(9) DEFAULT NULL,
  `dataNascFunc` varchar(10) DEFAULT NULL,
  `dataEntradaServico` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_Func`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `func`
--

INSERT INTO `func` (`id_Func`, `nomeFunc`, `moradaFunc`, `telefoneFunc`, `emailFunc`, `nifFunc`, `dataNascFunc`, `dataEntradaServico`) VALUES
(1, 'Susana Estevão', 'Rua das Gaivotas', 916929105, 'a48584@ualg.pt', '144445444', '22/09/1994', '20/09/2014'),
(2, 'Valter António', 'Rua de Faro', 969191933, 'a50473@ualg.pt', '123545457', '', '20/09/2014'),
(3, 'Manuel Seromenho', 'Rua de Quarteira', 960197420, 'a21210@ualg.pt', '143231122', '', '20/09/2010');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instalarProduto`
--

CREATE TABLE IF NOT EXISTS `instalarProduto` (
  `id_instalarProduto` int(4) NOT NULL AUTO_INCREMENT,
  `id_Produto` int(4) DEFAULT NULL,
  `id_Assistencia` int(4) DEFAULT NULL,
  `id_Servico` int(4) DEFAULT NULL,
  `quantidadeProdutos` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_instalarProduto`),
  KEY `id_Produto` (`id_Produto`),
  KEY `id_Assistencia` (`id_Assistencia`),
  KEY `id_Servico` (`id_Servico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

CREATE TABLE IF NOT EXISTS `marcas` (
  `id_Marca` int(4) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_Marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`id_Marca`, `marca`) VALUES
(1, 'HP'),
(2, 'ASUS'),
(3, 'ACER'),
(4, 'SAMSUNG'),
(5, 'EPSON'),
(6, 'SONY'),
(7, 'AMD'),
(8, 'LG'),
(9, 'INTEL'),
(10, 'MICROSOFT');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id_Produto` int(4) NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(50) DEFAULT NULL,
  `num_Serie` varchar(10) DEFAULT NULL,
  `stock` int(4) DEFAULT NULL,
  `precoProduto` float DEFAULT NULL,
  `id_Subcategoria` int(4) DEFAULT NULL,
  `id_Marca` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_Produto`),
  KEY `id_Subcategoria` (`id_Subcategoria`),
  KEY `id_Marca` (`id_Marca`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_Produto`, `nomeProduto`, `num_Serie`, `stock`, `precoProduto`, `id_Subcategoria`, `id_Marca`) VALUES
(1, 'Pen Sony 16 GB', '12154521', 3, 16.99, 16, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE IF NOT EXISTS `servicos` (
  `id_Servico` int(4) NOT NULL AUTO_INCREMENT,
  `tipoServico` varchar(50) DEFAULT NULL,
  `precoServico` float DEFAULT NULL,
  `tempoEstimadoServico` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_Servico`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id_Servico`, `tipoServico`, `precoServico`, `tempoEstimadoServico`) VALUES
(1, 'Servidores', 50.99, '160'),
(2, 'Software Aplicacional', 59.99, '20'),
(3, 'Migração Dados', 20.59, '30'),
(4, 'Reconfiguração Equipamentos', 0, ''),
(5, 'Manutenção e Reparação equipamentos', 0, ''),
(6, 'Identificação e Resolução Problemas', 0, ''),
(7, 'Recuperação de Dados', 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id_Subcategoria` int(4) NOT NULL AUTO_INCREMENT,
  `subcategoria` varchar(20) DEFAULT NULL,
  `id_Categoria` int(4) DEFAULT NULL,
  PRIMARY KEY (`id_Subcategoria`),
  KEY `id_Categoria` (`id_Categoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `subcategorias`
--

INSERT INTO `subcategorias` (`id_Subcategoria`, `subcategoria`, `id_Categoria`) VALUES
(1, 'Limpeza', 1),
(2, 'Cabos', 1),
(3, 'Tapetes Rato', 1),
(4, 'Coolers', 1),
(5, 'Caixas', 2),
(6, 'Fonte Alimentação', 2),
(7, 'Memorias RAM', 2),
(8, 'Placa Gráfica', 2),
(9, 'Placa Rede', 2),
(10, 'Menos 80 GB', 3),
(11, '80GB - 500 GB', 3),
(12, '500 GB - 1 TB', 3),
(13, 'Mais 1 TB', 3),
(14, 'Cartões Memória', 7),
(15, 'CD / DVD', 7),
(16, 'Pen Drives', 7),
(17, 'AMD Phenom', 8),
(18, 'Intel Celeron', 8),
(19, 'Intel Core', 8),
(20, 'Intel Pentium', 8),
(21, 'Intel Quad Core', 8),
(22, 'Sistemas Operativos', 9),
(23, 'Anti Virus', 9),
(24, 'Adobe', 9),
(25, 'Redes', 9),
(26, 'Aprendizagem', 9),
(27, 'Microsoft', 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
