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
$query1="SELECT * FROM orders WHERE order_id='$id'";
$res1=mysqli_query($con,$query1);
$row=mysqli_fetch_assoc($res1);
    if($row['o_status']=="Pending"){
        $query= "UPDATE orders SET o_status='Done' WHERE order_id='$id' ";
        $result=mysqli_query($con,$query);
        if($result){
            redirect("orders.php", "Order Status Updated Successfully");
        }
        else{
            redirect2("orders.php", "Something Went Wrong");
        }

    }
    else{
        $query= "UPDATE orders SET o_status='Pending' WHERE order_id='$id' ";
        $result=mysqli_query($con,$query);
        if($result){
            redirect("orders.php", "Order Status Updated Successfully");
        }
        else{
            redirect2("orders.php", "Something Went Wrong");
        }
    }
}
?>