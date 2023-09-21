<?php include 'login2.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>E-Commerce Website - Electromania</title>
    <link rel="stylesheet" href="css/homestyle.css">
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
    <div class="header">
        <div class="nav-color">
            <div class="container">
                <div class="navbar">
                    <a href="index.php">
                        <div class="logo" style="display:flex;align-items:center;">
                            <span class="logo-text" style="font-size:18px;">ElectroMania</span>
                            <img src="images/electromanialogo.png" width="40px" height="40px" alt="Logo">
                        </div>
                    </a>
                    <nav>

                        <ul id="MenuItems">

                            <li><a class="anav" href="index.php"></a></li>
                            <li>
                                <div class="dropdown">
                                    <a>Products</a>
                                    <div class="dropdown-content">
                                        <a href="productsmobile.php">Phones</a>
                                        <a href="productslaptops.php">Laptops</a>
                                        <a href="productssupplies.php">Supplies</a>
                                        <a href="products.php">ShowAll</a>
                                    </div>
                                </div>
                            </li>
                            <li><a class="anav" href="contact.php">Contact Us</a></li>
                            <li><a class="anav" href="about.php">About Us</a></li>
                            <?php if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == 1) {
                                echo'<li><a class="anav" href="profile.php">Profile</a></li>
                                <li><a class="anav" href="logout.php">Logout</a></li>';
                            } else {
                               echo'<li><a class="anav" href="account.php">Account</a></li>';
                            } ?>
                            <li><a class="anav" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                            <li><a class="anav" href="wishlist.php"><i class="uil uil-heart-alt"></i></a></li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <?php if (isset($_SESSION['message']) && $_SESSION['page'] == 'home') { ?>
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
            <?php if (isset($_SESSION['message2']) && $_SESSION['page']=='home') { ?>
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
        <div class="row">
            <div class="col-2">
                <h1>Shop Your Favorite Authentic Products!</h1>
                <p>We're here to serve you what you need for your studies, work and homes.</p>
                <a href="products.php" class="btn">Explore Now &#8594;</a>
            </div>
            <div class="col-2">
                <img src="images/new pic.png" alt="homepage-pic">
            </div>
        </div>
    </div>

    </div>
    </div>
    <!---featured categories-->

    <div class="categories">
        <div class="small-container">
            <h3 class="title">Categories</h3>
            <div class="row">

                <a href="productsmobile.php" ><div class="col-3">
                    <img src="images/smartphone.jfif" alt="phones">


                </div></a>
                <a href="productslaptops.php"><div class="col-3">
                    <img src="images/laptop2.jpg" alt="laptops">


                </div></a>

                <a href="productssupplies.php"><div class="col-3">
                    <img src="images/home-supplies.jpeg" alt="home-supplies">


                </div></a>


            </div>
        </div>
    </div>
    <!---featured products-->
    <div class="small-container">
        <div class="products">
            <h3 class="title">Latest Products</h3>
            <div class="row">
                <?php
                require_once 'connection.php';
                $query = "SELECT * FROM product ORDER BY Product_id DESC ";
                $res = mysqli_query($con, $query);
                for($i=0; $i<3;$i++){
                    $row=mysqli_fetch_assoc($res);
                    echo  '<a style="color:black"  href="productsdetails.php?id=' . $row['Product_id'] . '"><div class="col-4">
                    <img src=" images/' . $row['P_picture'] . '" alt="products">
                    <h4>' . $row['P_name'] . '</h4>
                    <p>' . $row['P_price'] . '$</p>
              </div></a>';
                }
                   
                
                ?>
            </div>
        </div>
    </div>
    <!--- carousel-->
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="images/slider1.jfif" style="width:70%" alt="slideshow">
        </div>

        <div class="mySlides fade">
            <img src="images/slider+.jfif" style="width:70%" alt="slideshow">
        </div>

        <div class="mySlides fade">
            <img src="images/slider3.jfif" style="width:70%" alt="slideshow">
        </div>


        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>


    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>

    </div>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
    <!--- testimonial-->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
    <?php 
    for ($i=1; $i < 4 ; $i++) { 
        $query1='SELECT * FROM contact WHERE id= '.$i.' ';
    $res1=mysqli_query($con,$query1);
    $nb=mysqli_num_rows($res1);
    if($nb==0){
        echo'<div class="col-3">
        <i class="fa fa-quote-left"></i>
        <p style="color:black; font-size:15px;" >
             no Data
        </p>
        <div class="rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
        </div>
    </div>'; 
    }
    else{
    $row1=mysqli_fetch_assoc($res1);
    echo '<div class="col-3">
    <i class="fa fa-quote-left"></i>
    <p style="color:black; font-size:15px;" >
        '.$row1['msg'].'
       
    </p>
    <div class="rating">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star-o"></i>
    </div>
</div>';
    }}
    ?>
    
                
                
            </div>
        </div>
    </div>
    <!-- brands -->
    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="images/Samsung_Logo.svg.webp" alt="samsung">
                </div>
                <div class="col-5">
                    <img src="images/HP_New_Logo_2D.svg.png" alt="hp">
                </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php'); ?>
        <!-- js for the menu responsive -->
        <script>
            var MenuItems = document.getElementById("MenuItems")
            MenuItems.style.maxHeight = "0px"

            function menutoggle() {
                if (MenuItems.style.maxHeight = "0px") {
                    MenuItems.style.maxHeight = "200px"
                } else {
                    MenuItems.style.maxHeight = "0px"
                }

            }
        </script>
</body>

</HTMl>