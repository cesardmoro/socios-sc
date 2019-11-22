CREATE TABLE `sc_contest` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`competition_name` VARCHAR(50) NULL DEFAULT '0',
	`competition_username` VARCHAR(50) NULL DEFAULT '0',
	`competition_password` VARCHAR(50) NULL DEFAULT '0',
	`entries_file` VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='Contest from reggie beer'
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;


CREATE TABLE `sc_contest_entrants` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`id_contest` BIGINT(20) NULL DEFAULT NULL,
	`name` VARCHAR(80) NULL DEFAULT NULL,
	`email` VARCHAR(80) NULL DEFAULT NULL,
	`phone` VARCHAR(80) NULL DEFAULT NULL,
	`adress` VARCHAR(80) NULL DEFAULT NULL,
	`adherent_id` VARCHAR(80) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `id_contest` (`id_contest`)
)
COMMENT='Name	Email	Phone	Club	Address	#Entries	EntrantQA Answer'
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=19
;
CREATE TABLE `sc_contest_entries` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`id_contest` BIGINT(20) NULL DEFAULT '0',
	`entrant_name` VARCHAR(80) NULL DEFAULT '0',
	`entry_name` VARCHAR(80) NULL DEFAULT '0',
	`style` VARCHAR(10) NULL DEFAULT '0',
	`substyle_name` VARCHAR(10) NULL DEFAULT '0',
	`entry` INT(11) NULL DEFAULT '0',
	`entry_file` VARCHAR(50) NULL DEFAULT NULL,
	`entry_sent` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `id_contest` (`id_contest`),
	INDEX `entrant_name` (`entrant_name`)
)
COMMENT='Entrant Name	Entry Name	Style	SubStyle Name	Entry'
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1725
;
ALTER TABLE `sc_contest_entries`
	ADD COLUMN `entry_confirm` TINYINT UNSIGNED NULL DEFAULT '0' AFTER `entry`;
