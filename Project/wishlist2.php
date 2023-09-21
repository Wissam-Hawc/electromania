<?php
require_once 'connection.php';
include 'function.php';
session_start();
if(isset($_SESSION['isloggedin']) && $_SESSION['isloggedin']==1){
if (isset($_POST['wish'])) {
    $id = $_POST['id'];
    $query1 = "SELECT * FROM wishlist WHERE Product_id = $id AND user_id = '$_SESSION[user_id]'";
    $res = mysqli_query($con, $query1);
    $row = mysqli_num_rows($res);
    if ($row == 0) {
        $query2 = "INSERT INTO wishlist (Product_id,user_id) VALUES ('$id', '$_SESSION[user_id]')";
        $res1 = mysqli_query($con, $query2);
        if ($res1) {
            $_SESSION['page'] = "cart";
            redirect("productsdetails.php?id=$id", "Item Added Successfully To Your Wishlist");
        } else {
            $_SESSION['page'] = "cart";
            redirect2("productsdetails.php?id=$id", "Something Went Wrong");
        }
    } else {
        $_SESSION['page'] = "cart";
        redirect2("productsdetails.php?id=$id", "Product Already Exists In Your Wishlist");
    }
}
}
else{
    header("Location:wishlist.php");
}