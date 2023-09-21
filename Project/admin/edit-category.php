<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
include('includes/header.php');
require_once '../connection.php'; 
require_once '../admin/functions/myfunctions.php';  ?>
<style>
    .save-button {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <?php if(isset($_GET['id'])){
                $id=$_GET['id'];
                $category = getById("categories", $id);
                if(!$category){
                    echo"failure";
                }
                $nbrows=mysqli_num_rows($category);
                if($nbrows!=0){
                    $row=mysqli_fetch_assoc($category);
            
        ?>
            <div class="card">
                <div class="card-header">
                    <h4>Edit Category</h4>
                    <a href="fetch-category.php" class="btn btn-primary float-end">Back</a>
                </div>
                <div class="card-body">
                    <form action="edit-category2.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="category_id" value="<?php echo $row['id'] ?>">
                                <label for="">Name</label>
                                <input name="category_name" type="text" class="form-control" value="<?php echo $row['C_name'] ?>" placeholder="Enter Category Name">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary save-button" name="update_category_btn">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                }
                else{
                    echo"Category not found";
                }
            }
            else{
                echo"The Url is missing";
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); }?>
