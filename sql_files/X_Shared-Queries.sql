/*
I started putting together some simple queries for use in the model, so I thought I 
would make them available in a format that can easily be copy and pasted into 
a sql editor to create custom queries. 

Feel free to add to this!
*/

# Select all the feeds for a user based on their user ID
select * from rss_feed inner join subscription on rss_feed.feed_id = subscription.feed_id 
    			and subscription.user_id=3;
                
# Basic select statement
select * from subscription;

# Get the feed url based on the feed id
select * from rss_feed where feed_id=1;

# Select the first feed for an individual user
select rss_feed.feed_id from rss_feed inner join subscription on rss_feed.feed_id = subscription.feed_id 
    			and subscription.user_id=3 limit 1;

