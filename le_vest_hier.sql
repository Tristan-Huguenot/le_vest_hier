-- -----------------------------------------------------
-- Table `evenements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(63) NOT NULL,
  `date_evenement` DATE NOT NULL,
  `heure_debut` TIME NOT NULL,
  `heure_fin` TIME NOT NULL,
  `description_evenement` VARCHAR(1023) NOT NULL,
  `url_image` VARCHAR(254) NOT NULL,
  `slug_titre` VARCHAR(254) NOT NULL,
  `adresse` VARCHAR(63) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `url_image_UNIQUE` (`url_image` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categorie_articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `categorie_articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `slug` VARCHAR(63) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sous_categorie_articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sous_categorie_articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `categorie_articles_id` INT NOT NULL,
  `slug` VARCHAR(63) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_sous_categorie_articles_categorie_articles1_idx` (`categorie_articles_id` ASC) ,
  CONSTRAINT `fk_sous_categorie_articles_categorie_articles1`
    FOREIGN KEY (`categorie_articles_id`)
    REFERENCES `categorie_articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `articles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date_upload` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `titre` VARCHAR(63) NOT NULL,
  `texte_chapeau` TEXT NOT NULL,
  `url_image_principale` VARCHAR(254) NOT NULL,
  `categorie_articles_id` INT NULL,
  `sous_categorie_articles_id` INT NULL,
  `slug_titre` VARCHAR(254) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `url_image_principale_UNIQUE` (`url_image_principale` ASC) ,
  INDEX `fk_articles_categorie_articles1_idx` (`categorie_articles_id` ASC) ,
  INDEX `fk_articles_sous_categorie_articles1_idx` (`sous_categorie_articles_id` ASC) ,
  CONSTRAINT `fk_articles_categorie_articles1`
    FOREIGN KEY (`categorie_articles_id`)
    REFERENCES `categorie_articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_sous_categorie_articles1`
    FOREIGN KEY (`sous_categorie_articles_id`)
    REFERENCES `sous_categorie_articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `images_secondaires`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `images_secondaires` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `url_image` VARCHAR(254) NOT NULL,
  `articles_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `url_image_UNIQUE` (`url_image` ASC) ,
  INDEX `fk_images_secondaires_articles1_idx` (`articles_id` ASC) ,
  CONSTRAINT `fk_images_secondaires_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sections`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sections` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(63) NULL,
  `url_image` VARCHAR(254) NULL,
  `texte` MEDIUMTEXT NULL,
  `articles_id` INT NOT NULL,
  `slug_titre` VARCHAR(254) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_sections_articles1_idx` (`articles_id` ASC) ,
  UNIQUE INDEX `url_image_UNIQUE` (`url_image` ASC) ,
  CONSTRAINT `fk_sections_articles1`
    FOREIGN KEY (`articles_id`)
    REFERENCES `articles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `partenaires`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `partenaires` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `lien` VARCHAR(254) NOT NULL,
  `url_logo` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) ,
  UNIQUE INDEX `lien_UNIQUE` (`lien` ASC) ,
  UNIQUE INDEX `url_logo_UNIQUE` (`url_logo` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `options`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `options` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `valeur` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) ,
  UNIQUE INDEX `valeur_UNIQUE` (`valeur` ASC) )
ENGINE = InnoDB;

INSERT INTO options(nom, valeur) VALUE ('citation', 'Une citation qui changera dans le temps')