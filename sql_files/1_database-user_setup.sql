/* Create the database */
CREATE SCHEMA `frank73_rss` DEFAULT CHARACTER SET latin1;
commit;

/* Run the Below to Create the user, commit, and fulsh privileges */
insert into mysql.user (Host,User,Password)
values ('localhost', 'frank73_rss', PASSWORD('rss2012'));

commit;

flush privileges;


/* Now grant access to frank73_rss database */
grant all on frank73_rss.* to 'frank73_rss'@'localhost';

commit;

flush privileges;