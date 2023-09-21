<?php session_start();
if ($_SESSION['isloggedin'] != 1 || $_SESSION['role_id'] != 1) {
    header("Location:../index.php");
} else {
?>
    <?php
    require_once '../connection.php';
    include('includes/header.php');
    require_once '../admin/functions/myfunctions.php';  ?>
    <style>
        .center-cell {
            text-align: center;
            /* Align content to the center */
            vertical-align: middle;
            /* Vertically center content */
        }
    </style>
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
                                    <th>TITLE</th>
                                    <th>DESCRIPTION</th>
                                    <th>IMAGE</th>
                                    <th>EDIT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once '../admin/functions/myfunctions.php';
                                // here this function will make the query and the $res
                                $content = getAll("content");
                                $nbrows = mysqli_num_rows($content);
                                if ($nbrows == 0) {
                                    echo "No CONTENT FOUND";
                                } else {

                                    for ($i = 0; $i < $nbrows; $i++) {
                                        $row = mysqli_fetch_assoc($content);
                                        echo "<tr>
                                <td class='center-cell' >$row[id]</td>
                                <td class='center-cell'>$row[name]</td>
                                <td class='center-cell'>$row[title]</td>
                                <td style='max-width: 170px;white-space: normal; overflow: hidden;
                                 text-overflow: ellipsis;'>$row[description]</td>" ?>

                                        <td class='center-cell'><img src="../images/<?php echo $row['image']; ?>" width="130px" height="80px" alt="No Photo">
                                        </td>
                                        <td class='center-cell'>
                                    <?php echo "
                                <a href='edit-content.php?id=$row[id]' class='btn btn-sm btn-primary'>EDIT</a>
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



<?php include('includes/footer.php');
} ?>