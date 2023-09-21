<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>

<?php
require_once '../connection.php'; 
require_once '../admin/functions/myfunctions.php'; 

if (isset($_POST['add_product_btn'])){
    if (isset($_POST['category_id']) && $_POST['category_id']!=""
    // because they are required no need for isset
        && $_POST['name']==trim($_POST['name'])
        && $_POST['description']==trim($_POST['description'])
        && $_POST['price']==trim($_POST['price'])
        && $_POST['qty']==trim($_POST['qty'])) {
            $category_id= $_POST['category_id'];
            $name= $_POST['name'];
            $description= $_POST['description'];
            $price= $_POST['price'];
            $qty= $_POST['qty'];
            $image = $_FILES['image']['name'];
            $path="../images";
            // getting the extansion
            $image_ext = pathinfo($image, PATHINFO_EXTENSION);
            // changing the name of photo : adding time so none of the photos will have same name.
            $filename = time().'.'.$image_ext;
            $query = "INSERT INTO product (P_name,P_description,P_price,P_picture,P_quantity,Category_id) VALUES
            ('$name','$description','$price','$filename','$qty','$category_id')";
            $result=mysqli_query($con,$query);
            if($result){
                echo"$result";
                move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$filename);
                redirect('add-product.php','Product Added Successfully');
            
            } else {
                // echo "fail". mysqli_error($con);
                redirect2("add-product.php", "Something Went Wrong"); 
            }
        
        }
    else{
        // echo"failure";
        redirect2("add-product.php", "Something Went Wrong"); 
    }
}
}
    ?>