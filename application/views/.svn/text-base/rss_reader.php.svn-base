<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>RSSweb</title>
    <link rel=StyleSheet href="<?php echo base_url() . "resources/style_2.css"; ?>" type="text/css" media="screen, print">
  </head>
  <div id="container">
   
    <!--header is here-->
    <div id="header-bg"></div>
    <div id="header">
        <img class="logo" src="<?php echo base_url() . 'resources/images/logo.gif'; ?>" alt="logo"/>
        <div id="log-pane">
            <h4><?php
  					echo 'Welcome ';
  					if(isset($user_name) && !empty($user_name)) {
  						echo $user_name; 
					}
					else {
						echo 'User';
					}?> </h4>
            <?php echo form_open('users/logout');?>
  				<input type="submit" value="SIGN OUT"/>
  			<?php echo form_close();?>
        </div>
    </div>
    <div id="nav">
        <a id="nav-on" href="<?php echo base_url() . 'index.php/reader'; ?>">Home</a>
        <a id="nav-off" href="<?php echo base_url() . 'index.php/subscriptions'; ?>">Manage Account</a>
    </div>
   
    <!--main content goes here-->
    <div id="main">
         
        <div id=sub-header>
            <!-- headlines go here -->
            <div id="subcriptions-header">
                <p>Headlines</p>
                
                <?php
                	echo "<h3>" . $data_array['single_feed'][0]->feed_title . "</h3>";
                ?>
            </div>
             
            <div id="stories-header">
                <form action="" method="post">
                    <select name="subscribed_feeds">
                    <?php
                    
                 		// List the feeds, using the feed_id as a way to communicate
                 		// which feed is selected
                 		
                        echo "<option>Select Your Feed</option>";
                        foreach ($data_array['all_feeds'] as $row)
                        {
                            echo '<option value=' . $row->feed_id . '>';
                            echo  $row->feed_name;
                            echo '</option>';
                        };
                        
                    ?>   
                    </select>
                     
                    <p>
                       <input type='submit' name='headline_select' value='Go' />
                   </p>
                     
                </form>
            </div>
        </div>
             
        <!-- This is the subscriptions column -->
        <div id="reader-left-column">
             
            <?php

            	// This variable allows the story to be associated
            	// with a position in the data_array
                $story_order = 0;
                 
                foreach ($data_array['single_feed'] as $row)
                {  
                    $story_order++;
                    
                    // If the story is read, generate 'read' indicated html
                    // else generate normal html
                    if ($data_array['read_messages'] != null &&
                    	array_key_exists('\'' . $row->message_link . '\'', $data_array['read_messages']))
                    {
                    	
                    	echo '<br><a href=' . base_url() .
                         'index.php/reader/' . $story_order . '/' . $data_array['feed_position'] .
                    	 '>'. $row->message_title . '</a>' . 
                    	 '<a href="' . $row->message_link . '"target=blank> <img src="' .
                    	 base_url() . 'resources/images/go_to_arrow.gif"></a></br>';
                    }
                    else 
                    {
                    	echo '<br><b><a href=' . base_url() .
                         'index.php/reader/' . $story_order . '/' . $data_array['feed_position'] .
                    	 '>'. $row->message_title . '</a></b>' .
                    	 '<a href="' . $row->message_link . '"target=blank> <img src="' .
                    	 base_url() . 'resources/images/go_to_arrow.gif"></a></br>';
                    }
                                      	  
                };
     
            ?>
             
        </div>
         
        <!-- The individual RSS entry information is in this column -->
        <div id="reader-right-column">
         
            <?php 
                 
                // First, get the position of the story the 
                // user clicks on in the list
                $story_position = $data_array['story_position'];
             
                 
                // If this is the first time the page is being generated 
                // in a session
                if ($story_position == 'index')
                {  
                    echo "<h2><p>   Select an article from the list on the left </p></h2>";
                }
                else
                {
                    $single_item = $data_array['single_feed'][$story_position - 1];
                    
                    echo "<h4>" . $single_item->message_title . "</h4>";
                    echo "<br></br>";
                    echo $single_item->message_detail;
                    echo "<br></br>";
                    echo "<a href=\"" . $single_item->message_link . "\" target=\"_blank\" >Link to Story</a>";
                }            
                 
            ?>
         
        </div>
    </div>
     
   <!--footer if we decide to have one-->
    <footer>
         
    </footer>
     
  </div>
   
  </body>
</html>
