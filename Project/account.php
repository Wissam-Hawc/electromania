<?php session_start() ;
if(isset($_SESSION['isloggedin']) && $_SESSION['isloggedin']==1){
    header("Location:index.php");
}
else{
?>
<!DOCTYPE html>


<head>
    
    <link rel="stylesheet" href="css/account.css">
    <link rel="stylesheet" href="css/navfoooter.css">
    <link rel="stylesheet" href="css/alertbt.css">
    <style type="text/css" id="operaUserStyle"></style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

</head>


<body>
    <!----------------ACCOUNT-page--------------->
    <?php include('includes/nav.php'); ?>
    <?php if (isset($_SESSION['message']) && $_SESSION['page']=='account') { ?>
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
    <?php if (isset($_SESSION['message2']) && $_SESSION['page']=='account') { ?>
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
    <div class="account-page">

        <div class="container">

            <div class="row">
                <div class="col-2">
                    <img src="images/background.png" width="70%">
                </div>
                <div class="col-2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Log In</span>
                            <span onclick="register()">Register</span>
                            <hr id="indicator">
                        </div>
                        <form method="post" id="loginform" action="login2.php">
                            <ion-icon name="person"></ion-icon>
                            <input name="name" type="text" placeholder="Username" required>
                            
                            <ion-icon name="lock-closed"></ion-icon>
                            <input name="password" type="password" placeholder="Password" required>
                            <button name="submit2" type="submit" class="btn">login</button> 
                        </form>
                        <form method="post" id="registerform" action="register2.php">
                            <ion-icon name="person"></ion-icon>
                            <input type="text" name="name" placeholder="Username" required>
                            <ion-icon name="mail"></ion-icon>
                            <input type="email" name="email" placeholder="Email" required>
                            <ion-icon name="call"></ion-icon>
                            <input type="text" name="pnb" placeholder="Phone Number" required>
                            <ion-icon name="lock-closed"></ion-icon>
                            <input type="password" name="password" placeholder="Password" required>
                            <ion-icon name="lock-closed"></ion-icon>
                            <input type="password" name="cpassword" placeholder="Confirm Password" required>
                            <button name="submit" type="submit" class="btn">Register</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-----------js for toggle--form-->
    <script>
        let loginform = document.getElementById("loginform");
        let registerform = document.getElementById("registerform");
        let indicator = document.getElementById("indicator");

        function register() {
            registerform.style.transform = "translatex(0px)";
            loginform.style.transform = "translatex(0px)";
            indicator.style.transform = "translatex(100px)";
        }

        function login() {
            registerform.style.transform = "translatex(300px)";
            loginform.style.transform = "translatex(300px)";
            indicator.style.transform = "translatex(0px)";
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@latest/dist/ionicons/ionicons.js"></script>

    <?php include('includes/footer.php'); ?>


</body>

</html>
<?php } ?>