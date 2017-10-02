CREATE TABLE `sc_festival_inscripciones` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_paquete` INT(11) NOT NULL,
	`id_socio` INT(11) NULL DEFAULT NULL,
	`fecha_inscripcion` DATETIME NOT NULL,
	`dni` INT(11) NULL DEFAULT NULL,
	`nombre` VARCHAR(100) NULL DEFAULT NULL,
	`apellido` VARCHAR(50) NULL DEFAULT NULL,
	`valor` INT(11) NULL DEFAULT NULL,
	`nro_socio` INT(11) NULL DEFAULT NULL,
	`estado_pago` INT(11) NULL DEFAULT NULL,
	`telefono` VARCHAR(50) NULL DEFAULT NULL,
	`email` VARCHAR(100) NULL DEFAULT NULL,
	`ip` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=41
;

ALTER TABLE `sc_festival_inscripciones`
	ADD COLUMN `nro_compobante` VARCHAR(50) NOT NULL AFTER `estado_pago`,
	ADD COLUMN `fecha_pago` DATE NOT NULL AFTER `nro_compobante`;