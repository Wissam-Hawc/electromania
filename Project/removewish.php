<?php
if (isset($_POST['remove'])){
    require_once 'connection.php';
    include 'function.php';
    session_start();
    $id=$_POST['product_id'];
    $query= 'DELETE FROM wishlist WHERE Product_id='.$id.' AND user_id='.$_SESSION['user_id'].'';
    $res=mysqli_query($con,$query);
    if ($res) {
        $_SESSION['page']='wishlist';
        redirect("wishlist.php", "Product Deleted Successfully");
    } else {
        $_SESSION['page']='wishlist';
        redirect2("wishlist.php", "'Something went wrong'");
    }
}
?>