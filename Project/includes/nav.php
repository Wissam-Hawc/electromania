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
                        echo '<li><a class="anav" href="profile.php">Profile</a></li>
                                <li><a class="anav" href="logout.php">Logout</a></li>';
                    } else {
                        echo '<li><a class="anav" href="account.php">Account</a></li>';
                    } ?>
                    <li><a class="anav" href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                    <li><a class="anav" href="wishlist.php"><i class="uil uil-heart-alt"></i></a></li>

                </ul>
            </nav>
        </div>
    </div>
</div>