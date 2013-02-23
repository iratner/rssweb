<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>RSSweb</title>
		<link rel=StyleSheet href="<?php echo base_url() . "resources/style_2.css";?>" type="text/css" media="screen, print">
		<link href='http://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="<?php echo base_url() . 'resources/js/validate.js';?>"></script>
	</head>
	<body OnKeyPress="return disableEnterKey(event)">
		<div id="container">
			<!--header is here-->
			<div id="header-bg"></div>
			<div id="header">
				<img class="logo" src="<?php echo base_url() . 'resources/images/logo.gif';?>" alt="logo"/>
				<div id="log-pane">
					<h4><?php
					echo 'Welcome ';
					if (isset($user_name) && !empty($user_name)) {
						echo $user_name;
					} else {
						echo 'User';
					}
					?></h4>
					<?php echo form_open('users/logout');?>
					<input type="submit" value="SIGN OUT"/>
					<?php echo form_close();?>
				</div>
			</div>
			<div id="nav">
				<?php echo form_open('subscriptions/go_home');?>
				<input type="submit" id="nav-off-input" class="nav-form" value="Home"/>
				<?php echo form_close();?>
				<a href="<?php echo base_url() . 'index.php/subscriptions';?>" id="nav-on">Manage Account</a>
			</div>
			
			<!--main content goes here-->
			<div id="main">
				<h3 class="man-title">Subscriptions</h3>
				<div class="line"></div>
				<div id="reg-main">
					
					<div id="feed_man_left">
						<label class="blue-label">Recommended Feeds:</label>
						<label id="r-label">Add</label>
						<div class="remove-feed" id="rec-feed">
							<!-- recommended feedsa are loaded here -->
							<table>
								<?php
								$size = count($rec_feeds);

								if ($size == 0) {
									echo '<tr><td class="feed-rem-white"><h2>No Recommendations</h2></td></tr>';
								} else {
									for ($i = 0; $i < $size; $i++) {

										$title = $rec_feeds[$i] -> title;
										$feed_url = $rec_feeds[$i] -> feed_url;

										if ($i == 0 || $i % 2 == 0)
											echo '<tr class="feed-rem-white">';
										else
											echo '<tr class="feed-rem-gray">';

										echo form_open('subscriptions/add_rec_feed');
										echo '<td class="feed-title-long"><h4>' . $title . '</h4></td>';
										echo '<input type="hidden" name="rec_feed" value="' . $feed_url . '"/>';
										echo '<td><input value="+" type="submit" class="close_btn add_btn" /></td>';

										echo form_close();
										echo '</tr>';
									}
								}
								?>
							</table>
						</div>
					</div>
					<div id="feed_man_right">
						<!-- error messages go here -->
						<div class="error" id="error">
							&nbsp; <?php
							if (isset($invalid_feed) && !empty($invalid_feed))
								echo $invalid_feed;
							?>
						</div>
						<div id="feed-man">
							
							<!-- Adding a feed mark-up here -->
							<div id="add-feed">
								<?php echo form_open('subscriptions/add_feed', array('id' => 'feed_adder'));?>
								<label for="feed-to-add" class="blue-label">Add a feed:</label>
								<input type="text" name="feed-to-add" id="new-feed-txt" onkeypress="return disableEnterKey(event)"/>
								<h2 id="feed-submit" onclick="check_empty()">+</h2>
								<?php echo form_close();?>
							</div>
							<label class="blue-label">Your Subscriptions:</label>
							<label id="r-label-2">Remove</label>
							
							<!-- Removing feeds mark-up here -->
							<div class="remove-feed" name="remove-feed">
								<table>
									<?php
									$size = count($user_feeds);

									if ($size == 0) {
										echo '<tr><td rowspan="5" class="feed-rem-white"><h2>No Subscriptions</h2></td></tr>';
									} else {
										for ($i = 0; $i < $size; $i++) {

											$title = $user_feeds[$i] -> title;
											$feed_id = $user_feeds[$i] -> feed_id;
											$link = $user_feeds[$i] -> link;

											if ($i == 0 || $i % 2 == 0)
												echo '<tr class="feed-rem-white">';
											else
												echo '<tr class="feed-rem-gray">';

											echo form_open('subscriptions/remove_feed');
											echo '<td class="feed-title"><h4>' . $title . '</h4></td>';
											echo '<td class="feed_link"><h5>' . $link . '</h5></td>';
											echo '<input type="hidden" name="feed_id" value="' . $feed_id . '"/>';
											echo '<td><input value="X" type="submit" class="close_btn" /></td>';

											echo form_close();
											echo '</tr>';
										}
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
				<h3 class="man-title">Settings</h3>
				<div class="line"></div>
				<div class="error" id="pass_error">&nbsp;
			  		<?php if (isset($valid_pass) && !empty($valid_pass) && $valid_pass !== TRUE)
								echo $valid_pass;
						  else if ($pass_changed == TRUE)
						  		echo "<span id='pass-changed'>Password Has Been Changed</span>";?>
				</div>
				<!-- This is the password change div -->
				<div id="settings">
					<label class="blue-label">Password Change</label>
					<?php echo form_open('subscriptions/change_password', array('id' => 'pass_change'));?>
					<label class="pass-label"> current password:</label><br><input type="password" name="old_password" id="old_password"><br>
					<label class="pass-label"> new password:</label><br><input type="password" name="new_password" id="new_password"><br>
					<label class="pass-label"> confirm new password:</label><br><input type="password" name="confirm_password" id="confirm_password"><br>
					<input type="button" onclick="check_password()" value="Change Password">
					<?php echo form_close();?>
				</div>
			</div>
		</div>
		<!-- Overlay appears after successful registration -->
  	<?php if($has_feeds == FALSE) { ?>
		  	
		<div id="no-subs" class="overlay"></div>  
		<div id="no-subs-text" class="message-box">
			<p id="hide_btn" onclick="closeOverlay()">X</p><br>
			<p id="no-subs-msg">You are not subscribed to any feeds.  Please add a subscription to your account.</p>
		</div>	
		  	
	<?php }	 ?>
	</body>
</html>