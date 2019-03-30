<?php

#Accessing session
session_start() ;

#Redirect if not logged in
if (!isset($_SESSION['userid'] ) ) {require ('login_tools.php') ; load(); }


#Setting page title and header 
$page_title ='Details' ;
include ('includes/header.html');




  //Capturing parameter 

if(isset($_REQUEST["id"])){

//saving parameter as variable
$productid = $_REQUEST["id"];

require ('connect_db.php');




//login to database (when ready to submit enter jose.stca.herts.ac.uk", "sa18aft", "3MP7FVi8", "dbsa18aft

$db = mysqli_connect('localhost', 'root', 'root', 'site_db')
OR die (mysqli_connect_error());

//sql statement with data wanted
$sql = "SELECT * FROM shop WHERE productid=$productid";

//Query to execute sql on db

$query = mysqli_query($db, $sql);



//If statement if data is found

        if($query){
    
        echo '<ul>';
        
        
  //loop for each record in database ($r for record was changed to $registered 
  
        while($registered = mysqli_fetch_array($query, MYSQLI_ASSOC)){
            
            
            
    //Variables for fields
    
            
            $productid = $registered['productid'];
            $pname = $registered['pname'];
            $pdesc = $registered['pdesc'];
            $pimg = $registered['pimg'];
            $price = $registered['price'];
            $ptype = $registered['ptype'];
            $size = $registered['size'];
            
            
      //Display for data values in HTML code
      
      echo "<li>";
      echo "img src=\"$pimg\" width=\"300\" height=\"300\" />";
      echo "<h4>$pname</h4>";
      echo "<p>$pdesc</p>";
      echo "<p>$price</p>";
      echo "<p>$ptype</p>";
      echo "<p>$size</p>";
      
      
      echo"</li>";            
            
        }
        
            echo '</ul>';
            
        
        }        
         else {
             
 //If there are errors while executing the query 
    echo "Nothing Found";
             
             }
             
                }
                
      else echo "Select a product";    
      
      #Navigation links
      
      echo '<p><a href="forum.php">Forum</a> | <a href="shop.php">Shop</a> | 
      <a href="goodbye.php">Logout</a></p>';
      
      #Display footer section
      include ('includes/footer.html') ;
      
      ?>

             
             
             
             


