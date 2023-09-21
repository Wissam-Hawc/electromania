<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
require_once '../connection.php'; 
require_once '../admin/functions/myfunctions.php'; 

$id=$_GET['id'];
$query="DELETE FROM user WHERE id=$id";
$result=mysqli_query($con,$query);
$query1 = 'SELECT * FROM orders WHERE o_status="Pending"and  user_id=' . $id;
$result1=mysqli_query($con,$query1);
$nb=mysqli_num_rows($result1);
if($nb<=0){
if($result){
    redirect("fetch-user.php", "User Deleted Successfully");
}
else{
    redirect2("fetch-user.php", "Something Went Wrong");
}
}
else{
    redirect2("fetch-user.php", "Cant Delete. This user have orders!");
}

}
?>
