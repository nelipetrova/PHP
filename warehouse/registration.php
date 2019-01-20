<?php include('server.php') ?>
<?php
if (isset($_POST['reg_user'])) {
  
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $number = mysqli_real_escape_string($db, $_POST['number']);

  
  if (empty($username)) { array_push($errors, "Username is required"); } 
  if (!preg_match("/^[a-zA-Z\_ ]{5,15}$/",$username)) { array_push($errors, "Username consist of lowercase, capitals and/or underscore '_'. Length between 5 and 15 characters. "); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (!preg_match("/^(?=\S*[A-Z])(?=\S*[a-z])(?=\S*[@,-,_,~,|]).{6,20}$/",$password_1)) { array_push($errors, "Password: Minimum 6 and maximum 20 characters, at least one uppercase letter, one lowercase letter and one special character:'@, -, _, ~, |'"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { array_push($errors, "Invalid email"); }
  if (!preg_match("/^[0-9- ]*$/",$number)) { array_push($errors, "Nimber can contain only digits, space and dash '-'"); }
  
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  
  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO users (username, password, email, number) 
  			  VALUES('$username', '$password', '$email', '$number')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: data.php'); 
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Warehouse</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="registration.php">
  	<?php include('errors.php'); ?>
  	<p>* required field</p>
        <div class="input-group">
  	  <label>Username *</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password *</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password *</label>
          <input type="password" name="password_2" >
  	</div>
        <div class="input-group">
  	  <label>Email *</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
      <div class="input-group">
  	  <label>Phone number</label>
  	  <input type="text" name="number" value="<?php echo $number; ?>">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
        <p>
  		 <a href="login.php">Login</a>
  	</p>
  </form>
</body>
</html>