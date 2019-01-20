<?php include('server.php') ?>
<?php
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
          //exit();
  }
if(isset($_GET['search']))
{
    $valueToSearch = $_GET['valueToSearch'];
    $query = "SELECT * FROM products WHERE productName LIKE '%".$valueToSearch."%'";
    $search_result = mysqli_query($db, $query);
}
 else {

    $search_result = NULL; 
}
	
		

if (isset($_GET['del'])) {
	
	mysqli_query($db, "DELETE FROM products WHERE id=".$_GET['del']);
	$_SESSION['message'] = "Address deleted!"; 
        
 header('location: '. $_SERVER['HTTP_REFERER']);
 
}




?>

<!DOCTYPE html>
<html>
    <head>
        <title>TABLE DATA SEARCH</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
       
        <div class="logout">             	
            <p class="li"> <a href="server.php?logout='1'" >Logout</a>
            </p>            
        </div>    
      
        <div class="header_s">  	
            <h2>Search for item</h2> 
        </div>
        <form class="search" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));  ?>" method="get">
            <input type="text" name="valueToSearch" class="btnn" placeholder="Value To Search">
            <input type="submit" name="search" class="btn" value="Filter"><br><br>                
                 
           
 <?php if($search_result != NULL){            
     $counter=0;     
     while($row = mysqli_fetch_array($search_result)){     
         $counter++;         
         if($counter == 1):?>         
            <table>         
            
                <tr>              
                           
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Purchase price</th>
                    <th>Sell Price</th>
                    <th>Count</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr> 
               
  <?php endif;?>           
     <?php if($counter >= 1):?>
                   
                <tr>               
                    
                    <td><?php echo $row['productName'];?><br></td>
                    <td> <?php echo $row['description'];?><br></td>
                    <td><?php echo $row['image'];?><br></td>
                    <td><?php echo $row['purchase_price'];?><br></td>
                    <td><?php echo $row['sell_price'];?><br></td>
                    <td><?php echo $row['count'];?><br></td> 
                    <td>
				<br><a href="edit.php?edit=<?php echo $row['id']; ?>" class="btnt" > Edit </a><br><br>
			</td>
                   <td>
                   
				<a href="javascript:del(<?php echo $row[0]; ?>)" class="btnt">Delete</a>
			</td>
                </tr>                 
         
    <?php endif;?>       
                            
           
  <?php }?>           
            </table>
          
   <?php if($counter == 0){      
       echo "No products found";                
       
       }?>
           <?php }?>   
             <br><br>   
            <p>  		
                <a href="insert.php" class="btn">Add item</a>  	
            </p>       
        </form>
 <script type="text/javascript">
function del(id)
{
     if(confirm('This product will be deleted! Do you want to proceed'))
     {
        window.location.href='data.php?del='+id;
       
     }
}

</script>
    </body>
</html>
