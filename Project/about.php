<?php
    require_once 'connection.php';
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>z
        About Us page
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/about.css">
    <link rel="stylesheet" href="css/navfoooter.css">
    <!-- cart and iwhslist  -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
 
<?php include('includes/nav.php'); ?>
    <section class="parag">
        <div class="heading">
            <h1> About us</h1>
        </div>
        <div class="container2">
            <div class="content">
                <?php
                $query = "SELECT * FROM content WHERE name ='about'";
                $res = mysqli_query($con, $query);
                $nb = mysqli_num_rows($res);                
                $row = mysqli_fetch_assoc($res);
                ?>
                <h2><?php echo $row['title'] ?></h2>
                <p> <?php echo $row['description'] ?>
                </p>
            </div>
            <div class="back-img">
                <img id="img1"src="images/<?php echo $row['image'] ?>">
            </div>
        </div>
    </section>
    <?php include('includes/footer.php'); ?>

</body>

</html>