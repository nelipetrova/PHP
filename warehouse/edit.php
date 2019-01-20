<?php include('server.php') ?>
<?php
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
          //exit();
  }
if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
                $query = "SELECT * FROM products WHERE id=$id";
		$record = mysqli_query($db,$query );

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$id = $n['id'];
                        $productName = $n['productName'];
	                $description = $n['description'];
                        $image = $n['image'];
                        $purchase_price = $n['purchase_price'];
                        $sell_price = $n['sell_price'];
                        $count = $n['count'];
		}
	}
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$productName = $_POST['productName'];
	$description = $_POST['description'];
        $image = $_POST['image'];
        $purchase_price = $_POST['purchase_price'];
        $sell_price = $_POST['sell_price'];
        $count = $_POST['count'];
        
        
        if(empty($productName)) {array_push($errors, "Product name is required");}
      if (!preg_match("/^[A-Z a-z]{1,50}$/",$productName)) { array_push($errors, "Invalid product name");}
      if(empty($purchase_price)) {array_push($errors, "Purchase price is required");}
       if (!preg_match("/^[0-9]+(\\.[0-9]+)?$/",$purchase_price)) { array_push($errors, "Invalid purchase price");}
      if(empty($sell_price)) {array_push($errors, "Sell price is required");}
      if (!preg_match("/^[0-9]+(\\.[0-9]+)?$/",$sell_price)) { array_push($errors, "Invalid sell price");}
      if(empty($count)){array_push($errors, "Count is required");}
      if (!preg_match("/^[0-9]*$/",$count)) { array_push($errors, "Invalid count");}
    

      if (count($errors) == 0){
        $query = "UPDATE products SET productName='$productName', description='$description', image='$image', purchase_price='$purchase_price',sell_price='$sell_price', count='$count' WHERE id='$id'";
	mysqli_query($db, $query);
      
	$_SESSION['message'] = "Address updated!"; 
	array_push($success, "Item is successfully updated");
      }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Warehouse </title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
         <div class="logout">             	
            <p class="li"> <a href="server.php?logout='1'" >Logout</a>
            <p class="li"> <a href="data.php" >Search</a>
            </p>            
        </div>   
                
        <div class="header">  	
            <h2>Edit Item</h2>
        </div>

        <form  method="post" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI']));  ?>">
  	<?php include('errors.php'); ?>
            <div>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </div>
        <div class="input-group">
  	  <label>Product name </label>
  	  <input type="text" name="productName" value="<?php echo $productName; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Product description </label>
  	  <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
  	</div>
  	<div class="input-group">
  	  <label>Image</label>
          <input type="file" name="image" accept="image/*">
  	</div>
        <div class="input-group">
  	  <label>*Purchase price </label>
          <input type="text" name="purchase_price" value="<?php echo $purchase_price; ?>">
  	</div>
        <div class="input-group">
  	  <label>*Sell price </label>
          <input type="text" name="sell_price" value="<?php echo $sell_price; ?>">
  	</div>
      <div class="input-group">
  	  <label>*Count </label>
  	  <input type="text" name="count" value="<?php echo $count; ?>">
  	</div>
  	<div class="input-group">
  	
	<button class="btn"  type="submit" name="update"  >update</button>
        
  	</div>
  </form>

    </body>
</html>