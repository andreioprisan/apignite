# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.9)
# Database: apignite
# Generation Time: 2012-05-18 22:03:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table api_e_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_e_category`;

CREATE TABLE `api_e_category` (
  `api_id` int(11) unsigned NOT NULL,
  `category_id` varchar(32) NOT NULL,
  `c_name` varchar(2048) DEFAULT NULL,
  `c_description` varchar(2048) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `api_e_category` WRITE;
/*!40000 ALTER TABLE `api_e_category` DISABLE KEYS */;

INSERT INTO `api_e_category` (`api_id`, `category_id`, `c_name`, `c_description`)
VALUES
	(1,'1','Members','Members'),
	(1,'2','Organizations','Organizations');

/*!40000 ALTER TABLE `api_e_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table api_e_method
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_e_method`;

CREATE TABLE `api_e_method` (
  `category_id` varchar(32) DEFAULT NULL,
  `method_id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `m_type` enum('get','put','post','delete') NOT NULL DEFAULT 'get',
  `m_name` varchar(128) DEFAULT NULL,
  `m_description` varchar(2048) DEFAULT NULL,
  `m_uid` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`method_id`),
  UNIQUE KEY `m_uid` (`m_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `api_e_method` WRITE;
/*!40000 ALTER TABLE `api_e_method` DISABLE KEYS */;

INSERT INTO `api_e_method` (`category_id`, `method_id`, `m_type`, `m_name`, `m_description`, `m_uid`)
VALUES
	('1',1,'get','/members',NULL,'1a179b525b7bbe190aac43e6e0c2136f'),
	('1',3,'get','/members/{memberid}',NULL,'f2cdf054d7815cd0bcca1a57b8c324b0'),
	('1',4,'put','/members/{memberid}',NULL,'46ea753a9446b2536c2071730949db0e'),
	('1',5,'post','/members/{memberid}',NULL,'d00b32a5540331965afc202cc2e83620'),
	('1',6,'delete','/members/{memberid}',NULL,'1f8743b587364416d10e326ce159fea8'),
	('2',7,'get','/orgs/{org}/members',NULL,'44503b539ac36467f52a1ee3ee5217fd'),
	('2',8,'get','/orgs/{org}/members/{memberid}',NULL,'a03c812ecc35da23971a1f451de9849b'),
	('2',9,'put','/orgs/{org}/members/{memberid}',NULL,'0d82a4f2413175c58554b5c724c08a45'),
	('2',10,'delete','/orgs/{org}/members/{memberid}',NULL,'44713712e2293932416913b228ffda82');

/*!40000 ALTER TABLE `api_e_method` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table api_e_param
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_e_param`;

CREATE TABLE `api_e_param` (
  `method_id` int(32) unsigned NOT NULL,
  `param_id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('int','double','float','string','boolean','blob') DEFAULT NULL,
  `name` varchar(512) DEFAULT NULL,
  `value` varchar(2048) DEFAULT NULL,
  `description` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`param_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `api_e_param` WRITE;
/*!40000 ALTER TABLE `api_e_param` DISABLE KEYS */;

INSERT INTO `api_e_param` (`method_id`, `param_id`, `type`, `name`, `value`, `description`)
VALUES
	(3,1,'int','memberid',NULL,NULL),
	(3,2,'int','limit',NULL,NULL),
	(3,3,'int','depth',NULL,NULL),
	(3,4,'string','name',NULL,NULL);

/*!40000 ALTER TABLE `api_e_param` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table api_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `api_versions`;

CREATE TABLE `api_versions` (
  `api_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `namespace_id` int(11) unsigned DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`api_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table oauth2_authorizations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth2_authorizations`;

CREATE TABLE `oauth2_authorizations` (
  `authorization_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) DEFAULT NULL,
  `state` varchar(32) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `requested` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`authorization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `oauth2_authorizations` WRITE;
/*!40000 ALTER TABLE `oauth2_authorizations` DISABLE KEYS */;

INSERT INTO `oauth2_authorizations` (`authorization_id`, `client_id`, `state`, `code`, `requested`)
VALUES
	(143,'username','5c3d2a17b3c073d5412d7ebcf9f4f2bd','97dd2c5c3c46bab7b027a5fd2d952e74','0000-00-00 00:00:00'),
	(144,'username','d51a911e01fb3489df370a7149df5a54','538c7e506a407a7cf261a7b9d4bbb006','0000-00-00 00:00:00'),
	(145,'username','470bf7623a6b1378eb8718be1a1efe47','34b2f00db4510bf5dad154a47ce5062e','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `oauth2_authorizations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table oauth2_namespaces
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth2_namespaces`;

CREATE TABLE `oauth2_namespaces` (
  `namespace_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` varchar(32) DEFAULT NULL,
  `client_secret` varchar(32) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`namespace_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `oauth2_namespaces` WRITE;
/*!40000 ALTER TABLE `oauth2_namespaces` DISABLE KEYS */;

INSERT INTO `oauth2_namespaces` (`namespace_id`, `client_id`, `client_secret`, `name`)
VALUES
	(1,'username','password','iburnd');

/*!40000 ALTER TABLE `oauth2_namespaces` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table oauth2_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `oauth2_tokens`;

CREATE TABLE `oauth2_tokens` (
  `token_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `namespace_id` int(11) unsigned NOT NULL,
  `authorization_id` int(11) unsigned NOT NULL,
  `token` varchar(32) NOT NULL DEFAULT '',
  `requested` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `oauth2_tokens` WRITE;
/*!40000 ALTER TABLE `oauth2_tokens` DISABLE KEYS */;

INSERT INTO `oauth2_tokens` (`token_id`, `namespace_id`, `authorization_id`, `token`, `requested`)
VALUES
	(143,1,143,'8bd8fe6e50af28544c1a64ea97612077','2012-04-10 00:40:05'),
	(144,1,144,'886c7be8eed65839f5dbd49af54b929b','2012-04-10 13:21:16'),
	(145,1,145,'fa0f89539e2ae47dd9b0435026c82700','2012-04-10 14:03:09');

/*!40000 ALTER TABLE `oauth2_tokens` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table u_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `u_sessions`;

CREATE TABLE `u_sessions` (
  `session_id` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `last_activity` int(10) unsigned DEFAULT NULL,
  `user_data` text NOT NULL,
  KEY `last_activity` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `u_sessions` WRITE;
/*!40000 ALTER TABLE `u_sessions` DISABLE KEYS */;

INSERT INTO `u_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`)
VALUES
	('90f1f201d8571f81599a502ff3b85cbf','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) AppleWebKit/534.56.5 (KHTML, like Gecko) Version/5.1.6 Safari/534.56.5',1337230811,''),
	('bbadb6ac0a7819da794a8fec9cf60625','127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_4) AppleWebKit/534.57.2 (KHTML, like Gecko) Version/5.1.7 Safari/534.57.2',1337272244,'');

/*!40000 ALTER TABLE `u_sessions` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
