SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `annuaire` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `annuaire`;

-- -----------------------------------------------------
-- Table `annuaire`.`ville`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `annuaire`.`ville` (
  `idVille` INT NOT NULL AUTO_INCREMENT ,
  `cpVille` INT NOT NULL ,
  `nomVille` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idVille`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `annuaire`.`contact`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `annuaire`.`contact` (
  `idContact` INT NOT NULL AUTO_INCREMENT ,
  `nomContact` VARCHAR(45) NOT NULL ,
  `prenomContact` VARCHAR(45) NOT NULL ,
  `sexeContact` CHAR(1) NOT NULL ,
  `dateNaissance` DATE NULL ,
  `idResponsable1` INT NULL ,
  `idResponsable2` INT NULL ,
  `numLicence` VARCHAR(7) NULL ,
  `mutation` BOOLEAN NOT NULL DEFAULT false ,
  `surclassement` BOOLEAN NOT NULL DEFAULT false ,
  `brulure` BOOLEAN NOT NULL DEFAULT false ,
  `dateQualification` DATE NULL ,
  `adresseL1` VARCHAR(45) NULL ,
  `adresseL2` VARCHAR(45) NULL ,
  `ville_idVille` INT NULL ,
  `tel1` INT NULL ,
  `tel2` INT NULL ,
  `email` VARCHAR(150) NULL ,
  `notes` TEXT(300) NOT NULL ,
  PRIMARY KEY (`idContact`) ,
  INDEX `fk_contact_ville` (`ville_idVille` ASC) ,
  INDEX `fk_contact_contact` (`idResponsable1` ASC) ,
  INDEX `fk_contact_contact1` (`idResponsable2` ASC) ,
  CONSTRAINT `fk_contact_ville`
    FOREIGN KEY (`ville_idVille` )
    REFERENCES `annuaire`.`ville` (`idVille` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contact_contact`
    FOREIGN KEY (`idResponsable1` )
    REFERENCES `annuaire`.`contact` (`idContact` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contact_contact1`
    FOREIGN KEY (`idResponsable2` )
    REFERENCES `annuaire`.`contact` (`idContact` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `annuaire`.`groupe`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `annuaire`.`groupe` (
  `idGroupe` INT NOT NULL ,
  `nomGroupe` VARCHAR(45) NOT NULL ,
  `idResponsable` INT NULL ,
  PRIMARY KEY (`idGroupe`) ,
  INDEX `fk_groupe_contact` (`idResponsable` ASC) ,
  CONSTRAINT `fk_groupe_contact`
    FOREIGN KEY (`idResponsable` )
    REFERENCES `annuaire`.`contact` (`idContact` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `annuaire`.`membre_groupe`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `annuaire`.`membre_groupe` (
  `groupe_idGroupe` INT NOT NULL ,
  `contact_idContact` INT NOT NULL ,
  PRIMARY KEY (`groupe_idGroupe`, `contact_idContact`) ,
  INDEX `fk_groupe_has_contact_groupe` (`groupe_idGroupe` ASC) ,
  INDEX `fk_groupe_has_contact_contact` (`contact_idContact` ASC) ,
  CONSTRAINT `fk_groupe_has_contact_groupe`
    FOREIGN KEY (`groupe_idGroupe` )
    REFERENCES `annuaire`.`groupe` (`idGroupe` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_groupe_has_contact_contact`
    FOREIGN KEY (`contact_idContact` )
    REFERENCES `annuaire`.`contact` (`idContact` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
