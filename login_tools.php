<?php # LOGIN HELPER FUNCTIONS.

# This function loads specified or default URL. $page was changed to $pge
function load( $pge = 'login.php' )
{
  # Begin URL with protocol, domain, and current directory.
  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

  # Remove trailing slashes then append page name to URL.
  $url = rtrim( $url, '/\\' ) ;
  $url .= '/' . $pge ;

  # Execute, redirect then quit. 
  header( "Location: $url" ) ; 
  exit() ;
}

# Function to check email addresses and passwords. 
function validate( $dbc, $mail = '', $password = '')
{
  # Initialize errors array.
  $errors = array() ; 

  # Checking email field.
  if ( empty( $mail ) ) 
  { $errors[] = 'Enter email address.' ; } 
  else  { $mail = mysqli_real_escape_string( $dbc, trim( $mail ) ) ; }

  # Check password field.
  if ( empty( $password ) ) 
  { $errors[] = 'Enter password.' ; } 
  else { $password = mysqli_real_escape_string( $dbc, trim( $password ) ) ; }

  # If successful, retrieve userid, fname, and lname from 'users' database.
  if ( empty( $errors ) ) 
  {
    $query = "SELECT * FROM users WHERE mail='$mail' AND password=SHA1('$password')" ;  
    $registered = mysqli_query ( $dbc, $query ) ;
    if ( @mysqli_num_rows( $registered ) == 1 ) 
    {
      $row = mysqli_fetch_array ( $registered, MYSQLI_ASSOC ) ;
      return array( true, $row ) ; 
    }
    # Or if there is failure set error message.
    else { $errors[] = 'Email address and password can not be found.' ; }
  }
  # if there is failure retrieve error message/s.
  return array( false, $errors ) ; 
}
