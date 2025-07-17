
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema hospital
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hospital
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hospital` ;
USE `hospital` ;

-- -----------------------------------------------------
-- Table `hospital`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hospital`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(65) NOT NULL,
  `senha` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hospital`.`medico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hospital`.`medico` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(65) NOT NULL,
  `especialidade` VARCHAR(65) NOT NULL,
  `crm` VARCHAR(10) NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_medico_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_medico_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `hospital`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hospital`.`paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hospital`.`paciente` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(65) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `tipo_sanguineo` VARCHAR(10) NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_paciente_usuario1_idx` (`usuario_id` ASC) VISIBLE,
  CONSTRAINT `fk_paciente_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `hospital`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hospital`.`medico_paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hospital`.`medico_paciente` (
  `medico_id` INT NOT NULL,
  `paciente_id` INT NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `observacao` VARCHAR(500) NULL,
  PRIMARY KEY (`medico_id`, `paciente_id`, `data_hora`),
  INDEX `fk_medico_has_paciente_paciente1_idx` (`paciente_id` ASC) VISIBLE,
  INDEX `fk_medico_has_paciente_medico_idx` (`medico_id` ASC) VISIBLE,
  CONSTRAINT `fk_medico_has_paciente_medico`
    FOREIGN KEY (`medico_id`)
    REFERENCES `hospital`.`medico` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_medico_has_paciente_paciente1`
    FOREIGN KEY (`paciente_id`)
    REFERENCES `hospital`.`paciente` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
