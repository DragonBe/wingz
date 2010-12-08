DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`firstname` VARCHAR(125) NOT NULL,
	`lastname` VARCHAR(125) NOT NULL,
	`email` VARCHAR(250) NOT NULL,
	`username` VARCHAR(250) NOT NULL,
	`password` CHAR(32) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_username_uk` (`username`),
	UNIQUE KEY `user_email_uk` (`email`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `faq`;
CREATE TABLE IF NOT EXISTS `faq` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`question` VARCHAR(250) NOT NULL,
	`answer` VARCHAR(250) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(250) NOT NULL,
	`contents` TEXT NULL,
	`user_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `article_user_fk` (`user_id`),
    CONSTRAINT `article_user_fk`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON DELETE SET NULL
		ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `article_tags`;
CREATE TABLE IF NOT EXISTS `article_tags` (
	`article_id` INT UNSIGNED NOT NULL,
	`tag_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`article_id`, `tag_id`),
	INDEX `article_tags_article_fk` (`article_id`),
	INDEX `article_tags_tag_fk` (`tag_id`),
	CONSTRAINT `article_tags_article_fk`
	   FOREIGN KEY (`article_id`)
	   REFERENCES `article` (`id`)
	   ON DELETE SET NULL,
	   ON UPDATE CASCADE,
    CONSTRAINT `article_tags_tag_fk`
       FOREIGN KEY (`tag_id`)
       REFERENCES `tag` (`id`)
       ON DELETE SET NULL
       ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`label` VARCHAR(250) NOT NULL,
	`count` INT UNSIGNED NOT NULL DEFAULT 1,
	PRIMARY KEY (`id`),
	UNIQUE KEY `tag_label_uk` (`label`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `article_comment`;
CREATE TABLE IF NOT EXISTS `article_comment` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(250) NOT NULL,
	`comment` TEXT NULL,
	`article_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `article_comment_article_uk` (`article_id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS `article_comment_user`;
CREATE TABLE IF NOT EXISTS `article_comment_user` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`fullname` VARCHAR(250) NOT NULL,
	`email` VARCHAR(250) NOT NULL,
	`website` VARCHAR(250) NULL,
	`comment_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY (`email`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `version` (
	`version` INT UNSIGNED NOT NULL DEFAULT 0,
	PRIMARY KEY (`version`)
) ENGINE=MyIsam CHARACTER SET utf8 COLLATE utf8_general_ci;
