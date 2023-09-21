<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>

<?php
require_once '../connection.php'; 
require_once '../admin/functions/myfunctions.php'; 

if (isset($_POST['add_category_btn'])) { 
    if ($_POST['category_name']==trim($_POST['category_name'])) {
        $name = mysqli_real_escape_string($con, $_POST['category_name']);
        $query = "INSERT INTO categories (C_name) VALUES ('$name')";
        $result = mysqli_query($con, $query);
        if ($result) {
            redirect("add-category.php", "Category Added Successfully");
        } else {
            redirect2("add-category.php", "Something Went Wrong"); 
        }
    }
    else{
        redirect2("add-category.php", "Something Went Wrong"); 
    }
}
}
?>
