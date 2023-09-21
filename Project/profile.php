<?php
include 'connection.php';
session_start();
if(isset($_SESSION['isloggedin']) && $_SESSION['isloggedin']==1){
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/profile css.css">
    <link rel="stylesheet" href="css/alertbt.css">
     <link rel="stylesheet" href="css/navfoooter.css">
</head>

<body>
<?php include('includes/nav.php'); ?>
<?php if (isset($_SESSION['message']) && $_SESSION['page']=='profile') { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="registration-success" style="z-index:9999;width:100%;">
            <?= $_SESSION['message'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlert('registration-success')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        unset($_SESSION['message']);
        unset($_SESSION['page']);
    } ?>
    <?php if (isset($_SESSION['message2']) && $_SESSION['page']=='profile') { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="registration-error" style="z-index:9999;width:100%;">
            <?= $_SESSION['message2'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlert('registration-error')">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
        unset($_SESSION['message2']);
        unset($_SESSION['page']);
    } 
    $query = "SELECT * FROM user WHERE id=$_SESSION[user_id]";
    $res = mysqli_query($con, $query);
    $nbrows = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
    ?>
    <div class="update-profile">
        <form action="profile2.php" method="post" enctype="multipart/form-data">
            <div class="profile-detail">
                <img src="images/<?php echo $row['image'] ?>">
                <input type="hidden" value="<?php echo $row['image']?>" name="old_image">
            </div>
            <div class="flex">
                <div class="inputBox">
                    <span>First Name</span>
                    <input value="<?php echo $row['fname'] ?>"type="text" name="fname" placeholder="Enter Your First Name" class="box">
                    <span>Your Email</span>
                    <input required type="email" name="update_email" placeholder="Enter Your Email" value="<?php echo $row['email'] ?>" class="box">
                    <span>Update Your Pic</span>
                    <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
                </div>
                <div class="inputBox">
                    <span>Last Name</span>
                    <input value="<?php echo $row['lname'] ?>"type="text" name="lname" placeholder="Enter Your Last Name" class="box">
                    <span>Username</span>
                    <input readonly type="text" name="update_name" placeholder="Enter Your Username" value="<?php echo $row['username'] ?>" class="box">
                    <span>Phone Number</span>
                    <input required type="text" name="pnb" placeholder="Enter Your Phone Number" value="<?php echo $row['phone_number'] ?>" class="box">

                </div>
            </div>
            <input type="submit" value="update profile" name="update_profile" class="btn">
            <a href="changepassword.php" class="btn">change password</a>
            <a href="myorders.php" class="btn">View Orders</a>
        </form></div>  
        <?php include('includes/footer.php'); ?>
        <script>
        function closeAlert(alertId) {
            document.getElementById(alertId).style.display = "none";
        }
    </script>
    <?php }  
else{ 
    header('Location:index.php');
}


    ?>
</body>

</html>