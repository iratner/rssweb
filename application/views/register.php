<!DOCTYPE html "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>RSSweb</title>
    <link rel=StyleSheet href="<?php echo base_url() . "resources/style_2.css"; ?>" type="text/css" media="screen, print">
  	<link href='http://fonts.googleapis.com/css?family=Electrolize' rel='stylesheet' type='text/css'>
  	<script type="text/javascript" src="<?php echo base_url(). 'resources/js/validate.js'; ?>"></script>

  </head>
  <body>
  <div id="container">
  	<!--header is here-->
  	<div id="header-bg"></div>
  	<div id="header">
  		<img class="logo" src="<?php echo base_url() . 'resources/images/logo.gif'; ?>" alt="logo"/>
  	</div>
  	
  	<!--main content goes here-->
  	<div id="main">
  		<div class="error" id="error">&nbsp;
  		<?php if (isset($error) && !empty($error))
					echo $error;?>
		</div>
  		<div id="register-form" class="form">
  	
  			
  			<?php echo form_open('users/addUser', array('id'=>'regform')); ?>
  				<h2>Register</h2>
  				
  				<!-- Left input pane -->
  				<div id="reg-form-left">
  					<p>e-mail:</p>
  					<input type="text" size="25px" name="usr-id" id="usr-id"/><br>
  					<p>password:</p>
  					<input type="password" size="25px" name="password" id="password"/><br>
  					<p>confirm password:</p>
  					<input type="password" size="25px" name="password-confirm" id="password-confirm"/><br>
  					
  					<!-- Instead of using a type="submit" I used a button.  This prevents
  						the form from submitting instantly.  You can probably add an event
  						function like onchange="function()", and call submit inside the
  						function.  That might work, not sure, though. -->
  					<input type="button" value="Register" id="reg-btn" onclick="validate();">
  				</div>
  				
  				<!-- Right pane with recommendations -->
  				<div id="reg-form-right">
  					<fieldset>
  						<legend>Recommended Feeds</legend>
  						<?php
  							if (isset($recommended) && !empty($recommended)) 
								foreach($recommended as $row)
								{
									echo '<input name="feeds[]" type="checkbox" value="' 
										. $row->feed_id .'" id="feed-' . $row->feed_id 
										. '"/><label for="'
										. 'feed-' . $row->feed_id . '">' . $row->feed_name . '</label><br>';
								}  								

						?>			
  					</fieldset>
  				</div>
  				
  			<?php echo form_close(); ?>
  			
  		</div>
  		
  	</div>
  	
  	<!-- Overlay appears after successful registration -->
  	<?php if($registered == TRUE) { ?>
		  	
		<div class="overlay"></div>  
		<div class="message-box">
				
				<?php echo form_open('users');?>
					<h3>Thank You for Registering!</h3>
			
					<a href="<?php echo base_url() . 'index.php/users'; ?>">Go to Login Page</a>

				<?php echo form_close(); ?>
		</div>	
		  	
	<?php }	 ?>
  	
   <!--footer if we decide to have one-->
  	<footer>
  		
  	</footer>
  </div>
  </body>
</html>