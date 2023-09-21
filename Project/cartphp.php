<?php session_start();
if(isset($_SESSION['isloggedin']) && $_SESSION['isloggedin']==1){
?>
<?php
require_once 'connection.php'; 
include 'function.php';

if(isset($_POST['cart'])){
        $id=$_POST['id'];
        $user_id=$_SESSION['user_id'];
        $query1 = "SELECT * FROM cart WHERE product_id = $id AND user_id = $user_id";
        $res=mysqli_query($con,$query1);
        $row=mysqli_num_rows($res);
        if($row==0){

        $query= "INSERT INTO cart (product_id, user_id) VALUES ('$id', '$user_id')";
        $result=mysqli_query($con,$query);
        if($result){
            $_SESSION['page']="cart";
            redirect("productsdetails.php?id=$id", "Item Added Successfully To Your Cart");
        }
        else{
            $_SESSION['page']="cart";
            redirect2("productsdetails.php?id=$id", "Something Went Wrong");
        }
    }
    else{
        $_SESSION['page']="cart";
        redirect2("productsdetails.php?id=$id", "Product Already Exists In Your Cart");
    }
     }


}
else{
header("Location:cart.php");
}?>