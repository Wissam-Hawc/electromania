<?php session_start();
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>

<?php include('includes/header.php'); ?>
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
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="add-category2.php" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input name="category_name" type="text" class="form-control" placeholder="Enter Category Name" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary save-button" name="add_category_btn">Save</button>
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