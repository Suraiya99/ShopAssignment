<?php # DISPLAY COMPLETE LOGIN PAGE.

# Set page title and display header section.
$page_title = 'Login' ;
include ( 'includes/header.html' ) ;

# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Error:<br>' ;
 foreach ( $errors as $message ) { echo " - $message<br>" ; }
 echo 'Please try again or <a href="register.php">Register</a></p>' ;
}
?>

<!-- Display body section. -->
<h1>Login</h1>
<form action="login_action.php" method="post">
<p>Email Address: <input type="text" name="mail"> </p>
<p>Password: <input type="password" name="password"></p>
<p><input type="submit" value="Login" ></p>
</form>

<?php 

# Display footer section.
include ( 'includes/footer.html' ) ; 

?>
