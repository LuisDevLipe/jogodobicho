-- MySQL Script generated by MySQL Workbench
-- Sun Oct 13 22:02:19 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_jogodobicho
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_jogodobicho
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_jogodobicho` DEFAULT CHARACTER SET utf8 ;
USE `db_jogodobicho` ;

-- -----------------------------------------------------
-- Table `db_jogodobicho`.`address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jogodobicho`.`address` (
  `ID` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cep` VARCHAR(8) NULL,
  `logradouro` VARCHAR(255) NULL,
  `numero` INT NULL,
  `cidade` VARCHAR(255) NULL,
  `estado` VARCHAR(255) NULL,
  `complemento` VARCHAR(255) NULL,
  `bairro` VARCHAR(255) NULL,
  `pais` VARCHAR(255) NULL,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jogodobicho`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jogodobicho`.`users` (
  `ID` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(255) NULL,
  `dob` DATE NULL,
  `gender` VARCHAR(1) NULL,
  `mothername` VARCHAR(255) NULL,
  `cpf` VARCHAR(11) NULL,
  `email` VARCHAR(255) NULL,
  `celular` VARCHAR(11) NULL,
  `fixo` VARCHAR(11) NULL,
  `created_at` TIMESTAMP NULL DEFAULT current_timestamp,
  `updated_at` TIMESTAMP NULL DEFAULT current_timestamp on update current_timestamp,
  `address_id` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  INDEX `fk_users_adress1_idx` (`address_id` ASC),
  CONSTRAINT `fk_users_adress1`
    FOREIGN KEY (`address_id`)
    REFERENCES `db_jogodobicho`.`address` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jogodobicho`.`credentials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jogodobicho`.`credentials` (
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `rootuser` TINYINT(1) NOT NULL DEFAULT 0,
  `login_attempts` TINYINT(3) NOT NULL DEFAULT 0,
  `locked_account` TINYINT(1) NOT NULL DEFAULT 0,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE INDEX `ID_UNIQUE` (`username` ASC),
  INDEX `fk_Credentials_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_Credentials_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_jogodobicho`.`users` (`ID`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_jogodobicho`.`userLogs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_jogodobicho`.`userLogs` (
  `ID` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` VARCHAR(255) NOT NULL,
  `login_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
  `TwoFaAnswer` VARCHAR(255) NOT NULL,
  `username` VARCHAR(255) NULL DEFAULT ,
  PRIMARY KEY (`ID`),
  UNIQUE INDEX `ID_UNIQUE` (`ID` ASC),
  INDEX `fk_userLogs_Credentials1_idx` (`username` ASC),
  CONSTRAINT `fk_userLogs_Credentials1`
    FOREIGN KEY (`username`)
    REFERENCES `db_jogodobicho`.`credentials` (`username`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;