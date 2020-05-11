-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Maio-2020 às 00:01
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `portalciclo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bolemat`
--

DROP TABLE IF EXISTS `bolemat`;
CREATE TABLE IF NOT EXISTS `bolemat` (
  `bolemat_id` int(11) NOT NULL AUTO_INCREMENT,
  `bolemat_professor` int(11) DEFAULT NULL,
  `bolemat_cliente` int(11) DEFAULT NULL,
  `bolemat_disciplina` int(11) DEFAULT NULL,
  `bolemat_ano` int(11) DEFAULT NULL,
  `bolemat_n1` varchar(20) DEFAULT '&nbsp;',
  `bolemat_n2` varchar(20) DEFAULT '&nbsp;',
  `bolemat_n3` varchar(20) DEFAULT '&nbsp;',
  `bolemat_n4` varchar(20) DEFAULT '&nbsp;',
  `bolemat_r1` varchar(20) DEFAULT '&nbsp;',
  `bolemat_r2` varchar(20) DEFAULT '&nbsp;',
  `bolemat_r3` varchar(20) DEFAULT '&nbsp;',
  `bolemat_r4` varchar(20) DEFAULT '&nbsp;',
  `bolemat_m1` varchar(20) DEFAULT '&nbsp;',
  `bolemat_m2` varchar(20) DEFAULT '&nbsp;',
  `bolemat_m3` varchar(20) DEFAULT '&nbsp;',
  `bolemat_serie` int(11) DEFAULT NULL,
  `bolemat_boletim` int(11) DEFAULT NULL,
  PRIMARY KEY (`bolemat_id`),
  KEY `fk_bb` (`bolemat_boletim`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bolemat`
--

INSERT INTO `bolemat` (`bolemat_id`, `bolemat_professor`, `bolemat_cliente`, `bolemat_disciplina`, `bolemat_ano`, `bolemat_n1`, `bolemat_n2`, `bolemat_n3`, `bolemat_n4`, `bolemat_r1`, `bolemat_r2`, `bolemat_r3`, `bolemat_r4`, `bolemat_m1`, `bolemat_m2`, `bolemat_m3`, `bolemat_serie`, `bolemat_boletim`) VALUES
(6, 1, 13, 1, 2013, '7', '7', '7', '7', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 22, 11),
(7, 1, 13, 4, 2013, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 22, 11),
(8, 1, 19, 1, 2013, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 22, 12),
(10, 3, 43, 5, 2014, '1', '3', '5', '7', '2', '4', '6', '8', '10', '10', '10', 22, 21),
(11, 3, 19, 5, 2014, '1', '3', '5', '7', '2', '4', '6', '8', '9', '0', '1', 22, 22),
(12, 3, 13, 5, 2014, '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '1', 22, 23),
(13, 3, 43, 3, 2014, '5.5', '8.0', '4.5', '9', '2', '0', '2', '5', '', '5', '18', 22, 21),
(14, 3, 30, 3, 2014, '3', '8', '4', '2', '2', '5', '7', '2', '2', '2', '2', 22, 24),
(15, 3, 19, 4, 2014, '9', '9', '9', '9', '1', '2', '3', '4', '', '9', '25', 22, 22),
(16, 3, 30, 4, 2014, '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', '5', 22, 24),
(17, 3, 19, 3, 2014, '2', '2', '3', '3', '3', '2', '2', '2', '3', '2', '30', 22, 22),
(18, 3, 13, 4, 2014, '5', '5', '5', '5', '5', '5', '5', '5', '55', '5', '5', 22, 23),
(19, 3, 21, 4, 2014, '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', '6', 22, 25),
(20, 3, 35, 4, 2014, '7', '7', '7', '7', '7', '7', '7', '77', '7', '7', '7', 22, 26),
(21, 3, 40, 4, 2014, '0', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', 22, 27),
(22, 3, 25, 4, 2014, '1', '1', '1', '1', '1', '1', '1', '1', '10', '11', '1', 22, 28),
(23, 3, 43, 4, 2014, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 22, 21),
(24, 3, 30, 5, 2014, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', 22, 24),
(25, 3, 21, 5, 2014, '10', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', 22, 25),
(26, 3, 35, 5, 2014, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', 22, 26),
(27, 3, 40, 5, 2014, '1', '1', '1', '1', '1', '1', '1', '1', '1', '11', '00', 22, 27),
(28, 3, 13, 7, 2014, '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', '&nbsp;', 22, 23),
(29, 3, 19, 7, 2014, '6', '6', '10', '6', '0', '0', '0', '0', '', '6', '0', 22, 22),
(30, 3, 19, 6, 2014, '10', '10', '10', '10', '0', '0', '0', '0', '', '10', '0', 22, 22),
(31, 4, 46, 8, 2020, '8', '7', '9', '7', '0', '3', '0', '0', '-', '7,5', '3', 1, 29),
(32, 5, 46, 9, 2020, '8', '8', '9', '7', '0', '3', '0', '0', '-', '8', '3', 1, 30),
(33, 6, 46, 10, 2020, '9', '6', '6', '5', '2', '2', '2', '0', '-', '6,5', '6', 1, 31),
(34, 7, 46, 12, 2020, '8', '7', '9', '-', '0', '3', '2', '0', '-', '8', '5', 1, 32),
(35, 7, 46, 13, 2020, '10', '10', '10', '-', '0', '1', '0', '0', '-', '10', '1', 1, 32),
(36, 6, 46, 11, 2020, '10', '8', '6', '-', '0', '0', '5', '0', '-', '8', '5', 1, 31),
(37, 8, 46, 16, 2020, '7', '7', '-', '-', '2', '0', '0', '0', '-', '7', '2', 1, 33),
(38, 8, 46, 15, 2020, '6', '8', '-', '-', '0', '2', '0', '0', '-', '7', '2', 1, 33),
(39, 4, 46, 17, 2020, '10', '7', '7', '-', '2', '3', '0', '0', '-', '8', '5', 1, 29),
(40, 9, 46, 14, 2020, '10', '10', '-', '-', '0', '0', '0', '0', '-', '10', '0', 1, 34),
(41, 5, 46, 18, 2020, '8', '8', '9', '-', '0', '0', '0', '0', '-', '8,5', '0', 1, 30);

-- --------------------------------------------------------

--
-- Estrutura da tabela `boletim`
--

DROP TABLE IF EXISTS `boletim`;
CREATE TABLE IF NOT EXISTS `boletim` (
  `boletim_id` int(11) NOT NULL AUTO_INCREMENT,
  `boletim_ano` int(11) DEFAULT NULL,
  `boletim_cliente` int(11) DEFAULT NULL,
  `boletim_professor` int(11) DEFAULT NULL,
  `boletim_serie` int(11) DEFAULT NULL,
  PRIMARY KEY (`boletim_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `boletim`
--

INSERT INTO `boletim` (`boletim_id`, `boletim_ano`, `boletim_cliente`, `boletim_professor`, `boletim_serie`) VALUES
(11, 2013, 13, 1, 22),
(12, 2013, 19, 1, 22),
(13, 2013, 21, 1, 22),
(14, 2013, 6, 2, 13),
(15, 2013, 13, 2, 22),
(16, 2013, 43, 1, 22),
(17, 2013, 35, 1, 22),
(18, 2013, 30, 1, 22),
(19, 2013, 25, 1, 22),
(20, 2014, 19, 1, 22),
(21, 2014, 43, 3, 22),
(22, 2014, 19, 3, 22),
(23, 2014, 13, 3, 22),
(24, 2014, 30, 3, 22),
(25, 2014, 21, 3, 22),
(26, 2014, 35, 3, 22),
(27, 2014, 40, 3, 22),
(28, 2014, 25, 3, 22),
(29, 2020, 46, 4, 1),
(30, 2020, 46, 5, 1),
(31, 2020, 46, 6, 1),
(32, 2020, 46, 7, 1),
(33, 2020, 46, 8, 1),
(34, 2020, 46, 9, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_title` varchar(200) DEFAULT NULL,
  `categoria_url` varchar(200) DEFAULT NULL,
  `categoria_pos` int(11) DEFAULT 0,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `categoria_title`, `categoria_url`, `categoria_pos`) VALUES
(5, 'Manha', 'manha', 0),
(6, 'Tarde', 'tarde', 0),
(7, 'Noite', 'noite', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_nome` varchar(200) DEFAULT NULL,
  `cliente_cpf` varchar(20) DEFAULT NULL,
  `cliente_datan` varchar(20) DEFAULT NULL,
  `cliente_email` varchar(200) DEFAULT NULL,
  `cliente_telefone` varchar(20) DEFAULT NULL,
  `cliente_rua` varchar(300) DEFAULT NULL,
  `cliente_uf` varchar(2) DEFAULT NULL,
  `cliente_num` varchar(20) DEFAULT NULL,
  `cliente_complemento` varchar(2000) DEFAULT NULL,
  `cliente_cidade` varchar(200) DEFAULT NULL,
  `cliente_bairro` varchar(200) DEFAULT NULL,
  `cliente_sexo` int(11) DEFAULT 1 COMMENT '1 = masc\r\n2 = fem',
  `cliente_cep` varchar(20) DEFAULT NULL,
  `cliente_celular` varchar(20) DEFAULT NULL,
  `cliente_sub` int(11) DEFAULT NULL,
  `cliente_categoria` int(11) DEFAULT NULL,
  `cliente_matricula` int(11) DEFAULT NULL,
  `cliente_ano_matricula` int(11) DEFAULT NULL,
  `cliente_profissao` varchar(200) DEFAULT NULL,
  `cliente_responsavel` varchar(200) DEFAULT NULL,
  `cliente_contrato` varchar(200) DEFAULT NULL,
  `cliente_foto` varchar(100) DEFAULT '0',
  `cliente_senha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`),
  KEY `fk_cliente_sub` (`cliente_sub`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_nome`, `cliente_cpf`, `cliente_datan`, `cliente_email`, `cliente_telefone`, `cliente_rua`, `cliente_uf`, `cliente_num`, `cliente_complemento`, `cliente_cidade`, `cliente_bairro`, `cliente_sexo`, `cliente_cep`, `cliente_celular`, `cliente_sub`, `cliente_categoria`, `cliente_matricula`, `cliente_ano_matricula`, `cliente_profissao`, `cliente_responsavel`, `cliente_contrato`, `cliente_foto`, `cliente_senha`) VALUES
(46, 'Rafael Raszl', NULL, '29/05/1985', NULL, '(45)6465-4654', 'ghjghjk', 'SP', '4564', 'ghjkghj', 'ghjghj', 'ghjghj', 1, '45645-645', '', 1, 5, 1010, 2020, NULL, 'hjklhkj', NULL, '0', '1e48c4420b7073bc11916c6c1de226bb'),
(47, 'Lucas Silva', NULL, '22/10/2000', NULL, '(78)7564-5646', 'rtyrfghfj', 'SP', '4895', 'hjklhjkl', 'ghjkgfhu', 'fghjfghjfgh', 1, '54798-454', '', 26, 6, 1011, 2020, NULL, 'ghjkghj', NULL, '0', '7f975a56c761db6506eca0b37ce6ec87'),
(48, 'Leticia Gamarra', NULL, '30/12/2005', NULL, '(45)6456-4564', 'yuiyuiyuiyiuyi', 'SP', '789', 'hjkhkhk', 'gjkhjkl', 'gfhfjghj', 2, '45645-646', '', 27, 7, 1012, 2020, NULL, 'ytui', NULL, '0', 'f33ba15effa5c10e873bf3842afb46a6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_site_title` varchar(500) DEFAULT NULL,
  `config_site_description` text DEFAULT NULL,
  `config_site_keywords` text DEFAULT NULL,
  `config_site_menu` int(11) DEFAULT 0 COMMENT '1 = sim',
  `config_site_social` text DEFAULT NULL,
  `config_site_ano` int(11) DEFAULT 2013,
  `config_site_msg` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`config_id`, `config_site_title`, `config_site_description`, `config_site_keywords`, `config_site_menu`, `config_site_social`, `config_site_ano`, `config_site_msg`) VALUES
(1, 'Escola Ciclo Vittal', 'Loja de produtos nacionais e importados', 'eletrônicos, presentes, automotivo', 0, '                                <span class=\'st_facebook_large\' displayText=\'Facebook\'></span>\r\n                                <span class=\'st_twitter_large\' displayText=\'Tweet\'></span>\r\n                                <span class=\'st_googleplus_large\' displayText=\'Google +\'></span>\r\n                                <span class=\'st_linkedin_large\' displayText=\'LinkedIn\'></span>\r\n                                <span class=\'st_pinterest_large\' displayText=\'Pinterest\'></span>\r\n                                <span class=\'st_evernote_large\' displayText=\'Evernote\'></span>\r\n                                <script type=\"text/javascript\" src=\"http://w.sharethis.com/button/buttons.js\"></script>\r\n                                <script type=\"text/javascript\">stLight.options({publisher: \"7f061e38-a881-40ec-922d-4d9fe4b8a543\"});</script> ', 2020, 'Ensino técnico de qualidade!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

DROP TABLE IF EXISTS `disciplina`;
CREATE TABLE IF NOT EXISTS `disciplina` (
  `disciplina_id` int(11) NOT NULL AUTO_INCREMENT,
  `disciplina_nome` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`disciplina_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`disciplina_id`, `disciplina_nome`) VALUES
(8, 'Clinica Medica'),
(9, 'Anatomia'),
(10, 'Microbiologia e Parasitologia'),
(11, 'Farmacologia'),
(12, 'Primeiros Socorros'),
(13, 'Procedimentos'),
(14, 'Ética I'),
(15, 'Saúde Pública'),
(16, 'Nutrição'),
(17, 'Clinica Cirurgica'),
(18, 'Oncologia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `info_id` int(11) NOT NULL AUTO_INCREMENT,
  `info_txt` text DEFAULT NULL,
  `info_cliente` int(11) DEFAULT NULL,
  `info_data` varchar(30) DEFAULT NULL,
  `info_user` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`info_id`),
  KEY `fk_info_cliente` (`info_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `info`
--

INSERT INTO `info` (`info_id`, `info_txt`, `info_cliente`, `info_data`, `info_user`) VALUES
(1, 'Sem observações', 46, '06/05/2020 01:59', 'Rafael Raszl');

-- --------------------------------------------------------

--
-- Estrutura da tabela `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `material_serie` int(11) DEFAULT NULL,
  `material_professor` int(11) DEFAULT NULL,
  `material_nome` varchar(500) DEFAULT NULL,
  `material_desc` text DEFAULT NULL,
  `material_url` varchar(200) DEFAULT NULL,
  `material_data` varchar(20) DEFAULT NULL,
  `material_disc` int(11) DEFAULT NULL,
  PRIMARY KEY (`material_id`),
  KEY `fk_matsub` (`material_serie`),
  KEY `fk_matprofn` (`material_professor`),
  KEY `fk_matdisc` (`material_disc`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensal`
--

DROP TABLE IF EXISTS `mensal`;
CREATE TABLE IF NOT EXISTS `mensal` (
  `mensal_id` int(11) NOT NULL AUTO_INCREMENT,
  `mensal_cliente` int(11) DEFAULT NULL,
  `mensal_ano` int(11) DEFAULT NULL,
  `mensal_jan` double(10,2) DEFAULT 0.00,
  `mensal_fev` double(10,2) DEFAULT 0.00,
  `mensal_mar` double(10,2) DEFAULT 0.00,
  `mensal_abr` double(10,2) DEFAULT 0.00,
  `mensal_mai` double(10,2) DEFAULT 0.00,
  `mensal_jun` double(10,2) DEFAULT 0.00,
  `mensal_jul` double(10,2) DEFAULT 0.00,
  `mensal_ago` double(10,2) DEFAULT 0.00,
  `mensal_set` double(10,2) DEFAULT 0.00,
  `mensal_out` double(10,2) DEFAULT 0.00,
  `mensal_nov` double(10,2) DEFAULT 0.00,
  `mensal_dez` double(10,2) DEFAULT 0.00,
  `mensal_pjan` varchar(10) DEFAULT NULL,
  `mensal_pfev` varchar(10) DEFAULT NULL,
  `mensal_pmar` varchar(10) DEFAULT NULL,
  `mensal_pabr` varchar(10) DEFAULT NULL,
  `mensal_pmai` varchar(10) DEFAULT NULL,
  `mensal_pjun` varchar(10) DEFAULT NULL,
  `mensal_pjul` varchar(10) DEFAULT NULL,
  `mensal_pago` varchar(10) DEFAULT NULL,
  `mensal_pset` varchar(10) DEFAULT NULL,
  `mensal_pout` varchar(10) DEFAULT NULL,
  `mensal_pnov` varchar(10) DEFAULT NULL,
  `mensal_pdez` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`mensal_id`),
  KEY `fk_ano_mes` (`mensal_ano`),
  KEY `fk_men_cli` (`mensal_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensal`
--

INSERT INTO `mensal` (`mensal_id`, `mensal_cliente`, `mensal_ano`, `mensal_jan`, `mensal_fev`, `mensal_mar`, `mensal_abr`, `mensal_mai`, `mensal_jun`, `mensal_jul`, `mensal_ago`, `mensal_set`, `mensal_out`, `mensal_nov`, `mensal_dez`, `mensal_pjan`, `mensal_pfev`, `mensal_pmar`, `mensal_pabr`, `mensal_pmai`, `mensal_pjun`, `mensal_pjul`, `mensal_pago`, `mensal_pset`, `mensal_pout`, `mensal_pnov`, `mensal_pdez`) VALUES
(64, 46, 2020, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', ''),
(65, 47, 2020, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', ''),
(66, 48, 2020, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `professor_id` int(11) NOT NULL AUTO_INCREMENT,
  `professor_nome` varchar(200) DEFAULT NULL,
  `professor_senha` varchar(200) DEFAULT NULL,
  `professor_login` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`professor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`professor_id`, `professor_nome`, `professor_senha`, `professor_login`) VALUES
(4, 'Celia', 'e18759f4faf3f80145f89ba4c5e6a54a', 'celia'),
(5, 'Gisela', 'a5206e6d653c6a6edf7cabbce072280c', 'gisela'),
(6, 'Silmara', '76d8ced6f763a267c744764369a77833', 'silmara'),
(7, 'Daiana', 'd4f1db46b7dae504ebd8df559e1f7e2e', 'daiana'),
(8, 'Lucinha', 'ae6d4712c295539024747106c95a4b60', 'lucinha'),
(9, 'Mazé', 'e93e44f546dc8abfda4f7b2d0583abb4', 'maze');

-- --------------------------------------------------------

--
-- Estrutura da tabela `profmat`
--

DROP TABLE IF EXISTS `profmat`;
CREATE TABLE IF NOT EXISTS `profmat` (
  `profmat_id` int(11) NOT NULL AUTO_INCREMENT,
  `profmat_mat` int(11) DEFAULT NULL,
  `profmat_prof` int(11) DEFAULT NULL,
  PRIMARY KEY (`profmat_id`),
  KEY `fk_profmat` (`profmat_mat`),
  KEY `fk_matprof` (`profmat_prof`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `profmat`
--

INSERT INTO `profmat` (`profmat_id`, `profmat_mat`, `profmat_prof`) VALUES
(11, 9, 5),
(12, 8, 4),
(13, 10, 6),
(15, 17, 4),
(16, 12, 7),
(18, 14, 9),
(19, 11, 6),
(20, 16, 8),
(21, 15, 8),
(22, 13, 7),
(23, 18, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profserie`
--

DROP TABLE IF EXISTS `profserie`;
CREATE TABLE IF NOT EXISTS `profserie` (
  `profserie_id` int(11) NOT NULL AUTO_INCREMENT,
  `profserie_prof` int(11) DEFAULT NULL,
  `profserie_sub` int(11) DEFAULT NULL,
  PRIMARY KEY (`profserie_id`),
  KEY `fk_profserie` (`profserie_prof`),
  KEY `fk_profsub` (`profserie_sub`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `profserie`
--

INSERT INTO `profserie` (`profserie_id`, `profserie_prof`, `profserie_sub`) VALUES
(1, 4, 1),
(2, 4, 26),
(3, 4, 27),
(4, 5, 1),
(5, 5, 26),
(6, 5, 27),
(7, 6, 1),
(8, 6, 26),
(9, 6, 27),
(10, 7, 1),
(11, 7, 26),
(12, 7, 27),
(13, 8, 1),
(14, 8, 26),
(15, 8, 27),
(16, 9, 1),
(17, 9, 26),
(18, 9, 27);

-- --------------------------------------------------------

--
-- Estrutura da tabela `recado`
--

DROP TABLE IF EXISTS `recado`;
CREATE TABLE IF NOT EXISTS `recado` (
  `recado_id` int(11) NOT NULL AUTO_INCREMENT,
  `recado_professor` int(11) DEFAULT NULL,
  `recado_cliente` int(11) DEFAULT NULL,
  `recado_mensagem` text DEFAULT NULL,
  `recado_data` varchar(20) DEFAULT NULL,
  `recado_assunto` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`recado_id`),
  KEY `fk_recprof` (`recado_professor`),
  KEY `fk_reccli` (`recado_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `recado`
--

INSERT INTO `recado` (`recado_id`, `recado_professor`, `recado_cliente`, `recado_mensagem`, `recado_data`, `recado_assunto`) VALUES
(20, 4, 46, 'Prova 12/05/2020', '05/05/2020', 'Prova CM');

-- --------------------------------------------------------

--
-- Estrutura da tabela `smtp`
--

DROP TABLE IF EXISTS `smtp`;
CREATE TABLE IF NOT EXISTS `smtp` (
  `smtp_id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(200) DEFAULT NULL,
  `smtp_username` varchar(100) DEFAULT NULL,
  `smtp_password` varchar(100) DEFAULT NULL,
  `smtp_fromname` varchar(200) DEFAULT NULL,
  `smtp_bcc` varchar(100) DEFAULT NULL,
  `smtp_replyto` varchar(100) DEFAULT NULL,
  `smtp_port` int(11) DEFAULT NULL,
  PRIMARY KEY (`smtp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `smtp`
--

INSERT INTO `smtp` (`smtp_id`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_fromname`, `smtp_bcc`, `smtp_replyto`, `smtp_port`) VALUES
(1, 'mail.seusite.com.br', 'teste@seusite.com.br', '123change', 'Colégio Flux', 'aaa@gmail.com', 'outro@gmail.com', 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub`
--

DROP TABLE IF EXISTS `sub`;
CREATE TABLE IF NOT EXISTS `sub` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_title` varchar(200) DEFAULT NULL,
  `sub_url` varchar(200) DEFAULT NULL,
  `sub_pos` int(11) DEFAULT 0,
  `sub_categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `fk_sub_categoria` (`sub_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sub`
--

INSERT INTO `sub` (`sub_id`, `sub_title`, `sub_url`, `sub_pos`, `sub_categoria`) VALUES
(1, 'A', 'a', 0, 5),
(26, 'B', 'b', 0, 6),
(27, 'C', 'c', 0, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(20) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_id`, `user_login`, `user_password`, `user_email`, `user_name`) VALUES
(1, 'admin', 'df38a0287123e7773bab41e960c581c1', 'rafaelmsraszl@gmail.com', 'Rafael Raszl'),
(3, 'silmara', '76d8ced6f763a267c744764369a77833', 'silmara.russo@ciclovittal.online', 'Silmara Russo');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `bolemat`
--
ALTER TABLE `bolemat`
  ADD CONSTRAINT `fk_bb` FOREIGN KEY (`bolemat_boletim`) REFERENCES `boletim` (`boletim_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_sub` FOREIGN KEY (`cliente_sub`) REFERENCES `sub` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `info`
--
ALTER TABLE `info`
  ADD CONSTRAINT `fk_info_cliente` FOREIGN KEY (`info_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `fk_matdisc` FOREIGN KEY (`material_disc`) REFERENCES `disciplina` (`disciplina_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matprofn` FOREIGN KEY (`material_professor`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matsub` FOREIGN KEY (`material_serie`) REFERENCES `sub` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mensal`
--
ALTER TABLE `mensal`
  ADD CONSTRAINT `fk_men_cli` FOREIGN KEY (`mensal_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `profmat`
--
ALTER TABLE `profmat`
  ADD CONSTRAINT `fk_matprof` FOREIGN KEY (`profmat_prof`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profmat` FOREIGN KEY (`profmat_mat`) REFERENCES `disciplina` (`disciplina_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `profserie`
--
ALTER TABLE `profserie`
  ADD CONSTRAINT `fk_profserie` FOREIGN KEY (`profserie_prof`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profsub` FOREIGN KEY (`profserie_sub`) REFERENCES `sub` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `recado`
--
ALTER TABLE `recado`
  ADD CONSTRAINT `fk_reccli` FOREIGN KEY (`recado_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recprof` FOREIGN KEY (`recado_professor`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `sub`
--
ALTER TABLE `sub`
  ADD CONSTRAINT `fk_sub_categoria` FOREIGN KEY (`sub_categoria`) REFERENCES `categoria` (`categoria_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
