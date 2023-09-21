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
                    <h4>Products</h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>IMAGE</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product= getAll("product");
                            $nbrows=mysqli_num_rows($product);
                            if($nbrows==0){
                                    echo"No Products found";
                            }
                            else{
                                
                                for($i=0;$i<$nbrows;$i++){
                                $row=mysqli_fetch_assoc($product);
                                echo"<tr>
                                <td>$row[Product_id]</td>
                                <td>$row[P_name]</td>
                                <td>";
                                ?>
                                <img src="../images/<?php echo $row['P_picture'];?>" width="80px" height="80px" alt="<?php $row['P_name'];?>"
                                /></td>
                                <td>
                                <a href='edit-product.php?id=<?php echo $row['Product_id'] ?>' class='btn btn-sm btn-primary'>EDIT</a>
                                </td>
                                <td>
                                <a href='delete-product.php?id=<?php echo $row['Product_id']?>' class='btn btn-sm btn-primary delete_product_btn'>DELETE</a>
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