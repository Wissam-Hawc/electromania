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
$query="DELETE FROM orders WHERE order_id='$id'";
$result=mysqli_query($con,$query);
$query1="DELETE FROM orders_details WHERE order_id='$id'";
$res1=mysqli_query($con,$query1);
if($result && $res1){
    redirect("orders.php", "Order Deleted Successfully");
}
else{
    redirect2("orders.php", "Something Went Wrong");
}


}
?>
