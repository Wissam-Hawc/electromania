<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
require_once '../connection.php'; 
require_once '../admin/functions/myfunctions.php'; 

if(isset($_POST['update_category_btn'])){
    if (isset($_POST['category_name'])&&$_POST['category_name']!="") {
        $category_id=$_POST['category_id'];
        $name =mysqli_real_escape_string($con,$_POST['category_name']);
        $query= "UPDATE categories SET C_name='$name' WHERE id='$category_id' ";
        $result=mysqli_query($con,$query);
        if($result){
            redirect("fetch-category.php", "Category Updated Successfully");
        }
        else{
            redirect2("fetch-category.php", "Something Went Wrong");
        }

    }
    else{
        redirect2("fetch-category.php", "Something Went Wrong");
    }
    }

}
?>