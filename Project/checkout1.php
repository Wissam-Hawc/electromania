<!DOCTYPE html>
<html>
<?php session_start();
include 'function.php';?>

<?php if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == 1) { ?>
<head>
    <meta charset="UTF-8">
    <title>E-Commerce Website - Electromania</title>
    <link rel="stylesheet" href="css/navfoooter.css">
    <link rel="stylesheet" href="css/checkout.css">
    <!------- pour l ecriture ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- cart and wishist -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/alertbt.css">
    <script defer src="validate.js"></script>

</head>

<body>
    <?php if (isset($_POST['checkout'])) {

    ?>
        <?php include('includes/nav.php'); ?>
        <?php 
        require_once 'connection.php';
        $query='SELECT * FROM user WHERE id='.$_SESSION['user_id'].'';
        $res=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($res);
        ?>
        <div class="body">
            <div class="form-container">
                <h2 class="form-title">Checkout Details</h2>
                <form id="form" action="checkout2.php" method="POST" class="checkout-form">
                        <div class="input-line">
                            <label for="name">Full Name</label>
                            <input value="<?php echo $row['fname'] ." ". $row['lname'] ?>" type="text" name="fullname" id="fullname" placeholder="Your name and surname">
                            <div class="error"></div>
                        </div>
                        <div class="input-line">
                            <label for="pnb">Phone Number</label>
                            <input type="text" name="pnb" id="phone" value="<?php echo $row['phone_number'] ?>" placeholder="+96103222333">
                            <div class="error"></div>
                        </div>
                    <div class="input-line">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>" placeholder="john@gmail.com">
                        <div class="error"></div>
                    </div>
                    <div class="input-line">
                        <label for="address">Full Address</label>
                        <input type="text" name="address" id="address" placeholder="Azmi St - Farhat building - 9th floor">
                        <div class="error"></div>
                    </div>
                    <div class="input-line" style="text-align-last: justify;">
                        <input style="width:20%;color:darkred"type="text" value="Total:" readonly>
                        <input type="hidden" name="total" id="total" value="<?php echo " $_POST[total]"; ?>" readonly>
                        <input style="width:19%;"type="text" value="<?php echo ' ' . $_POST['total'] . ''; ?>$" readonly>

                        <input type="hidden" name="check" id="check" value="" readonly>

                        <input type="submit" value="Complete purchase" name="checkout">
                    </div>

                    
                </form>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>
        <?php } else if (isset($_POST['buynow'])) {
        ?><?php include('includes/nav.php'); ?>
                <?php 
        require_once 'connection.php';
        $query='SELECT * FROM user WHERE id='.$_SESSION['user_id'].'';
        $res=mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($res);
        ?>
        <div class="body">
            <div class="form-container">
                <h2 class="form-title">Checkout Details</h2>
                <form id="form" action="checkout2.php" method="POST" class="checkout-form">
                        <div class="input-line">
                            <label for="name">Full Name</label>
                            <input value="<?php echo $row['fname'] ." ". $row['lname'] ?>"type="text" name="fullname" id="fullname" placeholder="Your name and surname" required>
                            <div class="error"></div>
                        </div>
                        <div class="input-line">
                            <label for="pnb">Phone Number</label>
                            <input type="text" name="pnb" id="phone" value="<?php echo $row['phone_number'] ?>" placeholder="+96103222333" required>
                            <div class="error"></div>
                        </div>
                    
                    <div class="input-line">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>"placeholder="john@gmail.com" required>
                        <div class="error"></div>
                    </div>
                    <div class="input-line">
                        <label for="address">Full Address</label>
                        <input type="text" name="address" id="address" placeholder="Azmi St - Farhat building - 9th floor">
                        <div class="error"></div>
                    </div>
                    <?php
                    require_once 'connection.php';
                    $id = $_POST['id'];
                    $query = 'SELECT * FROM product WHERE Product_id= ' . $id . '';
                    $res = mysqli_query($con, $query);
                    $row = mysqli_fetch_assoc($res);
                    ?>
                    <div class="input-line" style="text-align-last: justify;">
                    <input style="width:20%;color:darkred"type="text" value="Total:" readonly>
                        <input type="hidden" name="total" id="total" value="<?php echo " $row[P_price]"; ?>" readonly>
                        <input type="hidden" name="id" id="total" value="<?php echo "$id"; ?>" readonly>
                        <input style="width:19%;"type="text" value="<?php echo ' ' . $row['P_price'] . ''; ?>$" readonly>
                        <input type="hidden" name="buyn" id="buynow" value="" readonly>

                        <input type="submit" value="Complete purchase" name="buynow">
                    </div>
                </form>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>
    <?php } else {
        header("Location:cart.php");
    } ?>
</body>
<?php } 
     else {
        $_SESSION['page']="account";
        redirect2("account.php", "Please login");
        exit;
}?>
</html>