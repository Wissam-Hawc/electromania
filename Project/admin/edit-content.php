<?php session_start();
if ($_SESSION['isloggedin'] != 1 || $_SESSION['role_id'] != 1) {
    header("Location:../index.php");
} else {
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
                    $query = "SELECT * FROM content WHERE id='$id'";
                    $res = mysqli_query($con, $query);
                    $nbrows = mysqli_num_rows($res);
                    if ($nbrows != 0) {
                        $row = mysqli_fetch_assoc($res);

                ?>

                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Page Content</h4>
                                <a href="fetch-content.php" class="btn btn-primary float-end">Back</a>
                            </div>
                            <div class="card-body">
                                <form action="edit-content2.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <div class="col-md-12">
                                            <label class="mb-0">Page Name</label>
                                            <input name="name" value="<?php echo $row['name'] ?>" type="text" class="form-control mb-2" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0">Page Title</label>
                                            <input name="title" value="<?php echo $row['title'] ?>" type="text" class="form-control mb-2" placeholder="Enter Page Title" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0">Description</label>
                                            <textarea rows='5' required name="description" placeholder="Enter Description" class="form-control mb-2"><?php echo $row['description'] ?></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mb-0">Page Image</label>
                                            <input type="hidden" name="old_image" value="<?php echo $row['image'] ?>">
                                            <input name="image" type="file" class="form-control mb-2">
                                            <label class="mb-0">Current Image</label>
                                            <img src="../images/<?php echo $row['image'] ?>" alt="No Image" height="80px" width="130px" />
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary save-button" name="update_page_btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?php

                    } else {
                        echo "Page Not Found For Given Id";
                    }
                } else {
                    echo "Url Missing";
                }
                ?>
            </div>
        </div>
    </div>

<?php include('includes/footer.php');
} ?>