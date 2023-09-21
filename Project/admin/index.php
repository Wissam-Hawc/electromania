<?php session_start();
if ($_SESSION['isloggedin'] != 1 || $_SESSION['role_id'] != 1) {
  header("Location:../index.php");
} else {
?>
  <?php include('includes/header.php');
  require_once '../connection.php';
  ?>


  <div class="container">
    <div class="row mt-4">
      <div class="col-md-12">
        <div class="row">
          <div class="col-lg-10 col-sm-5">
            <div class="card  mb-2">
              <div class="card-header p-3 pt-2">
                <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary shadow text-center border-radius-xl position-absolute">
                  <i class="material-icons opacity-10">leaderboard</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                  <h4 class="mb-0">
                    <?php
                    $query = "SELECT * FROM user WHERE role_id='0' AND DATE(created_at) = CURDATE()";
                    $res = mysqli_query($con, $query);
                    $nbrows = mysqli_num_rows($res);
                    echo "+" . $nbrows;

                    ?>
                  </h4>
                </div>
              </div>

              <hr class="dark horizontal my-0">
              <div class="card-footer p-3">
                <p class="mb-0">
                  <?php
                  $prev_month_start = date('Y-m-d', strtotime('first day of last month'));
                  $prev_month_end = date('Y-m-d', strtotime('last day of last month'));

                  $prev_month_query = "SELECT * FROM user WHERE role_id='0' AND DATE(created_at) BETWEEN '$prev_month_start' AND '$prev_month_end'";
                  $prev_month_res = mysqli_query($con, $prev_month_query);
                  $prev_month_count = mysqli_num_rows($prev_month_res);

                  if ($prev_month_count > 0 && $nbrows > 0) {
                    $percentage_change = (($nbrows - $prev_month_count) / $prev_month_count) * 100;
                    echo "<span class='text-success text-sm font-weight-bolder'>+" . round($percentage_change, 2) . "%</span>" . " than last month";
                  } elseif ($nbrows == 0) {
                    echo "No data for today";
                  } else {
                    echo "<span class='text-success text-sm font-weight-bolder'>N/A</span> than last month";
                  }
                  ?>
                </p>
              </div>
            </div>

          </div>
          <div class="col-lg-10 col-sm-5 mt-sm-0 mt-4">
            <div class="card  mb-2">
              <div class="card-header p-3 pt-2 bg-transparent">
                <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl position-absolute">
                  <i class="material-icons opacity-10">store</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize ">Sold Amount</p>
                  <h4 class="mb-0 ">
                    <?php
                    $query = "SELECT * FROM orders WHERE DATE(o_date) = CURDATE()";
                    $res = mysqli_query($con, $query);
                    $nbrows = mysqli_num_rows($res);
                    $row = mysqli_fetch_assoc($res);
                    $total = 0;
                    for ($i = 0; $i < $nbrows; $i++) {
                      $total += $row['totalprice'];
                    }
                    echo "+" . $total . "$";

                    ?>
                  </h4>
                </div>
              </div>

              <hr class="horizontal my-0 dark">
              <div class="card-footer p-3">
                <p class="mb-0 "><?php
                                  $yesterday = date('Y-m-d', strtotime('yesterday'));

                                  $yesterday_query = "SELECT * FROM orders WHERE DATE(o_date) = '$yesterday'";
                                  $yesterday_res = mysqli_query($con, $yesterday_query);
                                  $yesterday_count = mysqli_num_rows($yesterday_res);
                                  $row = mysqli_fetch_assoc($yesterday_res);
                                  $total1 = 0;
                                  for ($i = 0; $i <$yesterday_count; $i++) {
                                    $total1 += $row['totalprice'];
                                  }
                                  $today_query = "SELECT * FROM orders WHERE DATE(o_date) = CURDATE()";
                                  $today_res = mysqli_query($con, $today_query);
                                  $today_count = mysqli_num_rows($today_res);
                                  $row = mysqli_fetch_assoc($today_res);
                                  $total2 = 0;
                                  for ($i = 0; $i <$today_count; $i++) {
                                    $total2 += $row['totalprice'];
                                  }

                                  if ($total1 > 0 && $total2 > 0) {
                                    $percentage_change = (($total2 - $total1) / $total1) * 100;
                                    if ($percentage_change < 0) {
                                      echo "<span class='text-danger text-sm font-weight-bolder'>" . round($percentage_change, 2) . "%</span>" . " than yesterday";
                                  } else {
                                      echo "No data for today";
                                  }
                              } elseif ($total2 == 0) {
                                  echo "No data for today";
                              } else {
                                  echo "<span class='text-success text-sm font-weight-bolder'>N/A</span> than yesterday";
                              }
                                  ?></p>
              </div>
            </div>

            <div class="card ">
              <div class="card-header p-3 pt-2 bg-transparent">
                <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl  position-absolute">
                  <i class="material-icons opacity-10">person_add</i>
                </div>
                <div class="text-end pt-1">
                  <p class="text-sm mb-0 text-capitalize ">All Users</p>
                  <h4 class="mb-0 ">
                    <?php
                    $query = "SELECT * FROM user WHERE role_id='0'";
                    $res = mysqli_query($con, $query);
                    $nbrows = mysqli_num_rows($res);
                    echo "+" . $nbrows;

                    ?>


                  </h4>
                </div>
              </div>

              <hr class="horizontal my-0 dark">
              <div class="card-footer p-3">
                <p class="mb-0 ">Just updated</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>



<?php include('includes/footer.php');
} ?>