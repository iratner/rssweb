/* Login as root or a user with SUPER privileges */
/* Turn on the event scheduler */
SET GLOBAL event_scheduler = 'ON';

/* Check to make sure scheduler is on */
SHOW variables WHERE Variable_name = 'event_scheduler';

    /* If Logged in as Root you can also see that the scheduler process is running */
    SHOW processlist;

/* !! Log in as frank73_rss user !! */
/* Create the Event to Prune the rss_message table */
CREATE 
    DEFINER = `frank73_rss`@`localhost`
    EVENT `frank73_rss`.`message_archive_prune`
    ON SCHEDULE EVERY 10 DAY
        STARTS CURRENT_TIMESTAMP
        ENDS CURRENT_TIMESTAMP + INTERVAL 1 YEAR
    ON COMPLETION PRESERVE
    COMMENT 'Prunes the RSS Messages Table to Messages in the last 90 Days.'
    DO
        DELETE FROM `frank73_rss`.`rss_message`
        WHERE create_date < (CURRENT_TIMESTAMP - INTERVAL 90 DAY);

/* Create the Event to Prune the read_message table */
CREATE
    DEFINER = `frank73_rss`@`localhost`
    EVENT `frank73_rss`.`read_data_prune`
    ON SCHEDULE EVERY 10 DAY
        STARTS CURRENT_TIMESTAMP
        ENDS CURRENT_TIMESTAMP + INTERVAL 1 YEAR
    ON COMPLETION PRESERVE
    COMMENT 'Prunes the Read Messages Table to Read data created in the last 90 Days.'
    DO
        DELETE FROM `frank73_rss`.`read_message`
        WHERE create_date < (CURRENT_TIMESTAMP - INTERVAL 90 DAY);

/* Commit Transactions */
commit;

/* Check to see that events were created correctly */
SHOW EVENTS;