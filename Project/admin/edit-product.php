<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
include('includes/header.php');
require_once '../connection.php';
require_once '../admin/functions/myfunctions.php';
?>
<style>
    .save-button {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM product WHERE Product_id='$id'";
                $res = mysqli_query($con, $query);
                $nbrows = mysqli_num_rows($res);
                if ($nbrows != 0) {
                    $row = mysqli_fetch_assoc($res);

            ?>

                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Product</h4>
                            <a href="fetch-product.php" class="btn btn-primary float-end">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="edit-product2.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">

                                        <label class="mb-0">Select Category</label>
                                        <select class="form-select mb-2" name="category_id">
                                            <option selected>Select Category</option>
                                            <?php
                                            $category = getAll("categories");
                                            $nbrows2 = mysqli_num_rows($category);
                                            if ($nbrows2 == 0) {
                                                echo "No categories Available";
                                            } else {
                                                for ($i = 0; $i < $nbrows2; $i++) {
                                                    $row2 = mysqli_fetch_assoc($category);
                                            ?>
                                                    <option value="<?php echo $row2['id'] ?>" <?php
                                                                                                if ($row['Category_id'] == $row2['id']) {
                                                                                                    echo 'selected';
                                                                                                } else {
                                                                                                    echo '';
                                                                                                }
                                                                                                ?>><?php echo $row2['C_name'] ?></option>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <input type="hidden" name="id"  value="<?php echo$row['Product_id'] ?>">
                                    <div class="col-md-12">
                                        <label class="mb-0">Name</label>
                                        <input name="name" value="<?php echo$row['P_name'] ?>" type="text" class="form-control mb-2" placeholder="Enter Product Name" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Description</label>
                                        <textarea rows='3' required name="description" placeholder="Enter Description" class="form-control mb-2"><?php echo$row['P_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Price</label>
                                        <input name="price" value="<?php echo$row['P_price'] ?>" type="number" step="0.01" class="form-control mb-2" placeholder="Enter Product Price" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Change Product Image</label>
                                        <input type="hidden" name="old_image" value="<?php echo$row['P_picture'] ?>">
                                        <input name="image" type="file" class="form-control mb-2" >
                                        <label class="mb-0">Current Image</label>
                                        <img src="../images/<?php echo$row['P_picture'] ?>" alt="Product Image" height="60px" width="60px"/>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Quantity</label>
                                        <input name="qty" value="<?php echo$row['P_quantity'] ?>" type="number" min="0" class="form-control mb-2" placeholder="Enter Quantity" required>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary save-button" name="update_product_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php

                } else {
                    echo "Product Not Found For Given Id";
                }
            } else {
                echo "Url Missing";
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); } ?>