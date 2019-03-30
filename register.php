<?php # DISPLAY COMPLETE REGISTRATION PAGE.

# Set page title and display header section.
$page_title = 'Register' ;
include ( 'includes/header.html' ) ;

# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for a first name.
  if ( empty( $_POST[ 'fname' ] ) )
  { $errors[] = 'Enter first name.' ; }
  else
  { $fname = mysqli_real_escape_string( $dbc, trim( $_POST[ 'fname' ] ) ) ; }

  # Check for a last name.
  if (empty( $_POST[ 'lname' ] ) )
  { $errors[] = 'Enter last name.' ; }
  else
  { $lname = mysqli_real_escape_string( $dbc, trim( $_POST[ 'last_name' ] ) ) ; }

  # Check for an email address:
  if ( empty( $_POST[ 'mail' ] ) )
  { $errors[] = 'Enter email address.'; }
  else
  { $mail = mysqli_real_escape_string( $dbc, trim( $_POST[ 'mail' ] ) ) ; }

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'password1' ] ) )
  {
    if ( $_POST[ 'password1' ] != $_POST[ 'password2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $password = mysqli_real_escape_string( $dbc, trim( $_POST[ 'password1' ] ) ) ; }
  }
  else { $errors[] = 'Enter password.' ; }
  
 # Check for entry of a gender.
  if ( empty($_POST[ 'gender' ] ) )
  { $errors[] = 'Enter gender.' ; }
    else
   { $gender = mysqli_real_escape_string( $dbc, trim( $_POST[ 'gender' ] ) ) ; }
 
  # Check for entry of a country
  if (empty($_POST['country'] ) )
  { $errors[] = 'Enter country.' ; }
  else 
  { $country = mysqli_real_escape_string( $dbc, trim( $_POST['country'] ) ) ; }
        
  # Check if email address is already registered.
  if ( empty( $errors ) )
  {
    $query = "SELECT userid FROM users WHERE mail='$mail'" ;
    $registered = @mysqli_query ( $dbc, $query ) ;
    if ( mysqli_num_rows( $registered ) != 0 ) $errors[] = 'Email address is already registered. <a href="login.php">Login</a>' ;
  }
  
  # If successful register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $query = "INSERT INTO users (fname, lname, mail, password, dateofreg, gender, country ) VALUES ('$fname', '$lname', '$mail', '$country', '$gender' SHA1('$password'), NOW() )";
    $registered = @mysqli_query ( $dbc, $query ) ;
    if ($registered)
    { echo '<h1>Registered!</h1><div class="form-group">You are now registered.</div><div class="form-group"><a href="login.php">Login</a></div>'; }
  
    # Close database connection.
    mysqli_close($dbc); 

    # Display footer section and quit script:
    include ('includes/footer.html'); 
    exit();
  }
  # Or report errors.
  else 
  {
    echo '<h1>Error</h1><p id="err_msg">The following error(s) occurred:<br>' ;
    foreach ( $errors as $message )
    { echo " - $message<br>" ; }
    echo 'Try again.</p>';
    # Close database connection.
    mysqli_close( $dbc );
  }  
}
?>
<html>
	<head>
		<title>LeMode : Register</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>		

<body>

<!-- Display body section with sticky form. -->

<h1>Register</h1>
		<div class="container">
		<div class="row">
		<div class="col">

	<form action="register.php" method="post">

	<div class="form-group">
	
	<p>First Name:
	<input type="text" name="fname" placeholder="First Name" class="form-control" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>"> </p>
</div>
	
<div class="form-group">
		<p>Last Name:
		<input type="text" name="lname" placeholder="Enter last name" class="form-control" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>"> </p>
	</div>

<div class="form-group">
	<p>Email Address:
		<input type="email" name="mail" class="form-control" placeholder="Enter email address" value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>"> </p>
	</div>	
	
<div class="form-group">
<p>Gender:
	<input type="text" name="gender" placeholder="Enter gender" class="form-control form-control-sm" value="<?php if (isset($_POST['gender'])) echo $_POST['gender']; ?>"> </p>
 </div>
 

<div class="form-group">
<p>Country
 	<input type="text" name="country" placeholder="Enter country" class="form-control form-control-sm" value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>"> </p>
 </div>
 
<div class="form-group">
	<p>Password:
	<input type="password" name="password1" class="form-control" value="<?php if (isset($_POST['password1'])) echo $_POST['password1']; ?>"> </p>
</div>

<div class="form-group">
	<p>Confrim Password:
	<input type="password" name="password2" class="form-control" value="<?php if (isset($_POST['password2'])) echo $_POST['password2']; ?>"> </p>
</div>

<div class="form-group">
	<input type="submit" value="Register" class="btn btn-outline-warning">
</div>

</form>
</div>
<div class="col"></div>
</div>
</div>

</body>

<script src="bootstrap/js/bootstrap.min.js"></script>
</html>
<?php 

#Display footer section
include ( 'includes/footer.html' ) ; 




?>	
	
	
	
 
 
 
