<?php # DISPLAY COMPLETE FORUM PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'userid' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Forum' ;
include ( 'includes/header.html' ) ;


# Implementing code from https://www.bootdey.com/snippets/view/Forum-post-list#html

 echo '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/
css/font-awesome.min.css" rel="stylesheet">';
 

 echo '<div class="row">
        <div class="col-lg-12">
        
           <div class="wrapper wrapper-content animated fadeInRight">

    <div class="ibox-content m-b-sm border-bottom">
     <div class="p-xs">
     <div class="pull-left m-r-md">
     <i class="fa fa-globe text-navy mid-icon"></i>

                </div>
                <h2>Welcome to the Forum</h2>
                </div>
                </div>';
                



# Opening database connection.
require ( 'connect_db.php' ) ;

# Display body section, retrieving from 'forum' database table.
$query = "SELECT `postid`,`fname`,`lname`,`topic`,`content`,`dateofpost` FROM forum" ;
$registered = mysqli_query( $dbc, $query ) ;
if ( mysqli_num_rows( $registered ) > 0 )
{
    
 ?>   
    
		<div class="container">
		<div class="table table-striped">
		<div class="col-3">Posted By</div>
		<div class="col-3">Subject</div>
		<div class="col-6">Message</div>
	
	</div>

<?php 

//starting loop
    while ($row = mysqli_fetch_array($registered, MYSQLI_ASSOC))
    {
        
        
        
        echo '<div class="ibox-content forum-container">

                div class="forum-title">
                <div class="pull-right forum-desc">
                <small>'.
                $row['dateofpost'].'</small>
                    </div>

            <h3>' . $row['fname'] .''. 
            $row['lname']. '</h3>
                    </div>

            
                <div class="forum-item active">
                <div class="row">
                <div class="col-md-9">
                <div class="forum-icon">
                <i class="fa fa-shield"></i>
                     </div>

                <a href="forum_post.html" class="forum-item-title">'.
                $row['topic'] . '</a>
                <div class="forum-sub-title">' . 
                $row['content']. '</div> </div>


                <div class="col-md1 forum-info">
                <span class="views-number"> 

                 </span>    
                    <div>
                    <small></small>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>';
        
    }
                

?>

	<div class="row">
		<div class="col-3">
			<?php echo $row['fname'] .''.$row['lname']; ?> <br>
			<?php echo $row['dateofpost']; ?>
	</div>
		<div class="col-3">
			<?php echo $row['subject']; ?>
	</div>
		<div class="col-6">
			<?php echo $row['message']; ?>
	
	</div>
	</div>
	</div>
	
<?php 


        }

        else  { echo '<p>There are currently no messages.</p>' ; }
            
        
        
#Creating navigation links
echo '<p><a href="post.php">Post Message</a> |  <a href="shop.php">Shop</a> | <a href="home.php">Home</a> | <a href="goodbye.php">Logout</a></p>' ;

#Closing database connection
mysqli_close( $dbc) ;

# Display footer section.
include ( 'includes/footer.html' ) ;

?>
			
			
			
			
			
			
			
			
			
			
		
