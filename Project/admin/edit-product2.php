<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
require_once '../connection.php'; 
require_once '../admin/functions/myfunctions.php'; 

if (isset($_POST['update_product_btn'])){
    if (isset($_POST['category_id']) && $_POST['category_id']!=""
    // because they are required no need for isset
        && $_POST['name']==trim($_POST['name'])
        && $_POST['description']==trim($_POST['description'])
        && $_POST['price']==trim($_POST['price'])
        && $_POST['qty']==trim($_POST['qty'])) {
            $product_id=$_POST['id'];
            $category_id= $_POST['category_id'];
            $name= $_POST['name'];
            $description= $_POST['description'];
            $price= $_POST['price'];
            $qty= $_POST['qty'];
            $path="../images";
            $new_image=$_FILES['image']['name'];
            $old_image=$_POST['old_image'];

            if($new_image!=""){
                $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
                $update_filename = time().'.'.$image_ext;
            }
            else{
                $update_filename=$old_image;
            }
            $query="UPDATE product SET Category_id='$category_id',P_name='$name',P_description='$description',
            P_price='$price',P_quantity='$qty',P_picture='$update_filename' WHERE Product_id='$product_id' ";
            $res=mysqli_query($con,$query);
            if($res){
                // here checking if the photo have been updated
                if($_FILES['image']['name']!=""){
                    move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$update_filename);
                    if(file_exists("../images/".$old_image)){
                        // deleting the old image 
                        unlink("../images/".$old_image);
                    }
                }
                redirect("fetch-product.php", "Product Updated Successfully");
            }
            else{
                redirect2("edit-product.php?id=$product_id", "Something Went Wrong");
            }

        }
}
}
?>