<?php
require_once 'connection.php';
include 'function.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>E-Commerce Website - Electromania</title>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/navfoooter.css">
    <!------- pour l'écriture ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- cart and wishlist -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/alertbt.css">
</head>

<body>
    <?php if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == 1) { ?>
        <?php include('includes/nav.php'); ?>
        <?php $user_id = $_SESSION['user_id']; 
        $id=$_GET['id'];
        ?>
        <div class="small-container cart-page">
        <table style="width:60%;margin-left: 20%;">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query3 = "SELECT * FROM orders_details WHERE order_id='$id'";
        $res3 = mysqli_query($con, $query3);

        while ($row3 = mysqli_fetch_assoc($res3)) {
            $product_id = $row3['product_id'];

            $query4 = "SELECT * FROM product WHERE Product_id='$product_id'";
            $res4 = mysqli_query($con, $query4);
            $rowproduct = mysqli_fetch_assoc($res4);

            echo "<tr>
                <td>
                    <img src='images/$rowproduct[P_picture]' width='50px' height='50px' alt='$rowproduct[P_name]'>
                </td>
                <td>$row3[product_price]$</td>
                <td>$row3[quantity]</td>
            </tr>";
        }
        ?>
    </tbody>
</table>

        </div>
        <?php
        include('includes/footer.php');
    } else {
        header('Location: index.php');
    }
    ?>
</body>

</html>
