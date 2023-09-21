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
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="add-product2.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                             <div class="col-md-12">
                                <label class="mb-0">Select Category</label>
                                <select class="form-select mb-2" name="category_id">
                                <option selected>Select Category</option>
                                    <?php 
                                        $category= getAll("categories");
                                        $nbrows=mysqli_num_rows($category);
                                        if($nbrows==0){
                                            echo"No categories Available";
                                    }
                                    else{
                                        for($i=0;$i<$nbrows;$i++){
                                            $row=mysqli_fetch_assoc($category);
                                            ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['C_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Name</label>
                                <input name="name" type="text" class="form-control mb-2" placeholder="Enter Product Name" required>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Description</label>
                                <textarea rows='3' required name="description" placeholder="Enter Description" class="form-control mb-2"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Price</label>
                                <input name="price" type="number" step="0.01" class="form-control mb-2" placeholder="Enter Product Price" required>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Upload Product Image</label>
                                <input name="image" type="file" class="form-control mb-2" required>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Quantity</label>
                                <input name="qty" type="number" min="0" class="form-control mb-2" placeholder="Enter Quantity" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary save-button" name="add_product_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php } ?>