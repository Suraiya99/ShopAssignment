<?php #DISPLAY SHOPPING CART PAGE

#Accessing Session.
session_start();

#Redirect if not logged in.
if (!isset($_SESSION['userid'])) {require ('login_tools.php') ;
load() ; }


#Set page title and display header section.
$page_title = 'Cart';
include ( 'includes/header.html') ;

    #Check if form has been submitted for update.
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    
                        {
                            
                            
 #Update changed quality field values.
 foreach ($_POST['qty'] as $productid => $amt)
 
                        {
                            
                            
 #Ensure values are integers 
 $id = (int) $productid;
 $qty = (int) $amt;
 
 #Change quantity or delete if zero.
 if ($qty == 0) { unset ($_SESSION['cart'] [$id]); }
 elseif ( $qty > 0 ) { $_SESSION['cart'][$id]['quantity'] = $qty; }
 
                         }
                        
                        
                        }
                        
  # Initialize grand total variable.
 $final = 0; 
 
 #Display cart if not empty
 
 if (!empty($_SESSION['cart']))
 {
     # Connect to the database.
     require ('connect_db.php');
     
     # Retrieve all items in the cart from the 'shop' database table.
     $query = "SELECT * FROM shop WHERE productid IN (";
     foreach ($_SESSION['cart'] as $id => $value) { $query .= $id . ','; }
     $query = substr( $query, 0, -1 ) . ') ORDER BY productid ASC';
     $registered = mysqli_query ($dbc, $query);
     


#Display body section with form and table

   echo ' <form action="cart.php" method="post">
  <div class=\'container\'><div class=\'row\'><div class=\'col\'>Items in your cart</div></div>';
 while ($row = mysqli_fetch_array ($registered, MYSQLI_ASSOC))
 
                       {

  
  # Calculate sub-totals and grand total.
  $subtotal = $_SESSION['cart'][$row['productid']]['quantity'] * $_SESSION['cart'][$row['productid']]['price'];
  $final += $subtotal;

 #Display row/s: 

 echo "<div class='row'> <div class='col'>{$row['pname']}</div>
<div class='col'><input type=\"text\" size=\"3\" name=\"qty[{$row['productid']}]\"
value=\"{$_SESSION['cart'][$row['productid']]['quantity']}\"></div>
<div class='col'>@ {row['price']} = </div> <div class='col'>".number_format($subtotal, 2)."</div></div>";
                
                       }

   #Close database connection.
   mysqli_close($dbc);
   
   #Display total.
   
echo ' <div class=\'row\'><td colspan="5" style="text-align:right">
Total = ' .number_format($final, 2). ' 
</div></div></div><input type="submit" 
name="submit" value="Update My Cart"></form>';
   
                     }
                     
       else 
           
      #Or display a message.
       { echo  '<p>Your cart is currently empty.</p>' ; }
       
       #Create navigation links.
       
  echo '<p><a href="shop.php">Shop</a> |
<a href="checkout.php?total='.$final.'">Checkout</a>|
<a href="forum.php">Forum</a> |
<a href="home.php">Home</a> |
<a href="goodbye.php">Logout</a></p>';
  
  
 #Display footer section.
 
  include ( 'includes/footer.html') ;
  
                ?>
                       
                       
