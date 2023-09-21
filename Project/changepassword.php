<!DOCTYPE httml>
<html lang="en">

<head>
  <link rel="stylesheet" href="css/change password.css">
  <link rel="stylesheet" href="css/alertbt.css">
  <link rel="stylesheet" href="css/navfoooter.css">
  <!-- cart and wishist -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php
  include 'connection.php';
  include 'function.php';
  session_start();
  $_SESSION['page'] = 'changepass';
  $user_id = $_SESSION['user_id'];
  $query = "SELECT password FROM user WHERE id='$user_id'";
  $res = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($res);
  if (isset($_POST['updatepassword'])) {
    if (md5($_POST['oldpassword']) == $row['password']) {
      if ($_POST['password'] == $_POST['confirmPassword']) {
        $pass = md5($_POST['password']);
      } else {
        redirect2("changepassword.php", "Password Does Not Match!");
      }
      $query2 = "UPDATE user SET password='$pass' WHERE id='$user_id'";
      $res2 = mysqli_query($con, $query2);

      if ($res2) {
        $_SESSION['page'] = 'profile';
        redirect("profile.php", "password Updated Successfully");
      } else {
        redirect2("changepassword.php", "Something Went Wrong!");
      }
    } else {
      redirect2("changepassword.php", "Old Password Incorrect");
    }
  }
  ?>
    <?php include('includes/nav.php'); ?>
  <?php if (isset($_SESSION['message2']) && $_SESSION['page'] == 'changepass') { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="registration-error" style="z-index:9999;width:100%;">
      <?= $_SESSION['message2'] ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closeAlert('registration-error')">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php
    unset($_SESSION['message2']);
    unset($_SESSION['page']);
  } ?>
  <script>
    function closeAlert(alertId) {
      document.getElementById(alertId).style.display = "none";
    }
  </script>
<div class="update-profile">
    <form action="changepassword.php" method="post">
        <h2 style="padding: 0px 100px 40px 120px;">Change Password</h2>
        <div class="inputBox">
            <span>Old Password</span>
            <div class="password-container">
                <input type="password" name="oldpassword" placeholder="Enter Your Old Password" class="box" required>
            </div>
        </div>
        <div class="inputBox">
            <span>New Password</span>
            <div class="password-container">
                <input type="password" name="password" placeholder="Enter Your New Password" class="box" required>
            </div>
        </div>
        <div class="inputBox">
            <span>Confirm Password</span>
            <div class="password-container">
                <input type="password" name="confirmPassword" placeholder="Confirm Your New Password" class="box" required>
            </div>
        </div>
        <input type="submit" value="Change Password" name="updatepassword" class="btn">
    </form>
</div>



  <?php include('includes/footer.php'); ?>
</body>

</html>