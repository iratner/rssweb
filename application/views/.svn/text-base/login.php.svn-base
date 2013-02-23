<!DOCTYPE html>
<html lang="en">
  <head>
    <title>RSSweb</title>
    <link rel=StyleSheet href="<?php echo base_url() . 'resources/style_2.css'; ?>" type="text/css" media="screen, print">
        <link href='http://fonts.googleapis.com/css?family=Electrolize' rel='stylesheet' type='text/css'>

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
  		<?php if (isset($error) && !empty($error))
					echo "<div class='error'>" . $error . "</div>";
						?>
  		<div id="login-form" class="form">
  			
  			<?php echo form_open('welcome/processLogin'); ?>
  				<h2>Login</h2>
  				<div class="login-form-left">
  					<p>e-mail:</p>
  					<input tabindex="1" type="text" name="login"/><br>
  					<input type="checkbox" name="remember" value='T'/>
  					<h5 class="no-br">remember me</h5>
  				</div>
  				<div class="login-form-right">
  					<p>password:</p>
  					<input tabindex="2" type="password" name="password"/><br>
  					<input type="submit" value="Login" id="login-btn"/>
  				</div>
  			<?php echo form_close(); ?>
  			<div id="register">
  				<h3>OR</h3>
  				<a href="<?php echo base_url() . 'index.php/users/register'; ?>">New Users Register Here</a>
  			</div>
  		</div>
  		
  	</div>
  	
   <!--footer if we decide to have one-->
  	<footer>
  		
  	</footer>
  </div>
  </body>
</html>