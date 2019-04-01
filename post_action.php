<?php # PROCESS MESSAGE POST.

# Access session.
session_start();

# Make load function available.
require ( 'login_tools.php' ) ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userid' ] ) ) { load() ; }
if (isset($_SESSION['fname'] ) ) { $fname = $_SESSION['fname'];}
if (isset($_SESSION['lname'] ) ) { $lname = $_SESSION['lname'];}



# Set page title and display header section.
$page_title = 'Post Error' ;
include ( 'includes/header.html' ) ;

# Check form submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  # Check Subject and Message Input.
  if ( empty($_POST['subject'] ) ) { echo '<p>Please enter a subject for this post.</p>'; }
  if ( empty($_POST['message'] ) ) { echo '<p>Please enter a message for this post.</p>'; }

  # On success add post to forum database.
  if( !empty($_POST['subject']) &&  !empty($_POST['message']) )
  {
    # Open database connection.
    require ( 'connect_db.php' ) ;
    
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
    
  
    # Execute inserting into 'forum' database table.
    $query = "INSERT INTO forum(fname,lname,subject,message,dateofpost) 
          VALUES ('$fname','$lname','$subject]}','$message',NOW() )";
    $registered = mysqli_query ( $dbc, $query ) ;

    # Report error on failure.
    if (mysqli_affected_rows($dbc) != 1) { echo '<p>Error</p>'.mysqli_error($dbc); } else { load('forum.php'); }
    
    # Close database connection.
    mysqli_close( $dbc ) ; 
    }
 } 
 
# Create a hyperlink back to the forum page.
echo '<p><a href="forum.php">Forum</a>' ;
 
# Display footer section.
include ( 'includes/footer.html' ) ;

?>
