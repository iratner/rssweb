/**
 * Javascript file for Client-Side Validation's on the Registration Form.
 * @author Ilya
 */

/**
 * This method is a convenience method for getting an element.
 * @param $id the id of the element.
 * @return an element with the given id 
 */
function $($id) {
	return document.getElementById($id);
}

/**
 * trims white space from both ends of a string.
 * @param str the string to trim
 * @return the trimmed string.
 */
function trim(str)
{
     return str.replace (/^\s+|\s+$/g, ' ');
}

/**
 * Validates the registration input.
 */
function validate()
{
	// Get the form using it's id
	var f = $('regform');
	// get the values for each field.
	var email = $('usr-id').value;
	var pswd = $('password').value;
	var pswd_confirm = $('password-confirm').value;
	var error_msg = '';
	
	// regular expression for checking for most valid email addresses
	var reg_ex =/^[a-zA-Z0-9._\+-]+@[a-zA-Z0-9]+([.-]?[a-zA-Z0-9]+)?([\.]{1}[a-zA-Z]{2,4}){1,4}$/;
	var valid = true;
	// Is email valid?
	if (!reg_ex.test(email)) {
		error_msg += "Invalid Email. ";
		valid = false;
	}
	// Is password empty?
	if (pswd == '' || pswd == null) {
		error_msg += "Enter a Password.";
		valid = false;
	}
	
	// Does password and confirmed password match?
	if (!check_password_match(pswd, pswd_confirm) && (pswd != '' && pswd != null)) {
		error_msg += "Password and Confirm Password Do Not Match.";
		valid = false;
	}
	
	//  If anything went wrong set error message.
	if (!valid) {
		$('error').innerHTML = error_msg;
	}
	// otherwise submit the form.
	else {
		f.submit();
	}
}

/**
 * Password validation on the Account Management page.
 */
function check_password() {
	
	var f = $('pass_change');
	var old_pass = $('old_password').value;
	var pass = $('new_password').value;
	var confirm = $('confirm_password').value;
	var msg = '';
	
	if (check_password_match(pass, confirm)) {
		
		if (pass == "" || pass == null || old_pass == null || old_pass == "") {
			msg = "Password fields cannot be blank!";
		}
		else {
			f.submit();
		}
	}
	else {
		msg = "Passwords don't match!";
	}
	
	$('pass_error').innerHTML = msg;
}

/**
 * Checks to see if given variables are identical.
 * @param pswd a String.
 * @param confirm another String.
 * @returns {Boolean} true if Strings match, and false otherwise.
 */
function check_password_match(pswd, confirm) {
	
	if (pswd == confirm) {
		return true;
	}
	else {
		return false;
	}
}

/**
 * Validates feed addition field on feed management page.  Prevents empty
 * field from being submitted.  Could probably use a regex to check for
 * valid urls, as well.
 */
function check_empty()
{
	var f = $('feed_adder');
	var new_feed = $('new-feed-txt').value;
	if (!(new_feed == '' || new_feed == null))
		f.submit();
	
}

/**
 * Disables ability to push Enter to submit a form.
 * @param e the key that was pressed while inside of a text field.
 * @returns {Boolean} true if key wasn't enter key, and false otherwise.
 */
function disableEnterKey(e)
{
     var key;      
     if(window.event)
          key = window.event.keyCode; //IE
     else
          key = e.which; //firefox      
     
     return (key != 13);
}

function closeOverlay()
{
	document.getElementById('no-subs').style.visibility="hidden";
	document.getElementById('no-subs-text').style.visibility="hidden";
}