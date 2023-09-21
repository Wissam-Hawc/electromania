<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
include 'connection.php';
include 'function.php';

if(isset($_POST['submit'])){
    $_SESSION['page']='account';
    if($_POST['name']==trim($_POST['name'])
    && $_POST['email']==trim($_POST['email'])
    && $_POST['password']==trim($_POST['password'])
    && $_POST['pnb']==trim($_POST['pnb'])){
   $name = mysqli_real_escape_string($con, $_POST['name']);
   $email = mysqli_real_escape_string($con, $_POST['email']);
   $phone = mysqli_real_escape_string($con, $_POST['pnb']);
   $pass = mysqli_real_escape_string($con, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($con, md5($_POST['cpassword']));
   $query = "SELECT * FROM user WHERE  username='$name'";
   $select = mysqli_query($con,$query) or die('query failed');
      if (!preg_match('/^[a-zA-Z0-9]+$/', $name)) {
         redirect2("account.php", "Invalid username format. Usernames can only contain letters and numbers.");
      }
      if (!preg_match('/^(?=[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $email)) {
         redirect2("account.php", "Invalid email format.");
     }
     if (!preg_match('/^[+]?[0-9]{8,12}$/', $phone)) {
      redirect2("account.php", "Invalid phone number format. Please use a valid format such as +961XXXXXXXX or XXXXXXXX.");
  }
  if($pass != $cpass){
   redirect2("account.php", "Confirm Password Not Matched! Please Try Again.");

}
       
     if(mysqli_num_rows($select) > 0){
      $message = 'user already exist'; 
      redirect2("account.php", "User Already Exist. Please Try Again.");
   }else{
         $query2="INSERT INTO user (username, email, password, phone_number) VALUES('$name', '$email', '$pass','$phone')";
         $insert = mysqli_query($con,$query2) or die('query failed');

         if($insert){
            redirect("account.php", "Registered Successfully! You Can Log In Now.");
         }else{
            redirect2("account.php", "Registeration Failed! Please Try Again.");
         }
      }
   }
    }
    else{
        redirect2("account.php", "Data should not contain spaces at the beginning or end.");
    }
