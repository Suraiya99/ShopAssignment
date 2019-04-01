<?php # PROCESS LOGIN ATTEMPT.

# Checking sumbitted form .
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Opening database connection.
  require ( 'connect_db.php' ) ;

  #Using login_tools page to verify user 
  require ( 'login_tools.php' ) ;

  # Checking login / $check was changed to $chk and $data was changed to $info
  list ( $chk, $info ) = validate ( $dbc, $_POST[ 'mail' ], $_POST[ 'password' ] ) ;

  # If successful, set session and display the logged in page.
  if ( $chk )  
  {
    # Access session.
    session_start();
    $_SESSION[ 'userid' ] = $info[ 'userid' ] ;
    $_SESSION[ 'fname' ] = $info[ 'fname' ] ;
    $_SESSION[ 'lname' ] = $info[ 'lname' ] ;
    $_SESSION[ 'gender' ] = $info[ 'gender' ] ;
    $_SESSION[ 'mail' ] = $info[ 'mail' ] ;
    $_SESSION[ 'country' ] = $info[ 'country' ] ;
    $_SESSION['level'] = $info['level'] ;
    
    load ( 'home.php' ) ;
  }
  # Or if it fails set errors.
  else { $errors = $info; } 

  # Close database connection.
  mysqli_close( $dbc ) ; 
}

# Continue to display login page if there is failure.
include ( 'login.php' ) ;

?>
