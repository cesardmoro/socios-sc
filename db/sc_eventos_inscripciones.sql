ALTER TABLE `sc_eventos_inscripciones`
	ADD COLUMN `dni` INT NULL AFTER `fecha_inscripcion`,
	ADD COLUMN `nombre` VARCHAR(100) NULL AFTER `dni`,
	ADD COLUMN `telefono` VARCHAR(50) NULL AFTER `nombre`,
	ADD COLUMN `email` VARCHAR(100) NULL AFTER `telefono`,
	ADD COLUMN `ip` VARCHAR(50) NULL AFTER `email`;
ALTER TABLE `sc_eventos_inscripciones`
	ALTER `id_socio` DROP DEFAULT;
ALTER TABLE `sc_eventos_inscripciones`
	CHANGE COLUMN `id_socio` `id_socio` INT(11) NULL AFTER `id_evento`;

ALTER TABLE `sc_eventos`
	ADD COLUMN `inscripcion_no_socios_apartir_de` DATE NULL AFTER `reservados`;