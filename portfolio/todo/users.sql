
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE users;

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL,
  `un` varchar(64) NOT NULL,
  `pw` varchar(64) NOT NULL,
  `cdate` datetime NOT NULL,
  `ldate` datetime NOT NULL,
  `alevel` varchar(8) NULL
) ENGINE=InnoDB;

ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);
