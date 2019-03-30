<?php # DISPLAY COMPLETE PRODUCTS PAGE.


# start session.
session_start() ;


# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userid' ] ) ) { require ( 'login_tools.php' ) ; load() ; }


# Set page title and display header section.
$page_title = 'Shop' ;
include ( 'includes/header.html' );


# Open database connection.
require ( 'connect_db.php' ) ;



if(!empty($_POST['filter'])){
    $filtervalue = $_POST['filter'];
    $query = "SELECT * FROM shop WHERE ptype='$filtervalue'";
    
            }
           
            
elseif(!empty($_POST['sort'])){
    $sortvalue = $_POST['sort'];
    $query = "SELECT * FROM shop ORDER BY price $sortvalue";
    
               }

               else {
                   $query = "SELECT * FROM shop" ;
                   
               }
               
               if ($_SESSION['level'] == 'admin') {
                   echo $_SESSION['level'];
                   //for admin
                  
                ?>   
                
                <button type="button" class="btn btn-primary">Add Product</button>
    
           
           		<?php 
           
           
                            }
                            
                            else {
                                
                           echo $_SESSION['level'];
                                                      
                                }
                                 
                                 
                $registered = mysqli_query($dbc, $query) ;
                if (mysqli_num_rows($registered) > 0 )
                                  {
                                      
                                   ?>   
                                   
                                   
         <!-- list for filter  -->       
         
          <form action="shop.php" method="post">
    	<select name="filter">
    		<option value="Tops">Tops</option>
    		<option value="Skirts">Skirts</option>
    		<option value="Pants">Pants</option>    	
    		</select>	
    	   <input type="Submit" value="Filter" />
    		
    		</form>
    		
    		Price:
    		<form action="shop.php" method="post">
    		<select name="sort">
    		<option value="ASC">Lowest to Highest</option>
    		<option value="DESC">Highest to Lowest</option>
           </select>
           <input type="Submit" value="Sort" />
    		</form>
    		
    		<div class="container">
    		<div class="row">
    		
    		<?php
    		
    		while ($row = mysqli_fetch_array($registered, MYSQLI_ASSOC))
    		              {
                              
    		                  
    		               ?>
    		               
    		               
    		               
    		<div class="col">
    		<strong><?php echo $row['pname']; ?>?></strong><br>
    		<span style="font-size:smaller"><?php echo $row['pdesc']; ?></span><br>
    		<img src='<?php echo $row['pimg']; ?>'><br>
    		$<?php echo $row['price']; ?><br>
    		<a href="added.php?id='<?php echo $row['productid']; ?>">Add To Cart</a>
    			</div> 
    			
    			<?php }
    			
    			if(!empty($_POST['filter'])){
    			    $filtervalue = $_POST['filter'];
    			    
    			           ?>
    			           
    		<div class="alert alert-info" role="alert">
    		You are viewing <?php echo $filtervalue."."; ?>
    		</div>
    		
    		<?php
    			}
    			elseif(!empty($_POST['sort'])){
    			    $sortvalue = $_POST['sort'];
    			    ?>
    			<div class="alert alert-success" role="alert">
    			
    			You are viewing prices in <?php echo $sortvalue."order."; ?>
    			  </div>
    			  
    			  
    			  <?php
    			}
    			
    			else {
    			    
    			    
    			}
    			
    			
    			
    			?>
    			
    			</div>
    			</div>
			
<!-- Starting bootsrap snippet here in attempt to maintain sort/filter/add to cart -->	
			
	<div class="container bootstrap snipets">
   <h1 class="text-center text-muted">Product catalog</h1>
   <div class="row flow-offset-1">
     <div class="col-xs-6 col-md-4">
     <div class="product tumbnail thumbnail-3"><a href="detailed.php?id=<?php echo $productid; ?>"><img src="images/vintagecreamtop.jpg" class="img-responsive" alt=""></a>
         <div class="caption">
      <h6><a href="detailed.php?id=<?php echo $pname; ?>">Cream Silk Top</a></h6><span class="price">$125.00</span>
        </div>
       </div>
     </div>
     
       <div class="col-xs-6 col-md-4">
     <div class="product tumbnail thumbnail-3"><a href="detailed.php?id=<?php echo $productid; ?>"><img src="images/vintageblacksilktop.jpg" class="img-responsive" alt=""></a>
         <div class="caption">
      <h6><a href="detailed.php?id=<?php echo $pname; ?>">Black Silk Top</a></h6><span class="price">$125.00</span>
        </div>
       </div>
     </div>
     
      <div class="col-xs-6 col-md-4">
     <div class="product tumbnail thumbnail-3"><a href="detailed.php?id=<?php echo $productid; ?>"><img src="images/vintagewidelegpants.jpg" class="img-responsive" alt=""></a>
         <div class="caption">
      <h6><a href="detailed.php?id=<?php echo $pname; ?>">Wide Leg Pants</a></h6><span class="price">$180.00</span>
        </div>
       </div>
     </div>
     
      <div class="col-xs-6 col-md-4">
     <div class="product tumbnail thumbnail-3"><a href="detailed.php?id=<?php echo $productid; ?>"><img src="images/vintagemidrisepants.jpg" class="img-responsive" alt=""></a>
         <div class="caption">
      <h6><a href="detailed.php?id=<?php echo $pname; ?>">Mid Rise Pants</a></h6><span class="price">$140.00</span>
        </div>
       </div>
     </div>
     
        <div class="col-xs-6 col-md-4">
     <div class="product tumbnail thumbnail-3"><a href="detailed.php?id=<?php echo $productid; ?>"><img src="images/vintagehtskirt.jpg" class="img-responsive" alt=""></a>
         <div class="caption">
      <h6><a href="detailed.php?id=<?php echo $pname; ?>">Houndstooth Skirt</a></h6><span class="price">$85.00</span>
        </div>
       </div>
     </div>
     
     
     
        <div class="col-xs-6 col-md-4">
     <div class="product tumbnail thumbnail-3"><a href="detailed.php?id=<?php echo $productid; ?>"><img src="images/vintagetanskirt.jpg" class="img-responsive" alt=""></a>
         <div class="caption">
      <h6><a href="detailed.php?id=<?php echo $pname; ?>">Tan Pencil Skirt</a></h6><span class="price">$50.00</span>
       </div>
       </div>
     </div>
   </div>
 </div>
          
			
			<?php
			
			#Close database connection
			mysqli_close($dbc) ;
			
            }
			
            
   #Or display message.
    else { echo '<p>There are currently no items in this cart.</p>' ; 
                    
            }

#Create navigation links.

echo '<p><a href="cart.php">View Cart</a> | <a href="shop.php">Shop</a> |
<a href="forum.php">Forum</a> | <a href="home.php">Home</a>
 | <a href="goodbye.php">Logout</a></p>' ;

#Display footer section 
include ('includes/footer.html') ;

            ?>
