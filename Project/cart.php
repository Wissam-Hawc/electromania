<?php
require_once 'connection.php';
include 'function.php';
session_start();
$checkout=true;
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>E-Commerce Website - Electromania</title>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/navfoooter.css">
    <!------- pour l ecriture ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- cart and wishist -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/alertbt.css">
</head>

<body>
<?php  include('includes/nav.php'); ?>
<?php if(isset($_SESSION['isloggedin']) && $_SESSION['isloggedin']==1){?>
    <?php if (isset($_SESSION['message']) && $_SESSION['page']=='cart') { ?>
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
    <?php if (isset($_SESSION['message2']) && $_SESSION['page']=='cart') { ?>
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
    <?php $user_id = $_SESSION['user_id'];
    if (isset($_POST['qty'])) {
        $qty = $_POST['qty'];
        $pid = $_POST['pid'];
        $query2 = "UPDATE cart SET quantity='$qty' WHERE product_id='$pid' and user_id='$user_id' ";
        $result2 = mysqli_query($con, $query2);
    }
    else if (isset($_POST['remove'])) {
        $_SESSION['page']='cart';
        $pid = $_POST['pid'];
        $query5 = "DELETE FROM cart WHERE product_id='$pid' AND user_id='$user_id'";
        $result5 = mysqli_query($con, $query5);
        if ($result5) {
            redirect("cart.php", "Product Deleted Successfully");
        } else {
            redirect2("cart.php", "Something Went Wrong");
        }
    } ?>
        <div class="small-container cart-page">
            <table>
                <?php
                $query1 = 'SELECT * FROM cart WHERE user_id=' . $user_id;
                $res1 = mysqli_query($con, $query1);
                $nbr1 = mysqli_num_rows($res1);
                $subtotal = 0;
                if ($nbr1 == 0) {
                    echo '<tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        </tr>';
                    echo '<tr>
        <td></td>
        <td>Your cart is empty</td>
        <td>
        <a class="atag" href="products.php" style="text-decoration: none;padding:0px;">
            <button class="atag" style="width: 85px; height: 40px; padding: 8px;">
                Explore
            </button>
        </a>
    </td>
    </tr>';
                } else {
                    echo '<tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>';
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $query = 'SELECT * FROM product WHERE Product_id=' . $row1['product_id'];
                        $res = mysqli_query($con, $query);
                        $row = mysqli_fetch_assoc($res); // Fetch the product details
                        $p_qty=$row['P_quantity'];
                        $price = $row['P_price'];
                        $quantity=$row1['quantity'];
                        echo '<tr>
            <td>
                <div class="cart-info">
                    <img src="images/' . $row['P_picture'] . '" alt="product">
                    <div>
                        <p> '; if($p_qty>0){
                        
                        echo $row['P_name'] . ' </p>
                        <small> Price: ' . $row['P_price'] . '$</small><br>
                        <form action="removecart.php" method="POST">
                            <input type="hidden" value="' . $row['Product_id'] . '" name="pid">
                            <input type="submit" name="remove" value="remove">
                            </form>
                    </div>
                </div>
            </td>
            <td>
                <form action="cart.php" method="POST">
                    <input type="number" name="qty" value="' . $row1['quantity'] . '" min="1" max="' . $row['P_quantity'] . '">
                    <input type="submit" value="update">
                    <input type="hidden" value="' . $row['Product_id'] . '" name="pid">
                </form>
            </td>';}else{
                $checkout=false;
                echo 'Sorry This Item Is Out of stock  </p>
                <small> Price: 0$ </small><br>
                <form action="removecart.php" method="POST">
                    <input type="hidden" value="' . $row['Product_id'] . '" name="pid">
                    <input type="submit" name="remove" value="remove">
                    </form>
            </div>
        </div>
    </td>
    <td>
        <form action="cart.php" method="POST">
            <input type="number" name="qty" value="0" min="0" max="0">
            <input type="submit" value="update">
            <input type="hidden" value="' . $row['Product_id'] . '" name="pid">
        </form>
    </td>';
                
            }
           echo' <td>' . $price * $row1['quantity'] . '</td>
        </tr>';
                        $subtotal += $price * $row1['quantity'];
                    }
                
                ?>
                <tr>
                    <td></td>
                    <td>Total:</td>
                    <td><?php echo "$subtotal"; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <form method="POST" action="checkout1.php">
                        <input type="hidden" value="<?php echo "$subtotal"; ?>" name="total">
                        <input style="width: 75px;"<?php if ($checkout==false){
                            echo'class="disabled-transparent"';
                        } ?> type="submit" id="checkout"value="Checkout" name="checkout">
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        
        <?php
include('includes/footer.php');
} else {
    // User is not logged in
    echo '<div style="display: flex; flex-direction: column; align-items: center; justify-content: space-between; min-height: calc(100vh - 120px); background-color: #f4f4f4;">
    <div></div>
    <a href="account.php" class="atag" style="text-decoration: none; color: white; display: block; width: 200px; height: 60px;font-size: x-large; margin: 0 auto;text-align: center; line-height: 50px;">Please Log In</a>
    <div></div>
</div>';
    include('includes/footer.php');
  echo"  <style>
    .atag {
        /* Existing button styles */

        /* New styles for hover effect */
        cursor: pointer;
    }

    .atag:hover {
        background-color: dark;
    }
</style>";
}
if ($checkout==false) {
    echo '<style>';
    echo '.disabled-transparent { opacity: 0.5; pointer-events: none; }';
    echo '</style>';
    echo '<script>';
    echo 'window.addEventListener("load", function() {';
    echo '    var checkoutButton = document.getElementById("checkout");';
    echo '    checkoutButton.disabled = true;';
    echo '});';
    echo '</script>';}
?>
</body>

</html>