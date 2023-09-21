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
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query="SELECT * FROM user WHERE role_id='0'";
                            $res=mysqli_query($con,$query);
                            $nbrows=mysqli_num_rows($res);
                            if($nbrows==0){
                                    echo"No users found";
                            }
                            else{
                                
                                for($i=0;$i<$nbrows;$i++){
                                $row=mysqli_fetch_assoc($res);
                                echo"<tr>
                                <td>$row[id]</td>
                                <td>$row[username]</td>
                                <td>$row[email]</td>
                                <td>$row[phone_number]</td>
                                <td>
                                <a href='delete-user.php?id=$row[id]' class='btn btn-sm btn-primary'>DELETE</a>
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