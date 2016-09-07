# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.7.9)
# Схема: school_marks
# Время создания: 2016-09-07 10:20:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы learner
# ------------------------------------------------------------

DROP TABLE IF EXISTS `learner`;

CREATE TABLE `learner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parents_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8EF3834B706B6D3` (`parents_id`),
  CONSTRAINT `FK_8EF3834B706B6D3` FOREIGN KEY (`parents_id`) REFERENCES `parents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `learner` WRITE;
/*!40000 ALTER TABLE `learner` DISABLE KEYS */;

INSERT INTO `learner` (`id`, `title`, `parents_id`, `created`)
VALUES
	(3,'Зинкович Игнат Александрович',2,'2016-09-07 10:00:00'),
	(4,'Зинкович Юлия Владимировна',3,'2016-09-07 10:00:00'),
	(5,'Линник Юрий Сергеевич',2,'2016-09-07 10:00:00'),
	(6,'Линник Ольга Александровна',3,'2016-09-07 10:00:00');

/*!40000 ALTER TABLE `learner` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы mark
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mark`;

CREATE TABLE `mark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mark` int(11) NOT NULL,
  `learner_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6674F2716209CB66` (`learner_id`),
  KEY `IDX_6674F27141807E1D` (`teacher_id`),
  KEY `IDX_6674F27123EDC87` (`subject_id`),
  CONSTRAINT `FK_6674F27123EDC87` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`),
  CONSTRAINT `FK_6674F27141807E1D` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`),
  CONSTRAINT `FK_6674F2716209CB66` FOREIGN KEY (`learner_id`) REFERENCES `learner` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `mark` WRITE;
/*!40000 ALTER TABLE `mark` DISABLE KEYS */;

INSERT INTO `mark` (`id`, `mark`, `learner_id`, `teacher_id`, `subject_id`, `created`)
VALUES
	(2,5,3,1,1,'2016-09-07 10:00:00'),
	(3,4,3,2,2,'2016-09-07 10:00:00'),
	(4,3,3,3,3,'2016-09-01 10:00:00'),
	(5,2,3,1,4,'2016-09-01 10:00:00'),
	(6,3,3,2,5,'2016-09-07 10:00:00'),
	(7,2,3,3,6,'2016-09-07 10:00:00'),
	(8,5,3,1,7,'2016-09-07 10:00:00'),
	(9,5,4,1,7,'2016-09-07 10:00:00'),
	(10,5,5,1,7,'2016-09-07 10:00:00');

/*!40000 ALTER TABLE `mark` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы parents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `parents`;

CREATE TABLE `parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `parents` WRITE;
/*!40000 ALTER TABLE `parents` DISABLE KEYS */;

INSERT INTO `parents` (`id`, `title`, `created`)
VALUES
	(2,'Иванова Татьяна Сергеевна','2016-09-07 10:00:00'),
	(3,'Иванов Олег Анатольевич','2016-09-07 10:00:00');

/*!40000 ALTER TABLE `parents` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы subject
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subject`;

CREATE TABLE `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;

INSERT INTO `subject` (`id`, `title`, `created`)
VALUES
	(1,'Физкультура','2016-09-07 10:00:00'),
	(2,'Математика','2016-09-07 10:00:00'),
	(3,'Биология','2016-09-07 10:00:00'),
	(4,'ОБЖ','2016-09-07 10:00:00'),
	(5,'Правоведение','2016-09-07 10:00:00'),
	(6,'Химия','2016-09-07 10:00:00'),
	(7,'Английский язык','2016-09-07 10:00:00');

/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы teacher
# ------------------------------------------------------------

DROP TABLE IF EXISTS `teacher`;

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;

INSERT INTO `teacher` (`id`, `title`, `created`)
VALUES
	(1,'Борисов Владимир Петрович','2016-09-07 10:00:00'),
	(2,'ПолтавскаяМария Сергеевна','2016-09-07 10:00:00'),
	(3,'Шевчук Александр Петрович','2016-09-07 10:00:00');

/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
