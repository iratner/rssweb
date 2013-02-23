/* Registered Users Sample Data */
INSERT INTO `frank73_rss`.`registered_users` (`email`, `password`) VALUES ('user@gmail.com', 'password');
INSERT INTO `frank73_rss`.`registered_users` (`email`, `password`) VALUES ('adama@gmail.com', 'password');
INSERT INTO `frank73_rss`.`registered_users` (`email`, `password`) VALUES ('starbuck@gmail.com', 'password');
INSERT INTO `frank73_rss`.`registered_users` (`email`, `password`) VALUES ('apollo@gmail.com', 'password');
INSERT INTO `frank73_rss`.`registered_users` (`email`, `password`) VALUES ('sharon@gmail.com', 'password');
/* Feed Sample Data */
INSERT INTO `frank73_rss`.`rss_feed` (`feed_name`, `feed_url`, `link`, `title`, `description`, `recommended`, `enabled`, `last_build_date`, `pub_date`, `image_url`, `language`, `copyright`, `ttl`) VALUES ('CNN Top Stories', 'http://rss.cnn.com/rss/cnn_topstories.rss', 'http://www.cnn.com/?eref=rss_topstories', 'CNN.com', 'CNN.com delivers up-to-the-minute news and information on the latest top stories, weather, entertainment, politics and more.', 1, 1, '2012-02-05 10:51:55', '2012-02-05 10:51:55', 'http://i2.cdn.turner.com/cnn/.element/img/1.0/logo/cnn.logo.rss.gif', 'en-us', '� 2012 Cable News Network LP, LLLP.', 5);
INSERT INTO `frank73_rss`.`rss_feed` (`feed_name`, `feed_url`, `link`, `title`, `description`, `recommended`, `enabled`, `last_build_date`, `image_url`, `language`, `copyright`, `ttl`) VALUES ('BBC US & Canada', 'http://feeds.bbci.co.uk/news/world/us_and_canada/rss.xml', 'http://www.bbc.co.uk/go/rss/int/news/-/news/world/us_and_canada/', 'BBC News - US &amp; Canada', 'The latest stories from the US &amp; Canada section of the BBC News web site.', 1, 1, '2012-02-05 15:22:23', 'http://news.bbcimg.co.uk/nol/shared/img/bbc_news_120x60.gif', 'en-gb', 'Copyright: (C) British Broadcasting Corporation, see http://news.bbc.co.uk/2/hi/help/rss/4498287.stm for terms and conditions of reuse.', 15);
INSERT INTO `frank73_rss`.`rss_feed` (`feed_name`, `feed_url`, `link`, `title`, `description`, `recommended`, `enabled`, `last_build_date`, `language`, `copyright`) VALUES ('Ars Technica', 'http://feeds.arstechnica.com/arstechnica/index?format=xml', 'http://arstechnica.com/index.php', 'Ars Technica', 'The Art of Technology', 1, 1, '2012-02-05 16:38:42', 'en', 'Copyright 2012 Conde Nast Digital. The contents of this feed are available for non-commercial use only.');
INSERT INTO `frank73_rss`.`rss_feed` (`feed_name`, `feed_url`, `link`, `title`, `description`, `recommended`, `enabled`, `last_build_date`, `language`, `copyright`) VALUES ('Slashdot', 'http://rss.slashdot.org/Slashdot/slashdot', 'http://slashdot.org/', 'Slashdot', 'News for nerds, stuff that matters', 1, 1, '2012-02-05 17:32:24', 'en-us', 'Copyright 1997-2012, Geeknet, Inc.  All Rights Reserved.');
INSERT INTO `frank73_rss`.`rss_feed` (`feed_name`, `feed_url`, `link`, `title`, `description`, `recommended`, `enabled`, `last_build_date`, `language`, `copyright`) VALUES ('SyFy', 'http://blastr.com/rss.xml', 'http://blastr.com/', 'Blastr', 'Get news, articles, reviews and the latest from Blastr, the newly expanded information hub for the Syfy Channel.', 0, 1, '2012-02-04 14:00:00', 'en', 'Copyright 2012');
INSERT INTO `frank73_rss`.`rss_feed` (`feed_name`, `feed_url`, `link`, `title`, `description`, `recommended`, `enabled`, `last_build_date`, `language`, `copyright`) VALUES ('Daring Fireball', 'http://daringfireball.net/index.xml', 'http://daringfireball.net/', 'Daring Fireball', 'Mac and web curmudgeonry/nerdery. By John Gruber.', 0, 1, '2012-02-04 22:25:01', 'en', 'Copyright © 2012, John Gruber');
/* Subscription Sample Data */
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (1, 1);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (1, 2);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (1, 3);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (1, 4);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (1, 5);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (1, 6);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (2, 2);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (2, 4);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (2, 6);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (3, 1);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (3, 3);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (3, 5);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (4, 6);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (5, 1);
INSERT INTO `frank73_rss`.`subscription` (`user_id`, `feed_id`) VALUES (5, 3);
/* Read Messages Sample Data */
INSERT INTO `frank73_rss`.`read_message` (`msg_id`, `user_id`, `feed_id`) VALUES ('http://www.cnn.com/2012/02/04/politics/gop-nevada-caucuses/index.html?eref=rss_topstories', 1, 1);
INSERT INTO `frank73_rss`.`read_message` (`msg_id`, `user_id`, `feed_id`) VALUES ('http://www.cnn.com/2012/02/05/world/meast/syria-unrest/index.html?eref=rss_topstories', 1, 1);
INSERT INTO `frank73_rss`.`read_message` (`msg_id`, `user_id`, `feed_id`) VALUES ('http://www.cnn.com/2012/02/05/world/meast/syria-china-russia-relations/index.html?eref=rss_topstories', 1, 1);
