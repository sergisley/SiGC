SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `sigc_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `sigc_db` ;

-- -----------------------------------------------------
-- Table `sigc_db`.`empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`empresa` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`empresa` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `usuario_id_responsavel` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_empresa_usuario1_idx` (`usuario_id_responsavel` ASC),
  CONSTRAINT `fk_empresa_usuario1`
    FOREIGN KEY (`usuario_id_responsavel`)
    REFERENCES `sigc_db`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`setor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`setor` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`setor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `empresa_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_setor_empresa1_idx` (`empresa_id` ASC),
  CONSTRAINT `fk_setor_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `sigc_db`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`usuario` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(90) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `senha` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `telefone` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `perfil` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `setor_id` INT(11) NOT NULL,
  `empresa_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_setor1_idx` (`setor_id` ASC),
  INDEX `fk_usuario_empresa1_idx` (`empresa_id` ASC),
  CONSTRAINT `fk_usuario_setor1`
    FOREIGN KEY (`setor_id`)
    REFERENCES `sigc_db`.`setor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `sigc_db`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`equipamento_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`equipamento_categoria` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`equipamento_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `empresa_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipamento_categoria_empresa1_idx` (`empresa_id` ASC),
  CONSTRAINT `fk_equipamento_categoria_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `sigc_db`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`equipamento_subcategoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`equipamento_subcategoria` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`equipamento_subcategoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `equipamento_categoria_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipamento_subcategoria_equipamento_categoria1_idx` (`equipamento_categoria_id` ASC),
  CONSTRAINT `fk_equipamento_subcategoria_equipamento_categoria1`
    FOREIGN KEY (`equipamento_categoria_id`)
    REFERENCES `sigc_db`.`equipamento_categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`equipamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`equipamento` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`equipamento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `equipamento_subcategoria_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipamento_equipamento_subcategoria1_idx` (`equipamento_subcategoria_id` ASC),
  CONSTRAINT `fk_equipamento_equipamento_subcategoria1`
    FOREIGN KEY (`equipamento_subcategoria_id`)
    REFERENCES `sigc_db`.`equipamento_subcategoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`chamado_categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`chamado_categoria` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`chamado_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `empresa_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_chamado_categoria_empresa1_idx` (`empresa_id` ASC),
  CONSTRAINT `fk_chamado_categoria_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `sigc_db`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`chamado_subcategoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`chamado_subcategoria` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`chamado_subcategoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `chamado_categoria_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_chamado_subcategoria_chamado_categoria1_idx` (`chamado_categoria_id` ASC),
  CONSTRAINT `fk_chamado_subcategoria_chamado_categoria1`
    FOREIGN KEY (`chamado_categoria_id`)
    REFERENCES `sigc_db`.`chamado_categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`chamado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`chamado` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`chamado` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `chamado_status` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `usuario_id` INT(11) NOT NULL,
  `empresa_id` INT(11) NOT NULL,
  `equipamento_id` INT(11) NOT NULL,
  `chamado_categoria_id` INT(11) NOT NULL,
  `chamado_subcategoria_id` INT(11) NOT NULL,
  `usuario_id_tecnico` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_chamado_usuario_idx` (`usuario_id` ASC),
  INDEX `fk_chamado_empresa1_idx` (`empresa_id` ASC),
  INDEX `fk_chamado_equipamento1_idx` (`equipamento_id` ASC),
  INDEX `fk_chamado_chamado_categoria1_idx` (`chamado_categoria_id` ASC),
  INDEX `fk_chamado_chamado_subcategoria1_idx` (`chamado_subcategoria_id` ASC),
  INDEX `fk_chamado_usuario1_idx` (`usuario_id_tecnico` ASC),
  CONSTRAINT `fk_chamado_usuario`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `sigc_db`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_empresa1`
    FOREIGN KEY (`empresa_id`)
    REFERENCES `sigc_db`.`empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_equipamento1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `sigc_db`.`equipamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_chamado_categoria1`
    FOREIGN KEY (`chamado_categoria_id`)
    REFERENCES `sigc_db`.`chamado_categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_chamado_subcategoria1`
    FOREIGN KEY (`chamado_subcategoria_id`)
    REFERENCES `sigc_db`.`chamado_subcategoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamado_usuario1`
    FOREIGN KEY (`usuario_id_tecnico`)
    REFERENCES `sigc_db`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`equipamento_atributo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`equipamento_atributo` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`equipamento_atributo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `equipamento_subcategoria_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipamento_atributo_equipamento_subcategoria1_idx` (`equipamento_subcategoria_id` ASC),
  CONSTRAINT `fk_equipamento_atributo_equipamento_subcategoria1`
    FOREIGN KEY (`equipamento_subcategoria_id`)
    REFERENCES `sigc_db`.`equipamento_subcategoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`equipamento_por_atributo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`equipamento_por_atributo` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`equipamento_por_atributo` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `valor_atributo` VARCHAR(90) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `equipamento_id` INT(11) NOT NULL,
  `equipamento_atributo_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `equipamento_id`),
  INDEX `fk_equipamento_por_atributo_equipamento1_idx` (`equipamento_id` ASC),
  INDEX `fk_equipamento_por_atributo_equipamento_atributo1_idx` (`equipamento_atributo_id` ASC),
  CONSTRAINT `fk_equipamento_por_atributo_equipamento1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `sigc_db`.`equipamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_por_atributo_equipamento_atributo1`
    FOREIGN KEY (`equipamento_atributo_id`)
    REFERENCES `sigc_db`.`equipamento_atributo` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `sigc_db`.`historico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sigc_db`.`historico` ;

CREATE TABLE IF NOT EXISTS `sigc_db`.`historico` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descrição` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `acao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `datahora` DATETIME NULL DEFAULT NULL,
  `chamado_id` INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `equipamento_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_historico_chamado1_idx` (`chamado_id` ASC),
  INDEX `fk_historico_usuario1_idx` (`usuario_id` ASC),
  INDEX `fk_historico_equipamento1_idx` (`equipamento_id` ASC),
  CONSTRAINT `fk_historico_chamado1`
    FOREIGN KEY (`chamado_id`)
    REFERENCES `sigc_db`.`chamado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historico_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `sigc_db`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_historico_equipamento1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `sigc_db`.`equipamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
