<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>E-Commerce Website - Electromania</title>
    <link rel="stylesheet" href="css/products.css">
    <link rel="stylesheet" href="css/navfoooter.css">
    <!------- pour l ecriture ----->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- cart and wishist -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php
    require_once 'connection.php';
    session_start();
    ?>
    <?php include('includes/nav.php'); ?>
    <div class="small-container">
    <div class="products">
        <h3 class="title">Products</h3>
        <div class="row">
    <?php
    
    $query = "SELECT * FROM product WHERE category_id=2";
    $res = mysqli_query($con, $query);
    $nb = mysqli_num_rows($res);
    $count=0;
    for ($i = 0; $i < $nb; $i++) {
        
        $row = mysqli_fetch_assoc($res);
        echo '
                   
        <a style="color:black" class="col-4" href="productsdetails.php?id=' . $row['Product_id'] . '">
                            <img src=" images/' . $row['P_picture'] . '" alt="laptops">
                            <h4>' . $row['P_name'] . '</h4>
                            <p>' . $row['P_price'] . '$</p>
                        </a>';

    }
    echo '  </div>
    </div>
    </div>';
    ?>
        <?php include('includes/footer.php'); ?>
</body>