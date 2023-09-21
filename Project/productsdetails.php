<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single E-commerce Product Page using HTML, CSS - Codingscape</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/productsdetails.css">
    <link rel="stylesheet" href="css/navfoooter.css">
    <!---Boxicons CDN Setup for icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- cart and wishist -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/alertbt.css">
    <style>
        .disabled-button {
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <?php session_start();
    include('includes/nav.php');
    ?>
    <?php if (isset($_SESSION['message']) && $_SESSION['page'] == 'cart') { ?>
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
    <?php if (isset($_SESSION['message2']) && $_SESSION['page'] == 'cart') { ?>
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
    require_once 'connection.php';
    $id = $_GET['id'];
    $query = 'SELECT * FROM product WHERE Product_id=' . $id . '';
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    echo '<div class="container10">
        <div class="single-product">
            <div class="row10">
                <div class="col-6">
                    <div class="product-image">
                        <div class="product-image-main">
                            <img src="images/' . $row['P_picture'] . '" alt="" id="product-main-image">
                        </div>
                        
                    </div>
                </div>
                <div class="col-6">
                    

                    <div class="product">
                        <div class="product-title">
                            <h2>' . $row['P_name'] . '</h2>
                        </div>
                        
                        <div class="product-price">
                            <span class="offer-price">' . $row['P_price'] . '$</span>
                            <span class="outofstock">'; ?><?php
                                                            if ($row['P_quantity'] <= 0) {
                                                                $stock = 1;
                                                                echo "Out Of Stock";
                                                            } else {
                                                                $stock = 0;
                                                            }

                                                            ?>
    <?php echo '</span>
                        </div>

                        <div class="product-details">
                            <h3>Description</h3>
                            <p>' . $row['P_description'] . '</p>
                        </div>
                       
                            
                        
                        
                        </div>
                        <span class="divider"></span>'; ?>


    <div class="product-btn-group">
        <form method="POST" action="checkout1.php">
            <input type="hidden" name="id" value="<?php echo $row['Product_id']; ?>">
            <?php if ($stock == 1) {
                echo '<button type="submit" class="button buy-now disabled-button" name="buynow">
              <i class="bx bxs-zap"></i> Buy Now
          </button>';
            } else {
                echo '<button type="submit" class="button buy-now" name="buynow">
              <i class="bx bxs-zap"></i> Buy Now
          </button>';
            }
            ?>
        </form>


        <form method="POST" action="cartphp.php">
            <input type="hidden" name="id" value="<?php echo $row['Product_id']; ?>">
            <?php
            if ($stock == 1) {
                echo '<button type="submit" class="button add-cart disabled-button" name="cart">
              <i class="bx bxs-cart"></i> Add to Cart
          </button>';
            } else {
                echo '<button type="submit" class="button add-cart" name="cart">
              <i class="bx bxs-cart"></i> Add to Cart
          </button>';
            }
            ?>
        </form>

        <form method="POST" action="wishlist2.php">
            <input type="hidden" name="id" value="<?php echo $row['Product_id']; ?>">
            <button type="submit" class="button heart" name="wish">
                <i class="bx bxs-heart"></i> Add To Wishlist
            </button>
        </form>
    </div>
    <?php
    if (isset($_POST['wish'])) {
        $query = 'INSERT INTO wishlist VALUES (' . $row['Product_id'] . ', ' . $_SESSION['user_id'] . ')';
        $res = mysqli_query($con, $query);
    } else if (isset($_POST['wish']) && $_SESSION['isloggedin'] != 1) {
        echo '<script>
                    alert("Please make sure to log in");
                    </script>';
        header('location:register.php');
    }
    echo  '</div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    ?>
    <?php include('includes/footer.php'); ?>
    <!--script-->
    <script>
        // Disable buttons and remove hover effect when the page loads
        window.addEventListener('load', function() {
            var buttons = document.querySelectorAll('.disabled-button');
            buttons.forEach(function(button) {
                button.addEventListener('mouseenter', function() {
                    button.classList.remove('button');
                });
                button.addEventListener('mouseleave', function() {
                    button.classList.add('button');
                });
            });
        });
    </script>

    <script src="script.js"></script>
</body>

</html>