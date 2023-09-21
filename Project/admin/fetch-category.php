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
                    <h4>Categories</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../admin/functions/myfunctions.php'; 
                            // here this function will make the query and the $res
                            $category= getAll("categories");
                            $nbrows=mysqli_num_rows($category);
                            if($nbrows==0){
                                    echo"No categories found";
                            }
                            else{
                                
                                for($i=0;$i<$nbrows;$i++){
                                $row=mysqli_fetch_assoc($category);
                                echo"<tr>
                                <td>$row[id]</td>
                                <td>$row[C_name]</td>
                                <td>
                                <a href='edit-category.php?id=$row[id]' class='btn btn-sm btn-primary'>EDIT</a>
                                </td>
                                <td>
                                <a href='delete-category.php?id=$row[id]' class='btn btn-sm btn-primary'>DELETE</a>
                                </td>
                                </tr>";
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



<?php include('includes/footer.php'); }?>