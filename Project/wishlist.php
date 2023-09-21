<!DOCTYPE html>

<html>

<head>

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
        <link rel="stylesheet" href="css/wishlist.css">
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
    <?php include('includes/nav.php'); ?>
    <?php if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == 1) { ?>
        <?php if (isset($_SESSION['message']) && $_SESSION['page'] == 'wishlist') { ?>
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
        <?php if (isset($_SESSION['message2']) && $_SESSION['page'] == 'wishlist') { ?>
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
        <?php
        $query2 = 'SELECT * FROM wishlist WHERE user_id=' . $_SESSION['user_id'];
        $res2 = mysqli_query($con, $query2);
        $nbr = mysqli_num_rows($res2);
        if ($nbr == 0) {
            echo '<div style="display: flex; flex-direction: column; align-items: center; justify-content: space-between; min-height: calc(100vh - 120px); background-color: #f4f4f4;">
            <div></div>
            <h1>Your wishlist is empty</h1>
            <a href="products.php" class="atag" style="text-decoration: none; color: white; display: block; width: 200px; height: 60px;font-size: x-large; margin: 0 auto;text-align: center; line-height: 50px;">Explore</a>
            <div></div>
        </div>';
            
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
        } else {
            ?><div class="container">
            <h1>Wishlist</h1>
            <div class="cart">
            <div class="products">
            <?php for ($i = 0; $i < $nbr; $i++) {
                $row2 = mysqli_fetch_assoc($res2);
                $product_id = $row2['Product_id'];
                $query3 = 'SELECT * FROM product WHERE Product_id=' . $product_id;
                $res3 = mysqli_query($con, $query3);
                $row3 = mysqli_fetch_assoc($res3);
        ?>
                            <div class="product">

                                <img src="images/<?php echo $row3['P_picture']; ?>">

                                <div class="product-info">

                                    <h3 class="product-name"><?php echo $row3['P_name']; ?></h3>

                                    <h4 class="product-price"><?php echo $row3['P_price']; ?>$</h4>

                                    <p class="product-remove">
                                    <form action="removewish.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" class="product-remove" name="remove">Remove</button>
                                    </form>
                                    </p>

                                </div>

                            </div>

                    <?php
                }
            }
                    ?>

                        </div>

                    </div>

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
            echo "  <style>
    .atag {
        cursor: pointer;
    }

    .atag:hover {
        background-color: dark;
    }
</style>";
        }
            ?>