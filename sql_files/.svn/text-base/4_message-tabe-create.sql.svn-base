/* Create the Message Archive Table */
CREATE  TABLE `frank73_rss`.`rss_message` (
  `message_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `feed_id` BIGINT UNSIGNED NOT NULL ,
  `message_title` VARCHAR(2048) NULL ,
  `message_detail` MEDIUMTEXT NULL ,
  `message_link` VARCHAR(2048) NULL ,
  `feed_title` VARCHAR(2048) NULL ,
  `attribute1` VARCHAR(2048) NULL ,
  `attribute2` VARCHAR(2048) NULL ,
  `attribute3` VARCHAR(2048) NULL ,
  `attribute4` VARCHAR(2048) NULL ,
  `attribute5` VARCHAR(2048) NULL ,
  `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`message_id`) ,
  UNIQUE INDEX `message_id_UNIQUE` (`message_id` ASC) )
ENGINE = MyISAM;