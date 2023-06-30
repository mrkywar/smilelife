
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- Smile Life implementation : © Jean Portemer <jportemer@mailz.org> & Mr_Kywar <mr_kywar@gmail.com>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

CREATE TABLE IF NOT EXISTS `log` (
    `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `log_date` varchar(50) NOT NULL,
    `log_category` varchar(50) NOT NULL,
    `log_content` text NOT NULL,
    PRIMARY KEY(`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `game` (
    `game_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `game_option` text NULL,
    `game_aviable_cards` float(5.2) NULL,
    PRIMARY KEY(`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `player_attributes`(
    `attributes_player_id` int(10) UNSIGNED NOT NULL,
    `attributes_max_cards` int(1) UNSIGNED NOT NULL,
    `attributes_pass_turn` int(1) UNSIGNED 0,
    PRIMARY KEY(`attributes_player_id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `card` (
  `card_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_class` varchar(255) NOT NULL COMMENT 'Type of the card (matches the class name the card need to be instanciated with)',
  `card_type` int(10) NULL COMMENT 'Type of the card to display',
  `card_owner_id` int(10) NULL COMMENT 'The id of the owner it it means something. 0 otherwise',
  `card_location` varchar(50) NULL COMMENT 'deck, hand, discard, removed, or a specific location on board',
  `card_location_arg` int(10) NULL COMMENT 'Position in the given location (+ owner if there is one). Bottom is 0, top is max.',
  `card_table_location` varchar(50) NULL COMMENT 'pile name (used when card is on a player board)',
  `card_discarder_id` int(10) NULL COMMENT 'The id of the player who discarded the card, only if the card is in discard location. That player cannot take this card back. 0 otherwise',
  `card_is_flipped` BOOLEAN NOT NULL COMMENT 'FALSE if the card is face up, TRUE if the card is flipped (ie. in deck or protected in player location)',
  `card_is_used` BOOLEAN NOT NULL COMMENT 'FALSE if the card is ready to be use, TRUE if the card is used (used for flirts enabling children, when that card was used to have a child)',
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `player_table` (
    `table_player_id` int(10) unsigned NOT NULL,
    `table_sudies` text NULL,
    `table_job` int(10) unsigned NULL,
    `table_rewards` text NULL,
    `table_warges` text NULL,
    `table_flirts` text NULL,
    `table_marriage` int(10) unsigned NULL,
    `table_childs` text NULL,
    `table_adultery` int(10) unsigned NULL,
    `table_adultery_flirts` text NULL,
    `table_acquisitions` text NULL,
    `table_attacks` text NULL,
    `table_specials` text NULL,
    PRIMARY KEY (`table_player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
