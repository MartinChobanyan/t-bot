SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+04:00";

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` tinytext NOT NULL,
  `token` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0;