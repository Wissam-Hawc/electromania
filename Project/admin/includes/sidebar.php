<?php
if($_SESSION['isloggedin']!=1 || $_SESSION['role_id']!=1){
    header("Location:../index.php");
}
else{
?>
<?php
$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
//strrpos($_SERVER['SCRIPT_NAME'], "/"): This function, strrpos(), finds the last occurrence of the forward slash ("/") in the script path (the value of
//  $_SERVER['SCRIPT_NAME']). It returns the position (index) of the found slash in the string.  +1
?>
<style>
  .active {
    background-color: #0057f7 !important;
    /* Add any other styles for the active link */
  }
</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="../index.php" target="_blank">
    <div class="logo" style="display:flex;align-items:center; margin-right:0px;">
      <span class="ms-1 font-weight-bold text-white" style="padding-right:20px">ElectroMania</span>
      <img src="../images/electromanialogo.png" width="50px" height="50px" alt="Logo">
    </div>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white<?php if ($page == "index.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="index.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
          </div>
          <span class="nav-link-text ms-1">First page</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?php if ($page == "fetch-category.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="fetch-category.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">All Categories</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?php if ($page == "add-category.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="add-category.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">add</i>
          </div>
          <span class="nav-link-text ms-1">Add Category</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?php if ($page == "fetch-product.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="fetch-product.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">All Products</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?php if ($page == "add-product.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="add-product.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">add</i>
          </div>
          <span class="nav-link-text ms-1">Add Product</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?php if ($page == "fetch-user.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="fetch-user.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">All Users</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?php if ($page == "orders.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="orders.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">table_view</i>
          </div>
          <span class="nav-link-text ms-1">Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white <?php if ($page == "fetch-content.php") {
                                        echo 'active bg-gradient-primary';
                                      } else {
                                        echo '';
                                      } ?>" href="fetch-content.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">view_comfy</i>
          </div>
          <span class="nav-link-text ms-1">Content Pages</span>
        </a>
      </li>
    </ul>
  </div>
  <form action="../logout.php" method="post">
  <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <button class="btn bg-gradient-primary mt-4 w-100">Logout</button>
      </div>
    </div>
  </form>
</aside>
<?php } ?>