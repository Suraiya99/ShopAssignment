<?php # CONNECT TO MySQL DATABASE.

# Login for databse access and connection.
$dbc = mysqli_connect ( 'localhost', 'root', 'root', 'site_db' )

# If there is an error. 
OR die ( mysqli_connect_error() ) ;

#query for sql from database.
$query = "SELECT * FROM shop WHERE productid = $productid";

# Set encoding to match PHP script encoding.
mysqli_set_charset( $dbc, 'utf8' ) ;

?>
