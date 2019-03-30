<?php # DISPLAYING CHECKOUT PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userid' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Checkout' ;
include ( 'includes/header.html' ) ;

# Check for passed total and cart.
if ( isset( $_GET['final'] ) && ( $_GET['final'] > 0 ) && (!empty($_SESSION['cart']) ) )
{
  # Open database connection.
  require ('connect_db.php');
  
  # Store buyer and order total in 'orders' database table.
  $query = "INSERT INTO orders ( userid, final, dateoforder ) VALUES (". $_SESSION['userid'].",".$_GET['final'].", NOW() ) ";
  $registered = mysqli_query ($dbc, $query);
  
  # Retrieve current order number.
  $orderid = mysqli_insert_id($dbc) ;
  
  # Retrieve cart items from 'shop' database table.
  $query = "SELECT * FROM shop WHERE productid IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $query .= $id . ','; }
  $query = substr( $query, 0, -1 ) . ') ORDER BY item_id ASC';
  $registered = mysqli_query ($dbc, $query);

  # Store order contents in 'order_contents' database table.
  while ($row = mysqli_fetch_array ($registered, MYSQLI_ASSOC))
  {
    $query = "INSERT INTO order_contents ( orderid, productid, amt, price )
    VALUES ( $orderid, ".$row['productidid'].",".$_SESSION['cart'][$row['productid']]['amt'].",".$_SESSION['cart'][$row['productid']]['price'].")" ;
    $registered = mysqli_query($dbc,$query);
  }
  
  # Close database connection.
  mysqli_close($dbc);

  # Display order number.
  echo "<p>Thank you for your order! Your Order Number Is #".$orderid."</p>";

  # Remove cart items.  
  $_SESSION['cart'] = NULL ;
}
# Or display a message.
else { echo '<p>There are no items in your cart.</p>' ; }

# Create navigation links.
echo '<p><a href="shop.php">Shop</a> | <a href="cart.php">View Cart</a> | <a href="forum.php">Forum</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>'; ;

# Display footer section.
include ( 'includes/footer.html' ) ;

?>
