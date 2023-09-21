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
        <?php $user_id = $_SESSION['user_id']; ?>
        <div class="small-container cart-page">
            <table style="width:60%;margin-left: 20%;">
                <?php
                $query1 = 'SELECT * FROM orders WHERE o_status="Pending"and  user_id=' . $user_id;
                $res1 = mysqli_query($con, $query1);
                $nbr1 = mysqli_num_rows($res1);
                if ($nbr1 == 0) {
                    echo '<tr>
                        <th>Order</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>View Order Details</th>
                    </tr>';
                    echo '<tr>
                        <td></td>
                        <td>No Orders Yet</td>
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
                        <th>Order</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>View Order Details</th>
                    </tr>';
                    for ($i = 1; $i <= $nbr1; $i++) {
                        $row1 = mysqli_fetch_assoc($res1);
                        echo '<tr>
                            <td>
                                ' . $i . '
                            </td>
                            <td>
                                ' . $row1["totalprice"] . '$
                            </td>
                            <td>' . date('Y-m-d', strtotime($row1['o_date'])) . '</td>
                            <td>
                                <a href="vieworders.php?id=' . $row1['order_id'] . '" class="atag">View Details</a>
                            </td>
                        </tr>';
                    }
                }
                ?>
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
