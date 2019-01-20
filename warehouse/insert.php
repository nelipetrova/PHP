<?php include('server.php') ?>
<?php
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
          //exit();
  }
  
if(isset($_POST['insert'])){
      $productName = mysqli_real_escape_string($db, $_POST['productName']); 
      $description = mysqli_real_escape_string($db, $_POST['description']); 
      $image = mysqli_real_escape_string($db, $_POST['image']); 
      $purchase_price = mysqli_real_escape_string($db, $_POST['purchase_price']); 
      $sell_price = mysqli_real_escape_string($db, $_POST['sell_price']);
      $count = mysqli_real_escape_string($db, $_POST['count']); 
      
      if(empty($productName)) {array_push($errors, "Product name is required");}
      if (!preg_match("/^[A-Z a-z]{1,50}$/",$productName)) { array_push($errors, "Invalid product name");}
      if(empty($purchase_price)) {array_push($errors, "Purchase price is required");}
       if (!preg_match("/^[0-9]+(\\.[0-9]+)?$/",$purchase_price)) { array_push($errors, "Invalid purchase price");}
      if(empty($sell_price)) {array_push($errors, "Sell price is required");}
      if (!preg_match("/^[0-9]+(\\.[0-9]+)?$/",$sell_price)) { array_push($errors, "Invalid sell price");}
      if(empty($count)){
          array_push($errors, "Count is required");
          
      }
      if (!preg_match("/^[0-9]*$/",$count)) { array_push($errors, "Invalid count");}
    

      if (count($errors) == 0){
      $query = "INSERT INTO products( productName, description, image, purchase_price, sell_price, count) 
                            VALUES('$productName', '$description', '$image', '$purchase_price', '$sell_price', '$count')";
      mysqli_query($db, $query);
      array_push($success, "Item is successfully added");
      
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
            <h2>Add Item</h2>
        </div>

        <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  	<?php include('errors.php'); ?>
  	<p align='right'>* required field</p>
        <div class="input-group">
  	  <label>Product name *</label>
  	  <input type="text" name="productName" value="<?php echo $productName; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Product description </label>
  	  <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
  	</div>
  	<div class="input-group">
  	  <label>Image</label>
          <input type="file" name="image" >
  	</div>
        <div class="input-group">
  	  <label>Purchase price *</label>
          <input type="text" name="purchase_price" value="<?php echo $purchase_price; ?>">
  	</div>
        <div class="input-group">
  	  <label>Sell price *</label>
          <input type="text" name="sell_price" value="<?php echo $sell_price; ?>">
  	</div>
      <div class="input-group">
  	  <label>Count *</label>
          <input type="text" name="count" value="<?php echo $count; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="insert">Add item</button>
  	</div>
  </form>
        
 </body>
 
</html>