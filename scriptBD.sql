CREATE DATABASE `sigc_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
CREATE TABLE `chamado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chamado_status` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `equipamento_id` int(11) DEFAULT NULL,
  `chamado_subcategoria_id` int(11) DEFAULT NULL,
  `usuario_id_tecnico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chamado_usuario_idx` (`usuario_id`),
  KEY `fk_chamado_equipamento1_idx` (`equipamento_id`),
  KEY `fk_chamado_chamado_subcategoria1_idx` (`chamado_subcategoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `chamado_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `chamado_subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chamado_categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chamado_subcategoria_chamado_categoria1_idx` (`chamado_categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `equipamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipamento_subcategoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipamento_equipamento_subcategoria1_idx` (`equipamento_subcategoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `equipamento_atributo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipamento_subcategoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipamento_atributo_equipamento_subcategoria1_idx` (`equipamento_subcategoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `equipamento_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `equipamento_por_atributo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor_atributo` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipamento_id` int(11) NOT NULL,
  `equipamento_atributo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`equipamento_id`),
  KEY `fk_equipamento_por_atributo_equipamento1_idx` (`equipamento_id`),
  KEY `fk_equipamento_por_atributo_equipamento_atributo1_idx` (`equipamento_atributo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `equipamento_subcategoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `equipamento_categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_equipamento_subcategoria_equipamento_categoria1_idx` (`equipamento_categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `historico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descrição` text COLLATE utf8_unicode_ci,
  `acao` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datahora` datetime DEFAULT NULL,
  `chamado_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `equipamento_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historico_chamado1_idx` (`chamado_id`),
  KEY `fk_historico_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `setor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perfil` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario_setor1_idx` (`setor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
