<?php
session_start();

$username = "";
$email    = "";
$number    = "";
$productName = "";
$description = "";
$image = "";
$purchase_price = "";
$sell_price = "";
$count = "";
$errors = array(); 
$success = array();

$db = mysqli_connect('localhost', 'root', '', 'warehouse');

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  

if (isset($_GET['logout'])) {
 
       
        unset($_SESSION['username']);
        session_destroy();
  	header("location: login.php");
         
  }










  