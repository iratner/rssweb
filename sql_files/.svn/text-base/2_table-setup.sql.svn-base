/* Select the Database to Use */
use frank73_rss;

/* Create the Registered Users Table */
CREATE  TABLE `frank73_rss`.`registered_users` (
  `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(150) NOT NULL ,
  `password` VARCHAR(2048) NOT NULL ,
  `attribute1` VARCHAR(2048) NULL ,
  `attribute2` VARCHAR(2048) NULL ,
  `attribute3` VARCHAR(2048) NULL ,
  `attribute4` VARCHAR(2048) NULL ,
  `attribute5` VARCHAR(2048) NULL ,
  `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` USING BTREE (`email` ASC) )
ENGINE = MyISAM;

/* Create the RSS Feed Table */
CREATE  TABLE `frank73_rss`.`rss_feed` (
  `feed_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `feed_name` VARCHAR(255) NULL ,
  `feed_url` VARCHAR(2048) NOT NULL ,
  `link` VARCHAR(2048) NULL ,
  `title` VARCHAR(255) NULL ,
  `description` VARCHAR(255) NULL ,
  `recommended` BIT NOT NULL DEFAULT 0 ,
  `enabled` BIT NOT NULL DEFAULT 1 ,
  `last_build_date` DATETIME NOT NULL ,
  `pub_date` DATETIME NULL ,
  `image_url` VARCHAR(2048) NULL ,
  `language` VARCHAR(45) NULL ,
  `copyright` VARCHAR(255) NULL ,
  `ttl` BIGINT UNSIGNED NULL ,
  `textInput` VARCHAR(3000) NULL ,
  `attribute1` VARCHAR(2048) NULL ,
  `attribute2` VARCHAR(2048) NULL ,
  `attribute3` VARCHAR(2048) NULL ,
  `attribute4` VARCHAR(2048) NULL ,
  `attribute5` VARCHAR(2048) NULL ,
  `last_update_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`feed_id`) ,
  UNIQUE INDEX `feed_id_UNIQUE` (`feed_id` ASC) ,
  UNIQUE INDEX `feed_url_UNIQUE` USING BTREE (`feed_url`(500) ASC) )
ENGINE = MyISAM;

/* Create the Subscription Table */
CREATE  TABLE `frank73_rss`.`subscription` (
  `subscription_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `user_id` BIGINT UNSIGNED NOT NULL ,
  `feed_id` BIGINT UNSIGNED NOT NULL ,
  `attribute1` VARCHAR(2048) NULL ,
  `attribute2` VARCHAR(2048) NULL ,
  `attribute3` VARCHAR(2048) NULL ,
  `attribute4` VARCHAR(2048) NULL ,
  `attribute5` VARCHAR(2048) NULL ,
  `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`subscription_id`) ,
  UNIQUE INDEX `subscription_id_UNIQUE` (`subscription_id` ASC) )
ENGINE = MyISAM;

/* Create Read Message Table */
CREATE  TABLE `frank73_rss`.`read_message` (
  `read_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `msg_id` VARCHAR(3000) NOT NULL ,
  `user_id` BIGINT UNSIGNED NOT NULL ,
  `feed_id` BIGINT UNSIGNED NOT NULL ,
  `attribute1` VARCHAR(2048) NULL ,
  `attribute2` VARCHAR(2048) NULL ,
  `attribute3` VARCHAR(2048) NULL ,
  `attribute4` VARCHAR(2048) NULL ,
  `attribute5` VARCHAR(2048) NULL ,
  `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  PRIMARY KEY (`read_id`) ,
  UNIQUE INDEX `read_id_UNIQUE` (`read_id` ASC) ,
  INDEX `user_msg` USING BTREE (`user_id` ASC, `msg_id`(500) ASC) )
ENGINE = InnoDB;