-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tempo de Geração: Jul 14, 2014 as 05:17 PM
-- Versão do Servidor: 5.0.27
-- Versão do PHP: 5.2.0
-- 
-- Banco de Dados: `aluno`
-- 

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `bolemat`
-- 

CREATE TABLE `bolemat` (
  `bolemat_id` int(11) NOT NULL auto_increment,
  `bolemat_professor` int(11) default NULL,
  `bolemat_cliente` int(11) default NULL,
  `bolemat_disciplina` int(11) default NULL,
  `bolemat_ano` int(11) default NULL,
  `bolemat_n1` varchar(20) default '&nbsp;',
  `bolemat_n2` varchar(20) default '&nbsp;',
  `bolemat_n3` varchar(20) default '&nbsp;',
  `bolemat_n4` varchar(20) default '&nbsp;',
  `bolemat_r1` varchar(20) default '&nbsp;',
  `bolemat_r2` varchar(20) default '&nbsp;',
  `bolemat_r3` varchar(20) default '&nbsp;',
  `bolemat_r4` varchar(20) default '&nbsp;',
  `bolemat_m1` varchar(20) default '&nbsp;',
  `bolemat_m2` varchar(20) default '&nbsp;',
  `bolemat_m3` varchar(20) default '&nbsp;',
  `bolemat_serie` int(11) default NULL,
  `bolemat_boletim` int(11) default NULL,
  PRIMARY KEY  (`bolemat_id`),
  KEY `fk_bb` (`bolemat_boletim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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
(30, 3, 19, 6, 2014, '10', '10', '10', '10', '0', '0', '0', '0', '', '10', '0', 22, 22);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `boletim`
-- 

CREATE TABLE `boletim` (
  `boletim_id` int(11) NOT NULL auto_increment,
  `boletim_ano` int(11) default NULL,
  `boletim_cliente` int(11) default NULL,
  `boletim_professor` int(11) default NULL,
  `boletim_serie` int(11) default NULL,
  PRIMARY KEY  (`boletim_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

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
(28, 2014, 25, 3, 22);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `categoria`
-- 

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL auto_increment,
  `categoria_title` varchar(200) default NULL,
  `categoria_url` varchar(200) default NULL,
  `categoria_pos` int(11) default '0',
  PRIMARY KEY  (`categoria_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Extraindo dados da tabela `categoria`
-- 

INSERT INTO `categoria` (`categoria_id`, `categoria_title`, `categoria_url`, `categoria_pos`) VALUES 
(5, 'Manhã', 'manha', 0),
(6, 'Tarde', 'tarde', 0);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `cliente`
-- 

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL auto_increment,
  `cliente_nome` varchar(200) default NULL,
  `cliente_cpf` varchar(20) default NULL,
  `cliente_datan` varchar(20) default NULL,
  `cliente_email` varchar(200) default NULL,
  `cliente_telefone` varchar(20) default NULL,
  `cliente_rua` varchar(300) default NULL,
  `cliente_uf` varchar(2) default NULL,
  `cliente_num` varchar(20) default NULL,
  `cliente_complemento` varchar(2000) default NULL,
  `cliente_cidade` varchar(200) default NULL,
  `cliente_bairro` varchar(200) default NULL,
  `cliente_sexo` int(11) default '1' COMMENT '1 = masc\r\n2 = fem',
  `cliente_cep` varchar(20) default NULL,
  `cliente_celular` varchar(20) default NULL,
  `cliente_sub` int(11) default NULL,
  `cliente_categoria` int(11) default NULL,
  `cliente_matricula` int(11) default NULL,
  `cliente_ano_matricula` int(11) default NULL,
  `cliente_profissao` varchar(200) default NULL,
  `cliente_responsavel` varchar(200) default NULL,
  `cliente_contrato` varchar(200) default NULL,
  `cliente_foto` varchar(100) default '0',
  `cliente_senha` varchar(100) default NULL,
  PRIMARY KEY  (`cliente_id`),
  KEY `fk_cliente_sub` (`cliente_sub`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- 
-- Extraindo dados da tabela `cliente`
-- 

INSERT INTO `cliente` (`cliente_id`, `cliente_nome`, `cliente_cpf`, `cliente_datan`, `cliente_email`, `cliente_telefone`, `cliente_rua`, `cliente_uf`, `cliente_num`, `cliente_complemento`, `cliente_cidade`, `cliente_bairro`, `cliente_sexo`, `cliente_cep`, `cliente_celular`, `cliente_sub`, `cliente_categoria`, `cliente_matricula`, `cliente_ano_matricula`, `cliente_profissao`, `cliente_responsavel`, `cliente_contrato`, `cliente_foto`, `cliente_senha`) VALUES 
(5, 'João Henrique Macena Cavalcanti', NULL, '31/07/2000', NULL, '(81)8867-2713', 'Engenho Criméia', 'pe', '397', '', 'Recife', 'Imbiribeira', 1, '51150-090', '8186157719', 24, 6, 20013, 2013, NULL, 'Patricia Santos Macena', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, 'Jean Carlos Lopes de Lima', NULL, '14/04/2009', NULL, '(81)8888-8888', 'Poeta Manuel Bandeira', 'pe', '110', 'A', 'Recife', 'Imbiribeira', 1, '51170-590', '8134224763', 13, 6, 20023, 2013, NULL, 'Rebeka Ferreira de Carvalho', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'Noemy Barros Lima', NULL, '04/03/2010', NULL, '(81)3472-0367', 'Camaratuba', 'pe', '026', '', 'Recife', 'Pina', 2, '51110-070', '81 8786-7997', 16, 5, 20033, 2013, NULL, 'Ketura do Nascimento Barros de Souza Lima', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, 'Maria Beatriz Fernandes de Lima', NULL, '24/02/2000', NULL, '(81)3428-2299', 'Doutor Valdir Pessoa', 'pe', '122', '', 'Recife', 'Imbiribeira', 2, '51150-070', '81 3227-7430', 24, 6, 20043, 2013, NULL, 'Eliene Fernandes de Lima', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(9, 'Miguel Robson Santos de Lima', NULL, '28/03/2009', NULL, '(81)3472-0432', 'Amsterdam', 'pe', '624', '', 'Recife', 'Imbiribeira', 1, '51180-190', '81 9902-5417', 13, 6, 20053, 2013, NULL, 'Robson Gomes de Lima', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(10, 'Matheus Ricardo do Monte Oliveira', NULL, '27/06/2008', NULL, '(81)8669-2403', 'Dancing Days', 'pe', '18', 'A', 'Recife', 'Imbiribeira', 1, '51180-340', '81 8748-3441', 11, 5, 20063, 2013, NULL, 'Josely do Monte Araújo Oliveira', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(11, 'Flávia Cristina Soares Silva', NULL, '01/09/2003', NULL, '(81)8625-4318', 'Lisboa', 'pe', '10', 'a', 'Recife', 'Imbiribeira', 2, '51180-060', '81 0000-0000', 21, 5, 20073, 2013, NULL, 'Franciane Cistina Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(12, 'Jennyfer Kwane Rodrigues da Silva', NULL, '28/04/2004', NULL, '(81)3339-6196', 'Sargento Silvino Macêdo', 'pe', '219', '', 'Recife', 'Imbiribeira', 2, '51160-060', '81 0000-0000', 20, 5, 20083, 2013, NULL, 'Jandira Rodrigues de Oliveira', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(13, 'Gabriele Silva da Costa', NULL, '12/01/2000', NULL, '(81)3422-0550', 'Nossa Senhora do Carmo', 'pe', '364', '', 'Recife', 'Imbiribeira', 2, '51170-650', '81 8871-0161', 22, 5, 20093, 2013, NULL, 'Carolina Gomes', NULL, 'aa6866d05d87fa70e805a0932d0dc723.jpg', '81dc9bdb52d04dc20036dbd8313ed055'),
(14, 'Lucas Eduardo José Barbosa da Silva', NULL, '20/05/2010', NULL, '(81)8653-4755', 'Nossa Senhora do Carmo', 'pe', '215', '', 'Recife', 'Imbiribeira', 1, '51170-650', '81 8879-1951', 2, 6, 20103, 2013, NULL, 'Dayane Barbosa Gomes da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(15, 'Flavio Rodrigues Garcia Filho', NULL, '16/01/2006', NULL, '(81)8559-1598', 'General', 'pe', '400', 'Apt', 'Recife', 'Imbiribeira', 1, '51170-560', '81 8616-0026', 18, 5, 20113, 2013, NULL, 'Bruna Gabriela da Silva', NULL, '56c31241a110bda158651fe72d34d896.jpg', '81dc9bdb52d04dc20036dbd8313ed055'),
(16, 'Marilia Oliveira Neto', NULL, '13/06/2010', NULL, '(81)3339-5297', 'Amsterdam', 'pe', '327', '', 'Recife', 'Imbiribeira', 2, '51180-190', '81 0000-0000', 17, 6, 20123, 2013, NULL, 'Marluce Celestina de Oliveira Neto', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(17, 'Leandro Moura de Maraes', NULL, '22/11/2009', NULL, '(81)8467-1087', 'Professora Rosilda Costa', 'pe', '28', '', 'Recife', 'Imbiribeira', 1, '51150-020', '81 3204-5005', 13, 6, 20133, 2013, NULL, 'Marcia Patricia Moura da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(18, 'Ivene Beatriz Maria Melo dos Santos', NULL, '06/08/2004', NULL, '(81)8861-7836', 'Rua Doze', 'pe', '1112', '', 'Recife', 'Imbiribeira', 2, '51150-248', '81 0000-0000', 18, 5, 20143, 2013, NULL, 'Ana Maria Melo da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(19, 'André José Oliveira de Araújo', NULL, '13/02/2001', NULL, '(81)3472-5988', 'Antônio Paes Barreto', 'pe', '421', '', 'Recife', 'Imbiribeira', 1, '51160-170', '81 9699-5767', 22, 5, 20153, 2013, NULL, 'Maria Ianei de Oliveira', NULL, '0', '202cb962ac59075b964b07152d234b70'),
(20, 'Caio Victor Militão Maia', NULL, '06/09/2003', NULL, '(81)8859-8634', 'Cafezópolis', 'pe', '27', '', 'Recife', 'Imbiribeira', 1, '51150-230', '81 0000-0000', 20, 5, 20163, 2013, NULL, 'Elane Teixeira Maia', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(21, 'Nicole Bione Miguel de Albuquerque', NULL, '09/02/2002', NULL, '(81)3339-8437', 'Lisboa', 'pe', '07', 'quadra B conjunto bangu', 'Recife', 'Imbiribeira', 2, '51180-060', '81 0000-0000', 22, 5, 20173, 2013, NULL, 'Nielmison Ferreira de Albuquerque', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(22, 'Danyllo Estevam das Neves', NULL, '20/12/2004', NULL, '(81)8844-4732', 'Velha do Frigorífico', 'pe', '49', '', 'Recife', 'Imbiribeira', 1, '51150-270', '81 0000-0000', 19, 5, 20183, 2013, NULL, 'Josenilda Estevam das Neves', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(23, 'Vinicius José Mesquita do Nascimento', NULL, '28/05/2010', NULL, '(81)9696-7757', 'Nova Verona', 'pe', '45', 'aptº 102', 'Recife', 'Imbiribeira', 1, '51170-310', '8856-0083', 2, 6, 20193, 2013, NULL, 'Verbena Bianca Salgues Mesquita', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(24, 'Gabriel Henrique Sampaio da Silva', NULL, '08/03/2008', NULL, '(81)0000-0000', 'Salinas', 'pe', '2266', '', 'Recife', 'Imbiribeira', 1, '51170-640', '81 0000-0000', 12, 5, 20203, 2013, NULL, 'Cristina Maria da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(25, 'Thiago José Fragoso', NULL, '30/01/2000', NULL, '(81)3077-7916', 'Tenor Vicente Celestino', 'pe', '95', '', 'Recife', 'Imbiribeira', 1, '51170-200', '81 9673-7798', 22, 5, 20213, 2013, NULL, 'Livia Rio Lima Fragoso', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(26, 'Matheus Henrique Fragoso Santos', NULL, '10/05/2005', NULL, '(81)3077-7916', 'Tenor Vicente Celestino', 'pe', '95', 'Apt° 101', 'Recife', 'Imbiribeira', 1, '51170-200', '81 9673-7798', 18, 5, 20223, 2013, NULL, 'Livia Rio Lima Fragoso', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(27, 'Kayky Felipe Caetano da Silva', NULL, '28/04/2004', NULL, '(81)8697-6749', 'Cafezópolis', 'pe', '39', '', 'Recife', 'Imbiribeira', 1, '51150-230', '81 0000-0000', 19, 5, 20233, 2013, NULL, 'Sandra Betânia Barbosa da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(28, 'Arthur Alves de Santana', NULL, '09/02/2009', NULL, '(81)8662-0741', 'Varsóvia', 'pe', '207', '', 'Recife', 'Imbiribeira', 1, '51180-070', '81 0000-0000', 11, 5, 20243, 2013, NULL, 'Aldenice Alves da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(29, 'Luiz Guilherme da Silva Sotero', NULL, '29/05/2010', NULL, '(81)3339-5306', 'Nossa Senhora do Carmo', 'pe', '272', 'A', 'Recife', 'Imbiribeira', 1, '51170-650', '81 8818-8386', 8, 5, 20253, 2013, NULL, 'Vanildo Antônio Sotero Filho', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(30, 'Manuel Henrique de Oliveira Barbosa II', NULL, '09/12/2001', NULL, '(81)0000-0000', 'Deão Faria', 'pe', '91', '', 'Recife', 'Imbiribeira', 1, '51170-250', '81 0000-0000', 22, 5, 20263, 2013, NULL, 'Luciana Ribeiro da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(31, 'João Vitor Moreira dos Santos', NULL, '11/05/2006', NULL, '(81)9607-3871', 'Engenho Araci', 'pe', '109', 'A', 'Recife', 'Imbiribeira', 1, '51150-140', '81 8628-4730', 18, 5, 20273, 2013, NULL, 'Joseildo Luiz dos Santos', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(32, 'Maria Julia Vieira Lima Galvão Campos', NULL, '30/01/2000', NULL, '(81)3741-1816', 'Elisa Dias Ferreira', 'pe', '87', '', 'Recife', 'Imbiribeira', 2, '51170-190', '81 8824-3682', 17, 6, 20283, 2013, NULL, 'Ana Karina Vieira Lima Galvão Campos', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(33, 'Khamilly Vitória dos Santos Mello', NULL, '02/12/2006', NULL, '(81)8727-3427', 'João Braga', 'pe', '125', '', 'Recife', 'Imbiribeira', 2, '51170-580', '81 9192-0514', 17, 6, 20293, 2013, NULL, 'Amanda Jessica Santos Gomes', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(34, 'Emilly Vitória Dias da Silva', NULL, '16/05/2008', NULL, '(81)3422-0021', 'Professora Rosilda Costa', 'pe', '21', '', 'Recife', 'Imbiribeira', 2, '51150-020', '81 8662-1981', 15, 6, 20303, 2013, NULL, 'Priscila Emmanuelle Dias Nascimento', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(35, 'Pedro Henrique Felix da Silva', NULL, '22/01/2001', NULL, '(81)8567-7770', 'Muniz Freire', 'pe', '15', '', 'Recife', 'Imbiribeira', 1, '51160-110', '81 8660-2643', 22, 5, 20313, 2013, NULL, 'Jeilson Felix  da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(36, 'Guino Jemerson da Silva', NULL, '03/06/2009', NULL, '(81)0000-0000', '1ª Travessa do Campo', 'pe', '29', '', 'Recife', 'Imbiribeira', 1, '51180-497', '81 0000-0000', 10, 5, 20333, 2013, NULL, 'Michely da Conceição Oliveira Pessoa', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(37, 'Jennifer Oliveira da Silva', NULL, '20/12/2006', NULL, '(81)8536-3940', '1ª Travessa do Campo', 'pe', '29', '', 'Recife', 'Imbiribeira', 2, '51180-497', '81 8695-5657', 16, 5, 20343, 2013, NULL, 'Aguinaldo Amancio da Silva', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(38, 'Vitória Priscila Bonifácio de Oliveira', NULL, '06/01/2001', NULL, '(81)8743-3982', 'Muniz Freire', 'pe', '147', '', 'Recife', 'Imbiribeira', 2, '51160-110', '81 8406-3138', 23, 5, 20353, 2013, NULL, 'Vera Lucia Maria Bonifácio', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(39, 'Kézia Ferreira de Lima', NULL, '25/01/2007', NULL, '(81)3471-8381', 'Pianista Isnar Mariano', 'pe', '11', '', 'Recife', 'Imbiribeira', 2, '51170-330', '81 0000-0000', 16, 5, 20363, 2013, NULL, 'Katia Cilene de Lima', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(40, 'Ricardo Cezar Ferreira Junior', NULL, '11/12/2002', NULL, '(81)3428-8569', 'Engenho Bom Recreio', 'pe', '121', '', 'Recife', 'Imbiribeira', 1, '51150-060', '81 3338-8700', 22, 5, 20373, 2013, NULL, 'Shyrlene França Gouveia', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(41, 'Alyne Gabrielly França Ferreira', NULL, '03/10/2006', NULL, '(81)3428-8569', 'Engenho Bom Recreio', 'pe', '121', '', 'Recife', 'Imbiribeira', 2, '51150-060', '81 3338-8700', 18, 5, 20383, 2013, NULL, 'Shyrlene França Gouveia', NULL, 'bb141cf67604c67aa46dd26bb3168a5f.png', '81dc9bdb52d04dc20036dbd8313ed055'),
(42, 'Carina Oliveira Neto', NULL, '12/05/2003', NULL, '(81)3339-5297', 'Amsterdam', 'pe', '327', '', 'Recife', 'Imbiribeira', 2, '51180-190', '81 0000-0000', 21, 5, 20393, 2013, NULL, 'Marluce Celestina de Oliveira Neto', NULL, '0', 'e10adc3949ba59abbe56e057f20f883e'),
(43, 'Zoar Mendes da Silva', NULL, '20/05/2002', NULL, '(81)3425-3751', 'Nossa Senhora do Carmo', 'pe', '316', '', 'Recife', 'Imbiribeira', 2, '51170-650', '81 9639-5520', 22, 5, 20403, 2013, NULL, 'Matilde Jose da Silva', NULL, '0', '202cb962ac59075b964b07152d234b70'),
(44, 'Wilkênya Vitória da Silva Sales', NULL, '19/07/2006', NULL, '(81)3472-3489', 'Luxemburgo', 'pe', '101', '', 'Recife', 'Imbiribeira', 2, '51180-260', '81 8706-8036', 17, 6, 20413, 2013, NULL, 'Valdy Sales de Lima', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055'),
(45, 'Maria Beatriz Andrade de Lima', NULL, '30/07/2009', NULL, '(81)9973-3223', 'Renato Silva', 'pe', '1847', '', 'Recife', 'Imbiribeira', 2, '51170-540', '81 8593-2703', 13, 6, 20423, 2013, NULL, 'Alexandre Emerson de Menezes Lima', NULL, '0', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `config`
-- 

CREATE TABLE `config` (
  `config_id` int(11) NOT NULL auto_increment,
  `config_site_title` varchar(500) default NULL,
  `config_site_description` text,
  `config_site_keywords` text,
  `config_site_menu` int(11) default '0' COMMENT '1 = sim',
  `config_site_social` text,
  `config_site_ano` int(11) default '2013',
  `config_site_msg` varchar(200) default NULL,
  PRIMARY KEY  (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Extraindo dados da tabela `config`
-- 

INSERT INTO `config` (`config_id`, `config_site_title`, `config_site_description`, `config_site_keywords`, `config_site_menu`, `config_site_social`, `config_site_ano`, `config_site_msg`) VALUES 
(1, 'Escola João Paulo II', 'Loja de produtos nacionais e importados', 'eletrônicos, presentes, automotivo', 0, '                                <span class=''st_facebook_large'' displayText=''Facebook''></span>\r\n                                <span class=''st_twitter_large'' displayText=''Tweet''></span>\r\n                                <span class=''st_googleplus_large'' displayText=''Google +''></span>\r\n                                <span class=''st_linkedin_large'' displayText=''LinkedIn''></span>\r\n                                <span class=''st_pinterest_large'' displayText=''Pinterest''></span>\r\n                                <span class=''st_evernote_large'' displayText=''Evernote''></span>\r\n                                <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>\r\n                                <script type="text/javascript">stLight.options({publisher: "7f061e38-a881-40ec-922d-4d9fe4b8a543"});</script> ', 2013, 'A sabedoria é um dom que devemos cultivar');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `disciplina`
-- 

CREATE TABLE `disciplina` (
  `disciplina_id` int(11) NOT NULL auto_increment,
  `disciplina_nome` varchar(200) default NULL,
  PRIMARY KEY  (`disciplina_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Extraindo dados da tabela `disciplina`
-- 

INSERT INTO `disciplina` (`disciplina_id`, `disciplina_nome`) VALUES 
(1, 'Matemática'),
(3, 'Língua  Inglesa'),
(4, 'Geografia'),
(5, 'Língua Portuguesa'),
(6, 'História'),
(7, 'Física');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `info`
-- 

CREATE TABLE `info` (
  `info_id` int(11) NOT NULL auto_increment,
  `info_txt` text,
  `info_cliente` int(11) default NULL,
  `info_data` varchar(30) default NULL,
  `info_user` varchar(200) default NULL,
  PRIMARY KEY  (`info_id`),
  KEY `fk_info_cliente` (`info_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Extraindo dados da tabela `info`
-- 


-- --------------------------------------------------------

-- 
-- Estrutura da tabela `material`
-- 

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL auto_increment,
  `material_serie` int(11) default NULL,
  `material_professor` int(11) default NULL,
  `material_nome` varchar(500) default NULL,
  `material_desc` text,
  `material_url` varchar(200) default NULL,
  `material_data` varchar(20) default NULL,
  `material_disc` int(11) default NULL,
  PRIMARY KEY  (`material_id`),
  KEY `fk_matsub` (`material_serie`),
  KEY `fk_matprofn` (`material_professor`),
  KEY `fk_matdisc` (`material_disc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

-- 
-- Extraindo dados da tabela `material`
-- 

INSERT INTO `material` (`material_id`, `material_serie`, `material_professor`, `material_nome`, `material_desc`, `material_url`, `material_data`, `material_disc`) VALUES 
(71, 22, 1, 'Apostila II', NULL, '1_22_apostila-ii.xlsx', '12/03/2013', 1),
(72, 22, 1, 'Another Apostila III', NULL, '1_22_another-apostila-iii.xls', '12/03/2013', 1);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `mensal`
-- 

CREATE TABLE `mensal` (
  `mensal_id` int(11) NOT NULL auto_increment,
  `mensal_cliente` int(11) default NULL,
  `mensal_ano` int(11) default NULL,
  `mensal_jan` double(10,2) default '0.00',
  `mensal_fev` double(10,2) default '0.00',
  `mensal_mar` double(10,2) default '0.00',
  `mensal_abr` double(10,2) default '0.00',
  `mensal_mai` double(10,2) default '0.00',
  `mensal_jun` double(10,2) default '0.00',
  `mensal_jul` double(10,2) default '0.00',
  `mensal_ago` double(10,2) default '0.00',
  `mensal_set` double(10,2) default '0.00',
  `mensal_out` double(10,2) default '0.00',
  `mensal_nov` double(10,2) default '0.00',
  `mensal_dez` double(10,2) default '0.00',
  `mensal_pjan` varchar(10) default NULL,
  `mensal_pfev` varchar(10) default NULL,
  `mensal_pmar` varchar(10) default NULL,
  `mensal_pabr` varchar(10) default NULL,
  `mensal_pmai` varchar(10) default NULL,
  `mensal_pjun` varchar(10) default NULL,
  `mensal_pjul` varchar(10) default NULL,
  `mensal_pago` varchar(10) default NULL,
  `mensal_pset` varchar(10) default NULL,
  `mensal_pout` varchar(10) default NULL,
  `mensal_pnov` varchar(10) default NULL,
  `mensal_pdez` varchar(10) default NULL,
  PRIMARY KEY  (`mensal_id`),
  KEY `fk_ano_mes` (`mensal_ano`),
  KEY `fk_men_cli` (`mensal_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

-- 
-- Extraindo dados da tabela `mensal`
-- 

INSERT INTO `mensal` (`mensal_id`, `mensal_cliente`, `mensal_ano`, `mensal_jan`, `mensal_fev`, `mensal_mar`, `mensal_abr`, `mensal_mai`, `mensal_jun`, `mensal_jul`, `mensal_ago`, `mensal_set`, `mensal_out`, `mensal_nov`, `mensal_dez`, `mensal_pjan`, `mensal_pfev`, `mensal_pmar`, `mensal_pabr`, `mensal_pmai`, `mensal_pjun`, `mensal_pjul`, `mensal_pago`, `mensal_pset`, `mensal_pout`, `mensal_pnov`, `mensal_pdez`) VALUES 
(19, 5, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '13/01', '', '', '', '', '', '', '', '', '', '', ''),
(20, 6, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '26/01', '', '', '', '', '', '', '', '', '', '', ''),
(21, 7, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '29/01', '', '', '', '', '', '', '', '', '', '', ''),
(22, 8, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '30/01', '', '', '', '', '', '', '', '', '', '', ''),
(23, 9, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '30/01', '', '', '', '', '', '', '', '', '', '', ''),
(24, 10, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '03/01', '', '', '', '', '', '', '', '', '', '', ''),
(25, 11, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '05/01', '', '', '', '', '', '', '', '', '', '', ''),
(26, 12, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '06/01', '', '', '', '', '', '', '', '', '', '', ''),
(27, 13, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '26/01', '', '', '', '', '', '', '', '', '', '', ''),
(28, 14, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '11/01', '', '', '', '', '', '', '', '', '', '', ''),
(29, 15, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '11/01', '', '', '', '', '', '', '', '', '', '', ''),
(30, 16, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '13/01', '', '', '', '', '', '', '', '', '', '', ''),
(31, 17, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '13/01', '', '', '', '', '', '', '', '', '', '', ''),
(32, 18, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '18/01', '', '', '', '', '', '', '', '', '', '', ''),
(33, 19, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '18/01', '', '', '', '', '', '', '', '', '', '', ''),
(34, 20, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '15/01', '', '', '', '', '', '', '', '', '', '', ''),
(35, 21, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '19/01', '', '', '', '', '', '', '', '', '', '', ''),
(36, 22, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '20/01', '', '', '', '', '', '', '', '', '', '', ''),
(37, 23, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '20/01', '', '', '', '', '', '', '', '', '', '', ''),
(38, 24, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '21/01', '', '', '', '', '', '', '', '', '', '', ''),
(39, 25, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '21/01', '', '', '', '', '', '', '', '', '', '', ''),
(40, 26, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '21/01', '', '', '', '', '', '', '', '', '', '', ''),
(41, 27, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '21/01', '', '', '', '', '', '', '', '', '', '', ''),
(42, 28, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '11/01', '', '', '', '', '', '', '', '', '', '', ''),
(43, 29, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '21/01', '', '', '', '', '', '', '', '', '', '', ''),
(44, 30, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '27/01', '', '', '', '', '', '', '', '', '', '', ''),
(45, 31, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '27/01', '', '', '', '', '', '', '', '', '', '', ''),
(46, 32, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '27/01', '', '', '', '', '', '', '', '', '', '', ''),
(47, 33, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '27/01', '', '', '', '', '', '', '', '', '', '', ''),
(48, 34, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '27/01', '', '', '', '', '', '', '', '', '', '', ''),
(49, 35, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '27/01', '', '', '', '', '', '', '', '', '', '', ''),
(50, 36, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '', '', '', '', '', '', '', '', '', '', ''),
(51, 37, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '21/01', '', '', '', '', '', '', '', '', '', '', ''),
(52, 38, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '', '', '', '', '', '', '', '', '', '', ''),
(53, 39, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '', '', '', '', '', '', '', '', '', '', ''),
(54, 40, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '', '', '', '', '', '', '', '', '', '', ''),
(55, 41, 2013, 130.15, 120.25, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '20/02', '', '', '', '', '', '', '', '', '', ''),
(56, 42, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '', '', '', '', '', '', '', '', '', '', ''),
(57, 43, 2013, 100.00, 172.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '09/01', '09/01', '', '', '', '', '', '', '', '', '', ''),
(58, 44, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '', '', '', '', '', '', '', '', '', '', ''),
(59, 45, 2013, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '28/01', '', '', '', '', '', '', '', '', '', '', ''),
(60, 41, 2014, 11.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '08/07', '', '', '', '', '', '', '', '', '', '', ''),
(61, 42, 2014, 100.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '01/03', '', '', '', '', '', '', '', '', '', '', ''),
(62, 43, 2014, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', ''),
(63, 19, 2014, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `professor`
-- 

CREATE TABLE `professor` (
  `professor_id` int(11) NOT NULL auto_increment,
  `professor_nome` varchar(200) default NULL,
  `professor_senha` varchar(200) default NULL,
  `professor_login` varchar(30) default NULL,
  PRIMARY KEY  (`professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Extraindo dados da tabela `professor`
-- 

INSERT INTO `professor` (`professor_id`, `professor_nome`, `professor_senha`, `professor_login`) VALUES 
(1, 'Rafael Clares Diniz', 'e10adc3949ba59abbe56e057f20f883e', 'rafaelcd'),
(2, 'Silene Clares', '81dc9bdb52d04dc20036dbd8313ed055', 'silenec'),
(3, 'Vagner', '202cb962ac59075b964b07152d234b70', 'vagner');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `profmat`
-- 

CREATE TABLE `profmat` (
  `profmat_id` int(11) NOT NULL auto_increment,
  `profmat_mat` int(11) default NULL,
  `profmat_prof` int(11) default NULL,
  PRIMARY KEY  (`profmat_id`),
  KEY `fk_profmat` (`profmat_mat`),
  KEY `fk_matprof` (`profmat_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Extraindo dados da tabela `profmat`
-- 

INSERT INTO `profmat` (`profmat_id`, `profmat_mat`, `profmat_prof`) VALUES 
(1, 1, 1),
(2, 3, 2),
(3, 4, 1),
(4, 5, 2),
(5, 5, 3),
(6, 4, 3),
(7, 3, 3),
(8, 7, 3),
(9, 6, 3);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `profserie`
-- 

CREATE TABLE `profserie` (
  `profserie_id` int(11) NOT NULL auto_increment,
  `profserie_prof` int(11) default NULL,
  `profserie_sub` int(11) default NULL,
  PRIMARY KEY  (`profserie_id`),
  KEY `fk_profserie` (`profserie_prof`),
  KEY `fk_profsub` (`profserie_sub`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Extraindo dados da tabela `profserie`
-- 

INSERT INTO `profserie` (`profserie_id`, `profserie_prof`, `profserie_sub`) VALUES 
(1, 2, 22),
(2, 1, 22),
(3, 2, 19),
(4, 3, 22),
(5, 3, 25);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `recado`
-- 

CREATE TABLE `recado` (
  `recado_id` int(11) NOT NULL auto_increment,
  `recado_professor` int(11) default NULL,
  `recado_cliente` int(11) default NULL,
  `recado_mensagem` text,
  `recado_data` varchar(20) default NULL,
  `recado_assunto` varchar(1000) default NULL,
  PRIMARY KEY  (`recado_id`),
  KEY `fk_recprof` (`recado_professor`),
  KEY `fk_reccli` (`recado_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

-- 
-- Extraindo dados da tabela `recado`
-- 

INSERT INTO `recado` (`recado_id`, `recado_professor`, `recado_cliente`, `recado_mensagem`, `recado_data`, `recado_assunto`) VALUES 
(94, 1, 13, 'aaaa', '14/03/2013 12:47', 'aa'),
(96, 1, 19, 'bbbb', '14/03/2013 12:47', 'bbb'),
(97, 1, 21, 'bbbb', '14/03/2013 12:47', 'bbb'),
(98, 1, 25, 'bbbb', '14/03/2013 12:47', 'bbb'),
(99, 1, 30, 'bbbb', '14/03/2013 12:47', 'bbb'),
(100, 1, 35, 'bbbb', '14/03/2013 12:47', 'bbb'),
(101, 1, 40, 'bbbb', '14/03/2013 12:47', 'bbb'),
(102, 1, 43, 'bbbb', '14/03/2013 12:47', 'bbb');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `smtp`
-- 

CREATE TABLE `smtp` (
  `smtp_id` int(11) NOT NULL auto_increment,
  `smtp_host` varchar(200) default NULL,
  `smtp_username` varchar(100) default NULL,
  `smtp_password` varchar(100) default NULL,
  `smtp_fromname` varchar(200) default NULL,
  `smtp_bcc` varchar(100) default NULL,
  `smtp_replyto` varchar(100) default NULL,
  `smtp_port` int(11) default NULL,
  PRIMARY KEY  (`smtp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Extraindo dados da tabela `smtp`
-- 

INSERT INTO `smtp` (`smtp_id`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_fromname`, `smtp_bcc`, `smtp_replyto`, `smtp_port`) VALUES 
(1, 'mail.seusite.com.br', 'teste@seusite.com.br', '123change', 'Colégio Flux', 'aaa@gmail.com', 'outro@gmail.com', 25);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `sub`
-- 

CREATE TABLE `sub` (
  `sub_id` int(11) NOT NULL auto_increment,
  `sub_title` varchar(200) default NULL,
  `sub_url` varchar(200) default NULL,
  `sub_pos` int(11) default '0',
  `sub_categoria` int(11) default NULL,
  PRIMARY KEY  (`sub_id`),
  KEY `fk_sub_categoria` (`sub_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- 
-- Extraindo dados da tabela `sub`
-- 

INSERT INTO `sub` (`sub_id`, `sub_title`, `sub_url`, `sub_pos`, `sub_categoria`) VALUES 
(2, 'Maternal', 'maternal', 0, 6),
(6, 'Martenalzinho', 'martenalzinho', 0, 5),
(8, 'Maternal', 'maternal', 0, 5),
(9, 'Martenalzinho', 'martenalzinho', 0, 6),
(10, 'Infantil I', 'infantil-i', 0, 5),
(11, 'Infantil II', 'infantil-ii', 0, 5),
(12, 'Infantil III', 'infantil-iii', 0, 5),
(13, 'Infantil I', 'infantil-i', 0, 6),
(15, 'Infantil III', 'infantil-iii', 0, 6),
(16, '1º Ano - Alfabetização', '1-ano-alfabetizacao', 0, 5),
(17, '1º Ano - Alfabetização', '1-ano-alfabetizacao', 0, 6),
(18, '2º Ano - 1ª Série', '2-ano-1-serie', 0, 5),
(19, '3º Ano - 2ª Série', '3-ano-2-serie', 0, 5),
(20, '4º Ano - 3ª Série', '4-ano-3-serie', 0, 5),
(21, '5º Ano - 4ª Série', '5-ano-4-serie', 0, 5),
(22, 'Ensino Médio - 1ª Série', 'ensino-medio-1-serie', 0, 5),
(23, '7º Ano - 6ª Série', '7-ano-6-serie', 0, 5),
(24, '8º Ano - 7ª Série', '8-ano-7-serie', 0, 6),
(25, '9º Ano - 8ª Série', '9-ano-8-serie', 0, 6);

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `user`
-- 

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_login` varchar(20) default NULL,
  `user_password` varchar(100) default NULL,
  `user_email` varchar(100) default NULL,
  `user_name` varchar(200) default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Extraindo dados da tabela `user`
-- 

INSERT INTO `user` (`user_id`, `user_login`, `user_password`, `user_email`, `user_name`) VALUES 
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'rafadinix@gmail.com', 'Rafael Clares'),
(2, 'luka', '1234', 'luka@clares.com.br', 'Lucas Clares');

-- 
-- Restrições para as tabelas dumpadas
-- 

-- 
-- Restrições para a tabela `bolemat`
-- 
ALTER TABLE `bolemat`
  ADD CONSTRAINT `fk_bb` FOREIGN KEY (`bolemat_boletim`) REFERENCES `boletim` (`boletim_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `cliente`
-- 
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_sub` FOREIGN KEY (`cliente_sub`) REFERENCES `sub` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `info`
-- 
ALTER TABLE `info`
  ADD CONSTRAINT `fk_info_cliente` FOREIGN KEY (`info_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `material`
-- 
ALTER TABLE `material`
  ADD CONSTRAINT `fk_matdisc` FOREIGN KEY (`material_disc`) REFERENCES `disciplina` (`disciplina_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matprofn` FOREIGN KEY (`material_professor`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_matsub` FOREIGN KEY (`material_serie`) REFERENCES `sub` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `mensal`
-- 
ALTER TABLE `mensal`
  ADD CONSTRAINT `fk_men_cli` FOREIGN KEY (`mensal_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `profmat`
-- 
ALTER TABLE `profmat`
  ADD CONSTRAINT `fk_matprof` FOREIGN KEY (`profmat_prof`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profmat` FOREIGN KEY (`profmat_mat`) REFERENCES `disciplina` (`disciplina_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `profserie`
-- 
ALTER TABLE `profserie`
  ADD CONSTRAINT `fk_profserie` FOREIGN KEY (`profserie_prof`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profsub` FOREIGN KEY (`profserie_sub`) REFERENCES `sub` (`sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `recado`
-- 
ALTER TABLE `recado`
  ADD CONSTRAINT `fk_reccli` FOREIGN KEY (`recado_cliente`) REFERENCES `cliente` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recprof` FOREIGN KEY (`recado_professor`) REFERENCES `professor` (`professor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Restrições para a tabela `sub`
-- 
ALTER TABLE `sub`
  ADD CONSTRAINT `fk_sub_categoria` FOREIGN KEY (`sub_categoria`) REFERENCES `categoria` (`categoria_id`) ON DELETE CASCADE ON UPDATE CASCADE;
