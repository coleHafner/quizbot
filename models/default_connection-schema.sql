
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- classroom
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `classroom`;

CREATE TABLE `classroom`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`session_id` INTEGER(10) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`archived` INT(10),
	`created` INT(10) NOT NULL,
	`updated` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `created_by_user_id` (`session_id`(10)),
	CONSTRAINT `classroom_ibfk_1`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- device
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `device`;

CREATE TABLE `device`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`session_id` INTEGER(10) NOT NULL,
	`classroom_id` INTEGER(10) NOT NULL,
	`uuid` VARCHAR(255) NOT NULL,
	`color` VARCHAR(255),
	`nickname` VARCHAR(255),
	`archived` INT(10),
	`created` INT(10) NOT NULL,
	`updated` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `created_by_user_id` (`session_id`(10)),
	INDEX `classroom_id` (`classroom_id`(10)),
	CONSTRAINT `device_ibfk_2`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `device_ibfk_3`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- question
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`session_id` INTEGER(10) NOT NULL,
	`quiz_id` INTEGER(10) NOT NULL,
	`correct_answer_id` INTEGER(10),
	`correct_answer_boolean` VARCHAR(1),
	`type` INTEGER(10) NOT NULL,
	`text` VARCHAR(1080) NOT NULL,
	`archived` INT(10),
	`created` INT(10) NOT NULL,
	`updated` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `created_by_user_id` (`session_id`(10)),
	INDEX `session_id` (`session_id`(10)),
	INDEX `quiz_id` (`quiz_id`(10)),
	INDEX `quiz_id_2` (`quiz_id`(10)),
	INDEX `correct_answer_id` (`correct_answer_id`(10)),
	CONSTRAINT `question_ibfk_3`
		FOREIGN KEY (`correct_answer_id`)
		REFERENCES `question_answer` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `question_ibfk_1`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `question_ibfk_2`
		FOREIGN KEY (`quiz_id`)
		REFERENCES `quiz` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- question_answer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `question_answer`;

CREATE TABLE `question_answer`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`question_id` INTEGER(10) NOT NULL,
	`session_id` INTEGER(10) NOT NULL,
	`priority` INTEGER(10) DEFAULT 0 NOT NULL,
	`text` VARCHAR(1080) NOT NULL,
	`archived` INT(10),
	`created` INT(10) NOT NULL,
	`updated` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `question_id` (`question_id`(10)),
	INDEX `created_by_user_id` (`session_id`(10)),
	CONSTRAINT `question_answer_ibfk_2`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `question_answer_ibfk_1`
		FOREIGN KEY (`question_id`)
		REFERENCES `question` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz`;

CREATE TABLE `quiz`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`session_id` INTEGER(10) NOT NULL,
	`classroom_id` INTEGER(10) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`archived` INT(10),
	`created` INT(10) NOT NULL,
	`updated` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `created_by_user_id` (`session_id`(10)),
	INDEX `classroom_id` (`classroom_id`(10)),
	CONSTRAINT `quiz_ibfk_1`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `quiz_ibfk_2`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_session
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_session`;

CREATE TABLE `quiz_session`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`session_id` INTEGER(10) NOT NULL,
	`quiz_id` INTEGER(10) NOT NULL,
	`opened` INT(10) NOT NULL,
	`closed` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `created_by_user_id` (`session_id`(10)),
	INDEX `quiz_id` (`quiz_id`(10)),
	CONSTRAINT `quiz_session_ibfk_3`
		FOREIGN KEY (`quiz_id`)
		REFERENCES `quiz` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `quiz_session_ibfk_4`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_session_attempt
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_session_attempt`;

CREATE TABLE `quiz_session_attempt`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`quiz_session_id` INTEGER(10) NOT NULL,
	`quiz_session_question_id` INTEGER(10) NOT NULL,
	`quiz_session_device_id` INTEGER(10) NOT NULL,
	`answer_choice` INTEGER(10) NOT NULL,
	`answer_text` VARCHAR(1080) NOT NULL,
	`correct` TINYINT(1) NOT NULL,
	`created` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `classroom_id` (`answer_choice`(10)),
	INDEX `quiz_session_question_id` (`quiz_session_question_id`(10)),
	INDEX `quiz_session_device_id` (`quiz_session_device_id`(10)),
	INDEX `quiz_session_id` (`quiz_session_id`(10)),
	CONSTRAINT `quiz_session_attempt_ibfk_1`
		FOREIGN KEY (`quiz_session_question_id`)
		REFERENCES `quiz_session_question` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `quiz_session_attempt_ibfk_2`
		FOREIGN KEY (`quiz_session_device_id`)
		REFERENCES `quiz_session_device` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `quiz_session_attempt_ibfk_3`
		FOREIGN KEY (`quiz_session_id`)
		REFERENCES `quiz_session` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_session_device
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_session_device`;

CREATE TABLE `quiz_session_device`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`quiz_session_id` INTEGER(10) NOT NULL,
	`device_id` INTEGER(10) NOT NULL,
	`user_id` INTEGER(10) NOT NULL,
	`created` INT(10),
	PRIMARY KEY (`id`),
	INDEX `device_id` (`device_id`(10)),
	INDEX `user_id` (`user_id`(10)),
	INDEX `quiz_session_id` (`quiz_session_id`(10)),
	CONSTRAINT `quiz_session_device_ibfk_1`
		FOREIGN KEY (`device_id`)
		REFERENCES `device` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `quiz_session_device_ibfk_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `quiz_session_device_ibfk_3`
		FOREIGN KEY (`quiz_session_id`)
		REFERENCES `quiz_session` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- quiz_session_question
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `quiz_session_question`;

CREATE TABLE `quiz_session_question`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`quiz_session_id` INTEGER(10) NOT NULL,
	`question_id` INTEGER(10) NOT NULL,
	`question_text` VARCHAR(1080) NOT NULL,
	`opened` INT(10) NOT NULL,
	`closed` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `quiz_id` (`question_id`(10)),
	INDEX `quiz_session_id` (`quiz_session_id`(10)),
	CONSTRAINT `quiz_session_question_ibfk_1`
		FOREIGN KEY (`quiz_session_id`)
		REFERENCES `quiz_session` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `quiz_session_question_ibfk_2`
		FOREIGN KEY (`question_id`)
		REFERENCES `question` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- session
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER(10),
	`classroom_id` INTEGER(10),
	`ip_address` VARCHAR(100),
	`user_agent` VARCHAR(255),
	`started` INT,
	`ended` INT,
	PRIMARY KEY (`id`),
	INDEX `user_id` (`user_id`(10)),
	INDEX `user_id_2` (`user_id`(10)),
	INDEX `classroom_id` (`classroom_id`(10)),
	CONSTRAINT `session_ibfk_2`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `session_ibfk_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
	`id` INTEGER(10) NOT NULL AUTO_INCREMENT,
	`session_id` INTEGER(10) NOT NULL,
	`first_name` VARCHAR(255),
	`last_name` VARCHAR(255),
	`email` VARCHAR(255) NOT NULL,
	`password` VARCHAR(200) NOT NULL,
	`salt` VARCHAR(200) NOT NULL,
	`type` INTEGER NOT NULL,
	`archived` INT(10),
	`last_login` INT(10),
	`created` INT(10) NOT NULL,
	`updated` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email`(255)),
	UNIQUE INDEX `user_unique_email` (`email`(255)),
	INDEX `session_id` (`session_id`(10)),
	CONSTRAINT `user_ibfk_1`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_role
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role`
(
	`user_id` INTEGER(10) NOT NULL,
	`role_id` INTEGER(10) NOT NULL,
	`session_id` INTEGER(10) NOT NULL,
	`classroom_id` INTEGER(10),
	`archived` INT(10),
	`created` INT(10),
	`updated` INT(10),
	PRIMARY KEY (`user_id`,`role_id`),
	INDEX `classroom_id` (`classroom_id`(10)),
	INDEX `classroom_id_2` (`classroom_id`(10)),
	INDEX `session_id` (`session_id`(10)),
	CONSTRAINT `user_role_ibfk_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `user_role_ibfk_2`
		FOREIGN KEY (`classroom_id`)
		REFERENCES `classroom` (`id`)
		ON UPDATE CASCADE,
	CONSTRAINT `user_role_ibfk_3`
		FOREIGN KEY (`session_id`)
		REFERENCES `session` (`id`)
		ON UPDATE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
