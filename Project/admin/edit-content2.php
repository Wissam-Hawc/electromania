<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
require_once '../connection.php'; 
require_once '../admin/functions/myfunctions.php'; 

if (isset($_POST['update_page_btn'])){
    if (isset($_POST['id']) && $_POST['id']!=""
    // because they are required no need for isset
        && $_POST['description']==trim($_POST['description'])
        && $_POST['title']==trim($_POST['title'])) {
            $id=$_POST['id'];
            $name= $_POST['name'];
            $description= $_POST['description'];
            $title= $_POST['title'];
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
            $query="UPDATE content SET name='$name', description='$description',
            title='$title', image='$update_filename' WHERE id='$id' ";
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
                redirect("fetch-content.php", "Page Updated Successfully");
            }
            else{
                echo '<script>
                alert("'.mysqli_error($con).' Error");
                window.location.replace("edit-content.php");
              </script>';
                
                // redirect2("edit-content.php?id=$id", "Something Went Wrong");
            }

        }
}
}
?>