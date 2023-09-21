<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
require_once '../connection.php';
include('includes/header.php');
require_once '../admin/functions/myfunctions.php';  ?>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders</h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>ORDER ID</th>
                            <th>USER ID</th>
                            <th>TOTAL</th>
                            <th>DATE</th>
                            <th>STATUS</th>
                            <th>UPDATE</th>
                            <th>VIEW</th>
                            <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $orders= getAll("orders");
                            $nbrows=mysqli_num_rows($orders);
                            if($nbrows==0){
                                    echo"No Orders found";
                            }
                            else{
                                
                                for($i=0;$i<$nbrows;$i++){
                                $row=mysqli_fetch_assoc($orders);
                                echo"<tr>
                                <td>$row[order_id]</td>
                                <td>$row[user_id]</td>
                                <td>$row[totalprice]</td>
                                <td>$row[o_date]</td>
                                <td>$row[o_status]
                                </td>";
                                ?>
                                <td><a href='updatestatus.php?id=<?php echo $row['order_id']?>' class='btn btn-sm btn-primary'>Update</a>
                                </td>
                                <td>
                                <a href='vieworder.php?id=<?php echo $row['order_id']?>' class='btn btn-sm btn-primary delete_product_btn'>View Details</a>
                                </td>
                                <td>
                                <a href='deleteorder.php?id=<?php echo $row['order_id']?>' class='btn btn-sm btn-primary delete_product_btn'>Delete</a>
                                </td>
                                </tr>
                                <?php
                                }

                                
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); } ?>