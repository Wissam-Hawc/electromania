<?php session_start();
if ($_SESSION['isloggedin'] != 1 || $_SESSION['role_id'] != 1) {
    header("Location:../index.php");
} else {

?>

    <?php

    require_once '../connection.php';
    include('includes/header.php');
    require_once '../admin/functions/myfunctions.php';
    if (isset($_GET['id'])) {
        $o_id = $_GET['id'];
        $query = "SELECT * FROM orders_details WHERE order_id='$o_id' ";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
        $query1 = "SELECT * FROM orders WHERE order_id='$o_id' ";
        $res1 = mysqli_query($con, $query1);
        $nb = mysqli_num_rows($res1);
        if ($nb != 0) {
            $row1 = mysqli_fetch_assoc($res1);
        
    ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="margin-top: 18px;">
                        <div style="background-color: blue;" class="card-header">
                            <span class="text-white fs-4">View Order</span>
                            <a href="orders.php" style="background-color: rgb(66, 66, 74);color:white;" class="btn float-end"><i class="fa fa-reply"></i></a>
                        </div>
                        <div class="card-body">
                            <div class="row" style="display:flex;">
                                <div class="col-md-6">
                                    <h4>Orders Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Order Id</label>
                                            <div class="border p-1">
                                                <?= $row1['order_id']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-1">
                                                <?= $row1['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone Number</label>
                                            <div class="border p-1">
                                                <?= $row1['pnb']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-1">
                                                <?= $row1['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-1">
                                                <?= $row1['o_address']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th class='text-center'>Id</th>
                                                <th class='text-center'>Product</th>
                                                <th class='text-center'>Price</th>
                                                <th class='text-center'>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query3 = "SELECT * FROM orders_details WHERE order_id='$o_id'";
                                        $res3 = mysqli_query($con, $query3);

                                        while ($row3 = mysqli_fetch_assoc($res3)) {
                                            $product_id = $row3['product_id'];

                                            $query4 = "SELECT * FROM product WHERE Product_id='$product_id'";
                                            $res4 = mysqli_query($con, $query4);
                                            $rowproduct = mysqli_fetch_assoc($res4);

                                            echo "<tr>
                                            <td class='text-center'>$row3[product_id]</td>
        <td class='text-center'>
            <img src='../images/$rowproduct[P_picture]' width='50px' height='50px' alt='$rowproduct[P_name]'>
        </td>
        <td class='text-center'>$row3[product_price]$</td>
        <td class='text-center'>$row3[quantity]</td>
    </tr>";
                                        }
                                     } else {
    echo "Details Not Found For Given Id";}
}else {
    echo "url missing";
    }

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php include('includes/footer.php');
} ?>