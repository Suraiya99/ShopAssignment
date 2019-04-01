<?php # DISPLAY COMPLETE LOGGED IN PAGE.

# Access session.
session_start() ; 

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userid' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Home' ;
include ( 'includes/header.html' ) ;

# Display body section.
echo "<h1>HOME</h1><p>You are now logged in, {$_SESSION['fname']} {$_SESSION['lname']} : {$_SESSION['mail']} <br/> 

        <h2> Welcome to Le Mode </h2>.</p>


<p>
Le Mode is a Vintage Clothing shop site that provides great vintage 
finds which have been well maintained and loved. Le Mode strives to provide customers with the best quality of Vintage finds 
that have been sourced from other vintage shops under lawful and appropriate conditions. 
Behind Le Mode, is a team of professional and certified individuals 
in authenticating items before they are sold 
and continue to create stories with their new owners.</p>";


# Create navigation links.
echo '<p><a href="forum.php">Forum</a> | <a href="shop.php">Shop</a> | <a href="goodbye.php">Logout</a> |
<a href="cart.php"View Cart</a> | 
<a href="home.php">Home</a></p>';


# Display footer section.
include ( 'includes/footer.html' ) ;
?>
