<?php
require_once 'connection.php';
include 'function.php';
session_start();
$user_id = $_SESSION['user_id']; 

if (isset($_POST['remove'])) {
    $_SESSION['page']='cart';
    $pid = $_POST['pid'];
    $query5 = "DELETE FROM cart WHERE product_id='$pid' AND user_id='$user_id'";
    $result5 = mysqli_query($con, $query5);
    if ($result5) {
        redirect("cart.php", "Product Deleted Successfully");
    } else {
        redirect2("cart.php", "Something Went Wrong");
    }
} 





?>