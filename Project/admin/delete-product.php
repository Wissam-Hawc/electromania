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
$query1="SELECT * FROM product WHERE Product_id='$id'";
$res1=mysqli_query($con,$query1);
$row=mysqli_fetch_assoc($res1);
$image=$row['P_picture'];
$query2="DELETE FROM product WHERE Product_id=$id";
$res2=mysqli_query($con,$query2);
$query = "SELECT * FROM orders_details WHERE product_id='$id' ";
$res=mysqli_query($con,$query);
$nb=mysqli_num_rows($res);
if($nb<=0){
if($res2){
    if(file_exists("../images/".$image)){
        unlink("../images/".$image);
    }
    redirect("fetch-product.php", "Product Deleted Successfully");
}
else{
    redirect2("fetch-product.php", "Something Went Wrong");
}
}else{
    redirect2("fetch-product.php", "This product cannot be deleted as it is associated with existing orders.");
}
}

?>