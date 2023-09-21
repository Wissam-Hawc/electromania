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
$query="DELETE FROM categories WHERE id=$id";
$result=mysqli_query($con,$query);
$query1="SELECT * FROM product WHERE Category_id='$id'";
$res1=mysqli_query($con,$query1);
$nb=mysqli_num_rows($res1);
if($nb<=0){
if($result){
    redirect("fetch-category.php", "Category Deleted Successfully");
}
else{
    redirect2("fetch-category.php", "Something Went Wrong");
}
}else{
    redirect2("fetch-category.php", "There are products available for this category!");
}

}
?>
