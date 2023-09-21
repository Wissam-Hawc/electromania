<?php

include 'connection.php';
include 'function.php';
session_start();
if (isset($_POST['update_profile'])) {
    $user_id = $_SESSION['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $update_email = $_POST['update_email'];
    $update_name = $_POST['update_name'];
    $pnb = $_POST['pnb'];
    $old_image=$_POST['old_image'];
    $_SESSION['page']='profile';
    if (!preg_match('/^(?=[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$)[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $update_email)) {
        redirect2("profile.php", "Invalid email format.");
    }
    if (!preg_match('/^[+]?[0-9]{8,12}$/', $pnb)) {
     redirect2("profile.php", "Invalid phone number format. Please use a valid format such as +961XXXXXXXX or XXXXXXXX.");
 }
 if (!preg_match('/^[a-zA-Z]+$/', $fname) || $fname !== trim($fname)) {
    redirect2("profile.php", "Your First name should contain only letters");
}
if (!preg_match('/^[a-zA-Z]+$/', $lname) || $lname !== trim($lname)) {
    redirect2("profile.php", "Your Last name should contain only letters");
}
   
    
    // Process the image upload if a file is selected
    if ($_FILES['update_image']['size'] > 0) {
        $image_path = "images/";
        $image_name = $_FILES['update_image']['name'];
        move_uploaded_file($_FILES['update_image']['tmp_name'], $image_path . $image_name);
        if(file_exists("images/".$old_image) && $old_image!='default-avatar.png'){
            // deleting the old image 
            unlink("images/".$old_image);
        }
    } else {
        // If no new image is uploaded, retain the existing image name
        $query_existing_image = "SELECT image FROM user WHERE id='$user_id'";
        $result_existing_image = mysqli_query($con, $query_existing_image);
        
        if ($result_existing_image && mysqli_num_rows($result_existing_image) > 0) {
            $row_existing_image = mysqli_fetch_assoc($result_existing_image);
            $image_name = $row_existing_image['image'];
        }
    }

    $query = "UPDATE user SET fname='$fname', lname='$lname', email='$update_email',
              username='$update_name', phone_number='$pnb', image='$image_name' 
              WHERE id='$user_id'";

    $res = mysqli_query($con, $query);
    
    if ($res) {
        redirect("profile.php", "Profile Updated Successfully");
    } else {
        redirect2("profile.php", "Something Went Wrong!");
    }
}
?>
