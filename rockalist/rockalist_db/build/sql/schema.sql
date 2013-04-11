
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- track
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `track`;

CREATE TABLE `track`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `url` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `genre` VARCHAR(255),
    `year` INTEGER,
    `date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `artist_id` INTEGER NOT NULL,
    `album_id` INTEGER,
    `user_id` INTEGER NOT NULL,
    `rating_total` INTEGER,
    `rating_count` INTEGER,
    `rating_average` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `track_FI_1` (`artist_id`),
    INDEX `track_FI_2` (`album_id`),
    INDEX `track_FI_3` (`user_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- artist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `artist`;

CREATE TABLE `artist`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- album
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `album`;

CREATE TABLE `album`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `year` INTEGER,
    `artist_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `album_FI_1` (`artist_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `name` VARCHAR(128),
    `password` VARCHAR(255) NOT NULL,
    `subscribed` TINYINT(1) DEFAULT 0 NOT NULL,
    `registered` TINYINT(1) DEFAULT 0 NOT NULL,
    `uniqueid` VARCHAR(255) NOT NULL,
    `date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_login` DATETIME,
    PRIMARY KEY (`id`,`email`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- friend
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `friend`;

CREATE TABLE `friend`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER NOT NULL,
    `friend_email` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `friend_FI_1` (`user_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- playlist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `playlist`;

CREATE TABLE `playlist`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(128) NOT NULL,
    `user_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `playlist_FI_1` (`user_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- playlisttrack
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `playlisttrack`;

CREATE TABLE `playlisttrack`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `synced` TINYINT(1) DEFAULT 0 NOT NULL,
    `err_msg` VARCHAR(255),
    `playlist_id` INTEGER NOT NULL,
    `track_id` INTEGER NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `playlisttrack_FI_1` (`playlist_id`),
    INDEX `playlisttrack_FI_2` (`track_id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
