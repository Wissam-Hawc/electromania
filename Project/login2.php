<?php

include 'connection.php';
include 'function.php';
session_start();
if(isset($_POST['submit2'])){

   $name = mysqli_real_escape_string($con, $_POST['name']);
   $pass = mysqli_real_escape_string($con, md5($_POST['password']));
   $query= "SELECT * FROM user WHERE username ='$name' AND password ='$pass'";
   echo $query;
   $select = mysqli_query($con,$query);
   if(!$select){
    echo 'something went wrong';
   }
   else{
   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['isloggedin'] = 1;
      $_SESSION['username'] = $name;
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['role_id'] = $row['role_id'];
      $_SESSION['page']='home';
      if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
         redirect("index.php", "Welcome ".$_SESSION['username']." To Our Website");
      }
      else{
         redirect("admin/index.php", "Welcome ".$_SESSION['username']." To Your Website");
      }
      
   }else{
      $_SESSION['page']='account';
      redirect2("account.php", "Incorrect Username Or Password!");
   }
   }
}
